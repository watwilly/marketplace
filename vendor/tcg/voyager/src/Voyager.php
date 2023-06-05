<?php

namespace TCG\Voyager;
require 'webp/vendor/autoload.php'; 

use Arrilot\Widgets\Facade as Widget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use TCG\Voyager\Actions\DeleteAction;
use TCG\Voyager\Actions\EditAction;
use TCG\Voyager\Actions\RestoreAction;
use TCG\Voyager\Actions\ViewAction;
use TCG\Voyager\Events\AlertsCollection;
use TCG\Voyager\FormFields\After\HandlerInterface as AfterHandlerInterface;
use TCG\Voyager\FormFields\HandlerInterface;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Setting;
use TCG\Voyager\Models\Translation;
use TCG\Voyager\Models\User;
use TCG\Voyager\Traits\Translatable;

use Intervention\Image\Facades\Image;
use Intervention\Image\Constraint;
use WebPConvert\WebPConvert;
use \App\Models\Posiciones as posiciones;

class Voyager
{
    protected $version;
    protected $filesystem;

    protected $alerts = [];
    protected $alertsCollected = false;

    protected $formFields = [];
    protected $afterFormFields = [];

    protected $viewLoadingEvents = [];

    protected $actions = [
        DeleteAction::class,
        RestoreAction::class,
        EditAction::class,
        ViewAction::class,
    ];

    protected $models = [
        'Category'    => Category::class,
        'DataRow'     => DataRow::class,
        'DataType'    => DataType::class,
        'Menu'        => Menu::class,
        'MenuItem'    => MenuItem::class,
        'Page'        => Page::class,
        'Permission'  => Permission::class,
        'Post'        => Post::class,
        'Role'        => Role::class,
        'Setting'     => Setting::class,
        'User'        => User::class,
        'Translation' => Translation::class,
    ];

    public $setting_cache = null;

    public function __construct()
    {
        $this->filesystem = app(Filesystem::class);

        $this->findVersion();
    }

    public function model($name)
    {
        return app($this->models[Str::studly($name)]);
    }

    public function modelClass($name)
    {
        return $this->models[$name];
    }

    public function useModel($name, $object)
    {
        if (is_string($object)) {
            $object = app($object);
        }

        $class = get_class($object);

        if (isset($this->models[Str::studly($name)]) && !$object instanceof $this->models[Str::studly($name)]) {
            throw new \Exception("[{$class}] must be instance of [{$this->models[Str::studly($name)]}].");
        }

        $this->models[Str::studly($name)] = $class;

        return $this;
    }

    public function view($name, array $parameters = [])
    {
        foreach (Arr::get($this->viewLoadingEvents, $name, []) as $event) {
            $event($name, $parameters);
        }

        return view($name, $parameters);
    }

    public function onLoadingView($name, \Closure $closure)
    {
        if (!isset($this->viewLoadingEvents[$name])) {
            $this->viewLoadingEvents[$name] = [];
        }

        $this->viewLoadingEvents[$name][] = $closure;
    }

    public function formField($row, $dataType, $dataTypeContent)
    {
        $formField = $this->formFields[$row->type];

        return $formField->handle($row, $dataType, $dataTypeContent);
    }

    public function afterFormFields($row, $dataType, $dataTypeContent)
    {
        return collect($this->afterFormFields)->filter(function ($after) use ($row, $dataType, $dataTypeContent) {
            return $after->visible($row, $dataType, $dataTypeContent, $row->details);
        });
    }

    public function addFormField($handler)
    {
        if (!$handler instanceof HandlerInterface) {
            $handler = app($handler);
        }

        $this->formFields[$handler->getCodename()] = $handler;

        return $this;
    }

    public function addAfterFormField($handler)
    {
        if (!$handler instanceof AfterHandlerInterface) {
            $handler = app($handler);
        }

        $this->afterFormFields[$handler->getCodename()] = $handler;

        return $this;
    }

    public function formFields()
    {
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver", 'mysql');

        return collect($this->formFields)->filter(function ($after) use ($driver) {
            return $after->supports($driver);
        });
    }

    public function addAction($action)
    {
        array_push($this->actions, $action);
    }

    public function replaceAction($actionToReplace, $action)
    {
        $key = array_search($actionToReplace, $this->actions);
        $this->actions[$key] = $action;
    }

    public function actions()
    {
        return $this->actions;
    }

    public function dimmers()
    {
        $widgetClasses = config('voyager.dashboard.widgets');
        $dimmerGroups = [];
        $dimmerCount = 0;
        $dimmers = Widget::group("voyager::dimmers-{$dimmerCount}");

        foreach ($widgetClasses as $widgetClass) {
            $widget = app($widgetClass);

            if ($widget->shouldBeDisplayed()) {

                // Every third dimmer, we consider out WidgetGroup filled.
                // We switch that out with another WidgetGroup.
                if ($dimmerCount % 3 === 0 && $dimmerCount !== 0) {
                    $dimmerGroups[] = $dimmers;
                    $dimmerGroupTag = ceil($dimmerCount / 3);
                    $dimmers = Widget::group("voyager::dimmers-{$dimmerGroupTag}");
                }

                $dimmers->addWidget($widgetClass);
                $dimmerCount++;
            }
        }

        $dimmerGroups[] = $dimmers;

        return $dimmerGroups;
    }

    public function setting($key, $default = null)
    {
        $globalCache = config('voyager.settings.cache', false);

        if ($globalCache && Cache::tags('settings')->has($key)) {
            return Cache::tags('settings')->get($key);
        }

        if ($this->setting_cache === null) {
            if ($globalCache) {
                // A key is requested that is not in the cache
                // this is a good opportunity to update all keys
                // albeit not strictly necessary
                Cache::tags('settings')->flush();
            }

            foreach (self::model('Setting')->orderBy('order')->get() as $setting) {
                $keys = explode('.', $setting->key);
                @$this->setting_cache[$keys[0]][$keys[1]] = $setting->value;

                if ($globalCache) {
                    Cache::tags('settings')->forever($setting->key, $setting->value);
                }
            }
        }

        $parts = explode('.', $key);

        if (count($parts) == 2) {
            return @$this->setting_cache[$parts[0]][$parts[1]] ?: $default;
        } else {
            return @$this->setting_cache[$parts[0]] ?: $default;
        }
    }

    public function image($file, $default = '')
    {
        if (!empty($file)) {
            return str_replace('\\', '/', Storage::disk(config('voyager.storage.disk'))->url($file));
        }

        return $default;
    }

    public function routes()
    {
        require __DIR__.'/../routes/voyager.php';
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function addAlert(Alert $alert)
    {
        $this->alerts[] = $alert;
    }

    public function alerts()
    {
        if (!$this->alertsCollected) {
            event(new AlertsCollection($this->alerts));

            $this->alertsCollected = true;
        }

        return $this->alerts;
    }

    protected function findVersion()
    {
        if (!is_null($this->version)) {
            return;
        }

        if ($this->filesystem->exists(base_path('composer.lock'))) {
            // Get the composer.lock file
            $file = json_decode(
                $this->filesystem->get(base_path('composer.lock'))
            );

            // Loop through all the packages and get the version of voyager
            foreach ($file->packages as $package) {
                if ($package->name == 'tcg/voyager') {
                    $this->version = $package->version;
                    break;
                }
            }
        }
    }

    public function translatable($model)
    {
        if (!config('voyager.multilingual.enabled')) {
            return false;
        }

        if (is_string($model)) {
            $model = app($model);
        }

        if ($model instanceof Collection) {
            $model = $model->first();
        }

        if (!is_subclass_of($model, Model::class)) {
            return false;
        }

        $traits = class_uses_recursive(get_class($model));

        return in_array(Translatable::class, $traits);
    }

    public function getLocales()
    {
        $appLocales = [];
        if ($this->filesystem->exists(resource_path('lang/vendor/voyager'))) {
            $appLocales = array_diff(scandir(resource_path('lang/vendor/voyager')), ['..', '.']);
        }

        $vendorLocales = array_diff(scandir(realpath(__DIR__.'/../publishable/lang')), ['..', '.']);
        $allLocales = array_merge($vendorLocales, $appLocales);

        asort($allLocales);

        return $allLocales;
    }
    public function get_image($img, $tipo_crop, $storage)
    {   

        if ($storage == 'online') {
            return $img;
        }

        if(!is_null($tipo_crop)){
            $find = explode(".", $img);
            $type = end($find);
            $filename = basename($img, $type);
            $filename = str_replace(".", "", $filename);
            $dir = dirname($img);    
          if(file_exists( public_path(). "/storage/$dir/$filename-$tipo_crop.$type" )){

             return $result = "/storage/$dir/$filename-$tipo_crop.$type";

          }else if(file_exists( public_path(). "/storage/$dir/$filename-$tipo_crop.$type.webp")){
            
             return $result = "/storage/$dir/$filename-$tipo_crop.$type.webp";
          
          }else{

            return "/storage/".Voyager::setting('site.inf');
          }

        }else if (is_null($tipo_crop)) {
            if(file_exists( public_path(). "/storage/$img" )){
                return "/storage/".$img;
            
            }else if (file_exists( public_path(). "/storage/$img.webp")) {
                return "/storage/".$img.".webp";
            
            } else{
                return "/storage/".Voyager::setting('site.inf');
            }
        }

    
    }
    public  function vencimiento($dias)
    {   
        $carbon = new \Carbon\Carbon(); 

        $now = $carbon->now();
        return $now->addDay($dias)->toDateString();
    }

    public function upload_image($file, $typeCrop)
    {

        $filename = Str::random(20);
            $options_covers = [
                'show-report' => false 
            ];
            if ($typeCrop == 'post') {
                $path = "posts/".date('F').date('Y').'/';

                $arrays = [
                        "quality" => "100%",
                        "upsize"  => true,
                        "thumbnails"=> [
                            [
                                "name" => "medium", //Vista home
                                "crop" => [
                                    "width" => "300",
                                    "height" => "300"
                                ]
                            ],
                            
                            [
                                "name" => "small",  
                                "crop" => [
                                    "width" => "281",
                                    "height" => "281"
                                ]
                            ]
                        ]
                    ];

            }elseif ($typeCrop == 'account') {

                $path = "users/".date('F').date('Y').'/';

                $arrays = [

                        "quality" => "70%",
                        "upsize"  => true,
                        "thumbnails"=> [

                            [
                                "name" => "cropped",
                                "crop" => [
                                    "width" => "194",
                                    "height" => "136"
                                ]
                            ]
                        ]
                    ];

            }elseif ($typeCrop == 'logo') {

                $path = "tiendas/logo/".date('F').date('Y').'/';

                $arrays = [

                        "thumbnails"=> [

                            [
                                "name" => "cropped",
                                "crop" => [
                                    "width" => "200",
                                    "height" => "200"
                                ]
                            ]
                        ]
                    ];

            }elseif ($typeCrop == 'banner') {

                $path = "tiendas/banner/".date('F').date('Y').'/';

                $arrays = [

                        "quality" => "100%",
                        "upsize"  => true,
                    ];

            }elseif ($typeCrop == 'servicios') {
                $path = "servicios/".date('F').date('Y').'/';
                $arrays = [

                        "quality" => "50%",
                        "upsize"  => true,
                        "thumbnails"=> [

                            [
                                "name" => "cropped",
                                "crop" => [
                                    "width" => "343",
                                    "height" => "218"
                                ]
                            ]
                        ]
                    ];
            }elseif ($typeCrop == 'pautas') {
                $path = "pautas/".date('F').date('Y').'/';
                $arrays = [
                    "quality" => "100%",
                ];
            }elseif ($typeCrop == 'laboral') {
                $path = "laboral/".date('F').date('Y').'/';
                $arrays = [

                        "quality" => "100%",
                        "thumbnails"=> [
                            [
                                "name" => "cropped",
                                "crop" => [
                                    "width" => "400",
                                    "height" => "400"
                                ]
                            ]
                        ]
                    ];            
            }                       

            $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
            $json =  json_encode($arrays);
            $options =  json_decode($json);

            if (isset($options->resize) && isset($options->resize->width) && isset($options->resize->height)) {
                $resize_width = $options->resize->width;
                $resize_height = $options->resize->height;
            } else {
                $resize_width = 1800;
                $resize_height = null;
            }

            $image = Image::make($file)->resize($resize_width, $resize_height,
                function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode($file->getClientOriginalExtension(), 75);

            Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public');

            if (isset($options->thumbnails)) {
                foreach ($options->thumbnails as $thumbnails) {
                    if (isset($thumbnails->name) && isset($thumbnails->scale)) {
                        $scale = intval($thumbnails->scale) / 100;
                        $thumb_resize_width = $resize_width;
                        $thumb_resize_height = $resize_height;

                        if ($thumb_resize_width != 'null') {
                            $thumb_resize_width = $thumb_resize_width * $scale;
                        }

                        if ($thumb_resize_height != 'null') {
                            $thumb_resize_height = $thumb_resize_height * $scale;
                        }

                        $image = Image::make($file)->resize($thumb_resize_width, $thumb_resize_height,
                            function (Constraint $constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })->encode($file->getClientOriginalExtension(), 75);
                        
                    } elseif (isset($options->thumbnails) && isset($thumbnails->crop->width) && isset($thumbnails->crop->height)) {
                        $crop_width = $thumbnails->crop->width;
                        $crop_height = $thumbnails->crop->height;
                        $image = Image::make($file)
                            ->fit($crop_width, $crop_height)
                            ->encode($file->getClientOriginalExtension(), 75);
                    }
                    $thumb_path = $path.$filename.'-'.$thumbnails->name.'.'.$file->getClientOriginalExtension();
                    Storage::disk(config('voyager.storage.disk'))->put($thumb_path,
                        (string) $image, 'public'
                    );
                    $thumb_source = public_path().'/storage/'.$thumb_path;
                    $thumb_destination = $thumb_source . '.webp';     
                    WebPConvert::convert($thumb_source, $thumb_destination, $options_covers);
                    
                    if (file_exists($thumb_source)) {
                        unlink($thumb_source);
                    }
                }
            }
            $source = public_path().'/storage/'.$fullPath;            
            $destination = $source . '.webp';     
            WebPConvert::convert($source, $destination, $options_covers);
           if (file_exists($source)) {
                unlink($source);
           }
         return $fullPath;          
    }
    public function uploadFile($file, $slug, $field)
    {
     if ($file) {
            $filename = Str::random(20);
            $path = $slug.'/'.date('F').date('Y').'/';
            $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
            $file->storeAs(
                $path,
                $filename.'.'.$file->getClientOriginalExtension(),
                config('voyager.storage.disk', 'public')
            );

            return $fullPath;
        }        
    }

    public function h_listview($title, $id, $imagen, $storage, $precios, $cropp_type, $prd_catname, $condicion)
    {
        return view('shared.prd_listview', compact('title', 'id', 'imagen', 'storage', 'precios', 'cropp_type', 'prd_catname', 'condicion'));
    }
    public function get_pauta($ubicacion)
    {
        $posicion = posiciones::where('ubicacion', $ubicacion)->first();
        
        if(is_null($posicion)){
            return false;
        }
        $carbon = new \Carbon\Carbon(); 

        $fecha = $carbon->now()->toDateString();

        $pauta = $posicion->pautasId()->select("banner","link","banner_responsive")->where('status', 1)
            ->whereDate('desde', '<=', $fecha)
            ->whereDate('hasta', '>=', $fecha)->first();
        return $pauta;
    }
}