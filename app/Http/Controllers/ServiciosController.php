<?php 
namespace App\Http\Controllers;
//use \App\Models\Servicios as servicios;
use Illuminate\Http\Request;
use \App\Models\Post as publicaciones;

class ServiciosController extends Controller
{
	
	
	public function index(Request $request)
	{
		$servicios = publicaciones::where('status', 'PUBLISHED')
			->where('category_id', 29);

		$serv = [];
		$cate = [];
		$cat_id = NULL;
		$cat_name = NULL;

		if ($cat_id = $request->category_id) {
			$servicios->where('subcategoryId', $cat_id);
			$cat_name = $request->name;
		}

		if ($name=$request->name) {
			$servicios->where("title", "LIKE","%".$name."%");
		}
		if ($orden=$request->orden) {
			$title="title";

			if ($orden=="AAZ") {
				$orden="ASC";
			}elseif ($orden=="ZAA") {
				$orden="DESC";
			}else{
				$orden=$orden;
				$title="precios";
			}

			$servicios->orderBy($title,$orden);
		}

        $url = url()->full();

		$render  = $servicios->paginate(12)->setPath($url);

		foreach ($render as $valores) {
			$categoria = $valores->subCategory()->first();
            $imagen =   $valores->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();                                                      

            if ($imagen) {
                $setImg = $imagen->imagen;
                $storage = $imagen->storage;
            }else{
                $setImg = NULL;
                $storage = NULL;
            }


			if ($categoria) {
				$cate["servcate".$categoria->id] = 
				[
					"id"=>$categoria->id,
					"name"=>$categoria->name
				];
			}

			$serv[] = [
				"id"=>$valores->id,
				"titulo"=>$valores->title,
				"foto"=>$setImg,
				'storage'=>$storage,
				"name"=>$categoria->name,
				"precios"=>$valores->precios,
				"condicion"=>$valores->condicion
			];

		}
		return view('servicios.index')
			->with('categorias', $cate)
			->with('paginate', $render)
			->with('filter_id', $cat_id)
			->with('filter_name', $cat_name)
			->with('servicios', $serv);
	}

}
