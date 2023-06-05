<?php

namespace App\Http\Controllers;
//require_once '../vendor/google/recaptcha/src/autoload.php';

use Illuminate\Http\Request;
use \App\Models\Slider as slider;
use \App\Models\Category as category;
use \App\Models\Tiendas as tiendas;
use \App\Models\Post as post;
use DB;
use \App\Models\localidades as localidades;
use Session;
use \App\Mail\contacto as contacto;
use Mail;
use Voyager;
use \App\Models\PostVisitas as visitas;
use Carbon\Carbon;
#eliminar
use \App\Mail\AccountValidate as accountvalidate;
use \App\Mail\interesados as interesados;

class HomeController extends Controller
{   


    public function index()
    {   

        $this->dropallsession();

        $sliders = slider::where('active', 1)
               ->orderBy('created_at', 'desc')
               ->get();

        $categorias = category::where('home', 1)->orderBy('order', 'ASC')->get();
        
        $tiendas = tiendas::select('tiendas.id', 'tiendas.titulo', 'logo')->where('status', 1)
            ->where('tiendas.destacada', 1)->orderBy('tiendas.created_at', 'DESC')->get();

        $ofertas = post::select( DB::raw('posts.id, condicion, category_id, precios, title, categories.id as catid, categories.name, categories.home'))
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->where('categories.home', 0)
            ->where('posts.status', 'PUBLISHED')
            ->where('posts.precios', '>',100)
            ->take(16)
            ->orderBy('posts.precios', 'ASC')
            ->get();

        $now = Carbon::today()->subDay(3);
        $today = Carbon::today();

        $visitas = visitas::select('prd.condicion','posts_visitas.id as visitaId', 'prd.id', 'category_id', 'precios', 'title', 'categories.id as catid', 'categories.name', 'posts_visitas.cant_visita')
            ->join('posts as prd', 'posts_visitas.posts_id', '=', 'prd.id')
            ->join('categories', 'prd.category_id', '=', 'categories.id')
            ->where('prd.status', 'PUBLISHED')
            ->whereDate('posts_visitas.updated_at','>=', $now)
            ->whereDate('posts_visitas.updated_at', '<=', $today)
            ->orderBy('posts_visitas.cant_visita', 'DESC')
            ->take(12)
            ->get();


        #Publicidades
        $h1 = Voyager::get_pauta("homeh1");
        $h2 = Voyager::get_pauta("homeh2");
        $v1 = Voyager::get_pauta("homev1");

        return view('home.index')
            ->with('visitas',$visitas)
            ->with('interes', $this->get_interes())
            ->with('categorias', $categorias)
            ->with('url_ultimos', NULL)
            ->with('ofertas',$ofertas)
            ->with("h1",$h1)
            ->with("h2",$h2)
            ->with("v1",$v1)
            ->with('tiendas', $tiendas)
            ->with('sliders', $sliders);
    }

    public function listaLocalidades(Request $request)
    {
        $localidades = localidades::where('provincias_id', $request->elegido)
            ->get();

        foreach ($localidades as $localidad) {
           ?><option value="<?=$localidad->id?>" ><?=$localidad->localidad?></option><?php
        }
    }

    public function search(Request $request)
    {   
       if (!$request->data) {
            return redirect()->back()->with(['operation_status'=>'info', 'operation_message'=>'Escriba algo para buscar', 'operation_notif'=>'ESCRIBA EL NOMBRE DE ALGO EJEMPLO ZAPATILLAS']);
       }
        $cadena = str_slug($request->data, ' ');
        $array = explode(" ", $cadena);

        $query = post::query();
        $query->select('id', 'title', 'category_id', 'subcategoryId', 'marca_id', 'modelos_id','precios', 'condicion');
        $query->where('status', 'PUBLISHED');

        if ($seaCondition = Session::get('seaCondition')) {
            $query->where('condicion', $seaCondition);
        }

        if($cat_id = $request->category){
            $query->where('category_id', $cat_id);
        }

        if ($seaModel = Session::get('seaModel')) {
            $query->where('Modelos_id', $seaModel);
        }

        if ($seaMarca = Session::get('seaMarca')) {
            $query->where('marca_id', $seaMarca);
        }

        foreach ($array as $valores) {
            $condicion[] = ["title", "LIKE", "%".$valores."%"];
        }
        $query->where($condicion); #Esta condicion se aplica al like

        if ($orden = Session::get('seaOrden')) {
            if ($orden == "AAZ") {
                $query->OrderBy('title', 'ASC');

            }elseif($orden == "ZAA"){
                $query->OrderBy('title', 'DESC');

            }else{
                $query->OrderBy('precios', $orden);
            }
        }else{
            $query->orderBy('created_at', 'DESC');
        }
        $url = url()->full();
        $buscador =  $query->paginate(16)->setPath($url);

        $marcas     =  [];
        $modelos    =  [];
        $categorias =  [];
        $productos  =  []; 
        
        if ($buscador->count() > 0) {
            foreach ($buscador as $resultado) {
                $marca    = $resultado->marca()->first();
                $modelo   = $resultado->modelo()->first();
                $category = $resultado->category()->first();
                $imagen =  $resultado->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();                                                      
                $cate_name = "seccion-tucuman";
                if ($imagen) {
                    $setImg = $imagen->imagen;
                    $storage = $imagen->storage;
                }else{
                    $setImg = NULL;
                    $storage = NULL;
                }

               if ($marca){
                    $marcas["marca-".$marca->id] = [
                        "id"=>$marca->id,
                        "name"=>$marca->name
                    ];
               }
               if ($modelo){
                    $modelos["modelo-".$modelo->id] = [
                        "id"=>$modelo->id,
                        "name"=>$modelo->name
                    ];
               }
               if ($category) {
                    $categorias["category-".$category->id] = [
                        "id"=>$category->id,
                        "name"=>$category->name
                    ];
                    $cate_name = $category->name;
               }

               $productos[] = [
                    "id"=>$resultado->id,
                    "title"=>$resultado->title,
                    "condicion"=>$resultado->condicion,
                    "precios"=>$resultado->precios,
                    "imagen"=>$setImg,
                    "storage"=>$storage,
                    "cat_name"=>$cate_name
               ];
            }
        }

        $ultimas = post::select('posts.id', 'title', 'precios', 'categories.name', 'condicion')->where('status', 'PUBLISHED')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->orderBy('posts.created_at', 'DESC')
            ->take(5)
            ->get();
        $h1 = Voyager::get_pauta("bush1");
        $h2 = Voyager::get_pauta("bush2");
            

        $this->dropCategorySession();

        return view('home.search')
            ->with('busqueda', str_slug($request->data, " "))
            ->with('ultimas', $ultimas)
            ->with('marcas', $marcas)
            ->with("h1",$h1)
            ->with("h2",$h2)
            ->with('modelos', $modelos)
            ->with('paginate', $buscador)
            ->with('categorias', $categorias)
            ->with('productos', $productos);
    }

    public function buenosprecios(Request $request)
    {  
        $url = url()->full();
        $query = post::select('id','title','category_id','precios', 'condicion')->where('status', 'PUBLISHED')->whereBetween('precios', [200, 3000]);


        if ($condicion = $request->condicion) {
            $query->where('condicion', $condicion);
        }

        if($cat_id = $request->category_id){
            $query->where('category_id', $cat_id);
        }
      
        if ($orden = $request->orden) {
            if ($orden == "AAZ") {
                $query->OrderBy('title', 'ASC');

            }elseif($orden == "ZAA"){
                $query->OrderBy('title', 'DESC');

            }else{
                $query->OrderBy('precios', $orden);
            }
        }else{
            $query->orderBy('created_at', 'DESC');
        }                
        $post = $query->paginate(22)->setPath($url);
        
        $marcas     =  [];
        $modelos    =  [];
        $categorias =  [];
        $productos  =  []; 

        foreach ($post as $result) {
            $category = $result->category()->first();
            if ($category) {
                $catename = $category->name;
            }else{
                $catename = NULL;
            }
            $imagen   = $result->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();                                                      
                if ($imagen) {
                    $setImg = $imagen->imagen;
                    $storage = $imagen->storage;
                }else{
                    $setImg = NULL;
                    $storage = NULL;
                }
  
               if ($category) {
                    $categorias["category-".$category->id] = [
                        "id"=>$category->id,
                        "name"=>$category->name
                    ];
               }

               $productos[] = [
                    "id"=>$result->id,
                    "title"=>$result->title,
                    "precios"=>$result->precios,
                    "imagen"=>$setImg,
                    "storage"=>$storage,
                    "prdcatname"=>$catename,
                    "condicion"=>$result->condicion
               ];
        }

       return view('home.buenosprecios')            
            ->with('busqueda', str_slug($request->data, " "))
            ->with('marcas', $marcas)
            ->with('modelos', $modelos)
            ->with('paginate', $post)
            ->with('categorias', $categorias)
            ->with('productos', $productos);
    }

    public function generatesitemap()
    {
        $pub =post::select('posts.id', 'title', 'condicion', 'precios','categories.name')
            ->join('categories','posts.category_id','=','categories.id')
            ->where('status', 'PUBLISHED')
            ->orderBy('.posts.updated_at', 'DESC')
            ->take(1500)
            ->get();
        $comercios = tiendas::where('status', 1)->orderBy('updated_at', 'DESC')->take(60)->get();
        $categorias = category::orderBy('updated_at', 'DESC')->take(400)->get();
        
        $carbon = new \Carbon\Carbon(); 
        $now = $carbon->now();

        return view('home.sitemap')
         ->with('pub', $pub)
         ->with('now', $now)
         ->with('categorias', $categorias)
         ->with('comercios', $comercios);
    }

    public function contacto()
    {
        return view('home.contacto');
    }
    public function fomcontacto(Request $request)
    {
            $recaptcha = new \ReCaptcha\ReCaptcha(setting('site.ccdg'));
            $resp = $recaptcha->setExpectedHostname('ventastucuman.ddns.net')->verify($_POST["g-recaptcha-response"], $_SERVER["REMOTE_ADDR"]);

            if ($resp->isSuccess()) { 

                Mail::to(Voyager::setting('site.from'))
                    ->send(new contacto($request->name, $request->email, $request->detalle));

                return redirect()->back()->with(['status'=>'success', 'msg'=>'Su mensaje ha sido enviado con exito']);
            }else{
                $errors = $resp->getErrorCodes();
                return redirect()->back()->with(['status'=>'danger', 'msg'=>'Elcaptcha es obligatorio']);
            }
    }

}