<?php 
namespace App\Http\Controllers;
use \App\Models\Tiendas as tiendas;
use Illuminate\Http\Request;
use \App\Models\Post as post;
use Session;

class ComerciosTiendasController extends Controller
{

	public function index()
	{
		$tiendas = tiendas::where('status', 1)->orderBy('created_at', 'DESC')->paginate(50);
		return view('comerciosTiendas.index')
			->with('tiendas', $tiendas);
	}

	public function show(Request $request)
	{
		$tienda = tiendas::select('tiendas.id', 'tiendas.user_id','tiendas.titulo','tiendas.logo', 'tiendas.banner','tiendas.descripcion', 'tiendas.direccion','categories.name')
      ->leftjoin('categories', 'tiendas.category_id', '=', 'categories.id')
      ->where('status', 1)->where('tiendas.id', $request->id)->first();
	
  	if (is_null($tienda)) {
      abort(404);
    }

    $postCount = $tienda->postsId()->count();

		$query = post::select('posts.id', "posts.condicion", 'posts.marca_id', 'posts.Modelos_id', 'posts.category_id', 'title','precios', 'ma.name as marca_name', 'mo.name as modelo_name', 'cat.name as categoria_name')
		->leftjoin('marcas as ma', 'posts.marca_id','=','ma.id')
		->leftjoin('modelos as mo', 'posts.Modelos_id','=', 'mo.id')
		->leftjoin('categories as cat', 'posts.category_id','=', 'cat.id')
		->where('posts.status', 'PUBLISHED');

    if ($postCount>0) {
      $query->where("tienda_id",$tienda->id);
    }else{
      $query->where('posts.user_id', $tienda->user_id);
    }
		
		

		if ($cat_id = $request->category) {
			$query->where('category_id', $cat_id);
		}
		if ($tc_condicion = Session::get('tcondicion')) {
			$query->where('condicion', $tc_condicion);
		}
		if ($tc_marca = Session::get('tcmarca')) {
			$query->where('marca_id', $tc_marca);
		}
		if ($tc_modelo = Session::get('tcmodelo')) {
			$query->where('Modelos_id', $tc_modelo);
		}
		if ($price_rangue = Session::get('tcprice_rangue')) {
			$query->where('precios', '<=', $price_rangue);
		}
        if ($orden = Session::get('tcOrden')) {
            if ($orden == "AAZ") {
                $query->OrderBy('title', 'ASC');

            }elseif($orden == "ZAA"){
                $query->OrderBy('title', 'DESC');

            }else{
                $query->OrderBy('precios', $orden);
            }
        }else{
            $query->orderBy('posts.created_at', 'DESC');
        }

		$post = $query->paginate(18);

        $marcas     =  [];
        $modelos    =  [];
        $categorias =  [];
        $productos  =  []; 

        if ($post->count() > 0) {
			foreach ($post as $posts) {
              	$imagen =  $posts->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();                                                      
                
                if ($imagen) {
                    $setImg = $imagen->imagen;
                    $storage = $imagen->storage;
                }else{
                    $setImg = NULL;
                    $storage = NULL;
                }

               	if ($moId = $posts->Modelos_id){
                    $modelos["modelo-".$moId] = [
                        "id"=>$moId,
                        "name"=>$posts->modelo_name
                    ];
               	}
               	if ($maId = $posts->marca_id){
                    $marcas["marca-".$maId] = [
                        "id"=>$maId,
                        "name"=>$posts->marca_name
                    ];
               	}
               	if ($catId = $posts->category_id) {
                    $categorias["category-".$catId] = [
                        "id"=>$catId,
                        "name"=>$posts->categoria_name
                    ];
               	}

               $productos[] = [
                    "id"=>$posts->id,
                    "title"=>$posts->title,
                    "precios"=>$posts->precios,
                    "imagen"=>$setImg,
                    "storage"=>$storage,
                    "prdcatname"=>$posts->categoria_name,
                    "condicion"=>$posts->condicion
               ];
			}
        }

        if (Session::get("scf")) {
          $categorias = Session::get("scf");
        }else{
          Session(["scf"=>$categorias]);
        }

		return view('comerciosTiendas.show')
			->with('tienda', $tienda)
			->with('marcas', $marcas)
			->with('modelos', $modelos)
			->with('render', $post)
			->with('categorias', $categorias)
			->with('publicaciones', $productos);
	}
}
