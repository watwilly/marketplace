<?php 
namespace TCG\Voyager\Http\Controllers;
use Illuminate\Http\Request;
use Voyager;
use \App\Models\Talles as talles;
use \App\Models\Colores as colores;
use \App\Models\Post as post;
use \App\Models\PostsTalles as posttalles;
use \App\Models\PostsColores as postcolores;
use \App\Models\Category as categorias;
use \App\Models\CategoryMarcas as categorymarcas;
use \App\Models\MarcasModelos as marcasmodelos;
use \App\Models\PostImagenes as postimagenes;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadDataAdded;
use Auth;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Support\Facades\Storage;


class VoyagerPostController extends Controller
{
    use BreadRelationshipParser;

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];

        $searchNames = [];
        if ($dataType->server_side) {
            $searchable = SchemaManager::describeTable(app($dataType->model_name)->getTable())->pluck('name')->toArray();
            $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->get();
            foreach ($searchable as $key => $value) {
                $field = $dataRow->where('field', $value)->first();
                $displayName = ucwords(str_replace('_', ' ', $value));
                if ($field !== null) {
                    $displayName = $field->getTranslatedAttribute('display_name');
                }
                $searchNames[$value] = $displayName;
            }
        }

        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', $dataType->order_direction);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $model->{$dataType->scope}();
            } else {
                $query = $model::select('*');
            }

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))) {
                $usesSoftDeletes = true;

                if ($request->get('showSoftDeleted')) {
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value != '' && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                $query->where($search->key, $search_filter, $search_value);
            }

            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;

        // Actions
        $actions = [];
        if (!empty($dataTypeContent->first())) {
            foreach (Voyager::actions() as $action) {
                $action = new $action($dataType, $dataTypeContent->first());

                if ($action->shouldActionDisplayOnDataType()) {
                    $actions[] = $action;
                }
            }
        }

        // Define showCheckboxColumn
        $showCheckboxColumn = false;
        if (Auth::user()->can('delete', app($dataType->model_name))) {
            $showCheckboxColumn = true;
        } else {
            foreach ($actions as $action) {
                if (method_exists($action, 'massAction')) {
                    $showCheckboxColumn = true;
                }
            }
        }

        // Define orderColumn
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
            $orderColumn = [[$index, $sortOrder ?? 'desc']];
        }

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return Voyager::view($view, compact(
            'actions',
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortOrder',
            'searchNames',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted',
            'showCheckboxColumn'
        ));
    }
    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }    
    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }


        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = $model->findOrFail($id);
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        if ($request->hasFile('image')){
            $file = $request->file('image');
            foreach ($file as  $imagenes) {
                $upload = Voyager::upload_image($imagenes, 'post');
                $insertImagenes  = new postimagenes();
                $insertImagenes->imagen = $upload;
                $insertImagenes->status = 1;
                $data->postimagenes()->save($insertImagenes);
            }
        }

        event(new BreadDataUpdated($dataType, $data));

        return redirect()->back()->with([
            'message'    => __('voyager::generic.successfully_updated')." {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        event(new BreadDataAdded($dataType, $data));
       
        if ($request->hasFile('image')){
            $file = $request->file('image');
            foreach ($file as  $imagenes) {
                $upload = Voyager::upload_image($imagenes, 'post');
                $insertImagenes  = new postimagenes();
                $insertImagenes->imagen = $upload;
                $insertImagenes->status = 1;
                $data->postimagenes()->save($insertImagenes);
            }
        }
        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }
    public function atributos(Request $request, $id)
    { 
    	$post = post::where('id', $request->id)->first();
        $talles = talles::all();
        $colores = colores::all();
        $view = 'voyager::posts.atributos';
        return view($view, compact('post', 'colores', 'talles'));
    }	
    public function setAtributo(Request $request)
    {   

    	$post = post::where('id', $request->posts_id)->first();
        if ($request->talle_id) {
			$talle = new posttalles();
			$consulta = $talle->where('posts_id', $request->posts_id)->where('talle_id',$request->talle_id)->first();
			if (is_null($consulta)) {
            	$talle->talle_id = $request->talle_id; 
            	$post->poststalles()->save($talle);
			}
        }

        if ($request->colores_id) {
			$color = new postcolores();
			$consulta_color = $color->where('posts_id', $request->posts_id)->where('color_id',$request->talle_id)->first();

			if (is_null($consulta_color)) {
 	            $color->color_id = $request->colores_id; 
            	$post->postscolores()->save($color);		
 			}
        }

        return redirect('/admin/posts/'.$request->posts_id.'/atributos');
    }
    public function deleteAtributo(Request $request)
    {	
    	if ($request->atributo == 'talle') {
    		 $atributo = posttalles::where('id', $request->atributo_id);
    	}elseif ($request->atributo == 'color') {
    		 $atributo = postcolores::where('id', $request->atributo_id);
    	}

    	$get = $atributo->where('posts_id', $request->post_id)->first();
    	$atributo->delete();

    	return redirect()->back();
    }
    public function postdelete(Request $request)
    {

          $post = post::where('id', $request->id)->first();

          if (is_null($post)) {

            return redirect()->back()->with([
                'message'    =>"Esta publicacion no esta disponible",
                'alert-type' => 'error',
            ]);
          }

          $imagenes = $post->postimagenes();


          if ($imagenes) {

            $thumbnails = [
                      'cropped',
                      'medium',
                      'mini',
                      'small'];


            foreach ($imagenes->get() as  $image) {

                $find = explode(".", $image->imagen);
                $type = end($find);
                $filename = basename($image->imagen, $type);
                $filename = str_replace(".", "", $filename);
                $dir = dirname($image->imagen);
                
                $this->deleteFileIfExists($image->imagen);

               foreach ($thumbnails as  $thum) {
                  
                 $this->deleteFileIfExists("$dir/$filename-$thum.$type");
               }


            }

            $imagenes->delete();
          }

          $post->status = 'DRAFT';
          $delete = $post->save();

          if ($delete == true) {
            return redirect()->back()->with([
                'message'    =>"Publicacion con estado eliminada, sus imagenes fueron eliminadas del sistema",
                'alert-type' => 'success',
            ]);
            
          } elseif ($delete == false) {
            return redirect()->back()->with([
                'message'    =>"Ocurrio un error al eliminar intente de nuevo mas tarde.",
                'alert-type' => 'error',
            ]);
          }
    }
    public function lista_subcategoria(Request $request)
    {
        $categoria = categorias::where('parent_id', $request->elegido)
        ->get();

        return view("voyager::posts.subcategory")->with('categoria', $categoria);   
    }
    public function lista_marca(Request $request)
    {
        $marcas = categorymarcas::where('category_id', $request->elegido)->get();
        return view("voyager::posts.marcas")->with('marcas', $marcas);
    }
    public function lista_modelos(Request $request)
    {
        $modelos = marcasmodelos::where('marcas_id', $request->elegido)->get();
        return view("voyager::posts.modelos")->with('modelos', $modelos);        
    }
    public function relation(Request $request)
    {
        $slug = $this->getSlug($request);
        $page = $request->input('page');
        $on_page = 50;
        $search = $request->input('search', false);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $method = $request->input('method', 'add');

        $model = app($dataType->model_name);
        if ($method != 'add') {
            $model = $model->find($request->input('id'));
        }

        $this->authorize($method, $model);

        $rows = $dataType->{$method.'Rows'};
        foreach ($rows as $key => $row) {
            if ($row->field === $request->input('type')) {
                $options = $row->details;
                $model = app($options->model);
                $skip = $on_page * ($page - 1);

                // Apply local scope if it is defined in the relationship-options
                if (isset($options->scope) && $options->scope != '' && method_exists($model, 'scope'.ucfirst($options->scope))) {
                    $model = $model->{$options->scope}();
                }

                // If search query, use LIKE to filter results depending on field label
                if ($search) {
                    // If we are using additional_attribute as label
                    if (in_array($options->label, $model->additional_attributes ?? [])) {
                        $relationshipOptions = $model->all();
                        $relationshipOptions = $relationshipOptions->filter(function ($model) use ($search, $options) {
                            return stripos($model->{$options->label}, $search) !== false;
                        });
                        $total_count = $relationshipOptions->count();
                        $relationshipOptions = $relationshipOptions->forPage($page, $on_page);
                    } else {
                        $total_count = $model->where($options->label, 'LIKE', '%'.$search.'%')->count();
                        $relationshipOptions = $model->take($on_page)->skip($skip)
                            ->where($options->label, 'LIKE', '%'.$search.'%')
                            ->get();
                    }
                } else {
                    $total_count = $model->count();
                    $relationshipOptions = $model->take($on_page)->skip($skip)->get();
                }

                $results = [];

                if (!$row->required && !$search && $page == 1) {
                    $results[] = [
                        'id'   => '',
                        'text' => __('voyager::generic.none'),
                    ];
                }

                // Sort results
                if (!empty($options->sort->field)) {
                    if (!empty($options->sort->direction) && strtolower($options->sort->direction) == 'desc') {
                        $relationshipOptions = $relationshipOptions->sortByDesc($options->sort->field);
                    } else {
                        $relationshipOptions = $relationshipOptions->sortBy($options->sort->field);
                    }
                }

                foreach ($relationshipOptions as $relationshipOption) {
                    $results[] = [
                        'id'   => $relationshipOption->{$options->key},
                        'text' => $relationshipOption->{$options->label},
                    ];
                }

                return response()->json([
                    'results'    => $results,
                    'pagination' => [
                        'more' => ($total_count > ($skip + $on_page)),
                    ],
                ]);
            }
        }

        // No result found, return empty array
        return response()->json([], 404);
    }
    public function imgdelete(Request $request)
    {
        $post  = post::where('id', $request->post_id)->first();
        $imagen = $post->postimagenes()->where('id', $request->img_id)->first();

        if (is_null($imagen)) {
            return redirect()->back()->with([
                'message'    =>"Esta imagen no corresponde a esta publicacion",
                'alert-type' => 'error',
            ]);            
        }


                $arrays = [
                    "me" => "medium",                    
                    "cr" => "cropped", 
                    "mn" => "mini"
                ];

                $find = explode(".", $imagen->imagen);

                $type = end($find);

                $filename = basename($imagen->imagen, $type);

                $filename = str_replace(".", "", $filename);

                $dir = dirname($imagen->imagen);
                
            foreach ($arrays as $crop) {

               $resultImgane = $dir.DIRECTORY_SEPARATOR.$filename.'-'.$crop.'.'.$type;

                
                Storage::disk(config('voyager.storage.disk'))->delete($resultImgane);
                    
                
            }

                Storage::disk(config('voyager.storage.disk'))->delete($imagen->imagen);


            $imagen->delete();

            return redirect()->back()->with([
                'message'    =>"Imagen Eliminada del sistema",
                'alert-type' => 'success',
            ]);
    }
}