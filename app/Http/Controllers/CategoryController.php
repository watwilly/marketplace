<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Category as categorias;
use \App\Models\Marcas as marcas;
use Session;
use Voyager;
class CategoryController extends Controller
{
	
	public function index(Request $request)
	{	
		$getCategory = categorias::where('id', $request->id)->first();
		if (is_null($getCategory)) {
            return redirect()->back()->with(['operation_status'=>'error', 'operation_message'=>'Esta categoría no esta disponible por el momento', 'operation_notif'=>'CATEGORIA NO DOSPONIBLE']);
		}

		if (is_null($getCategory->parent_id)) {
			$pub = $getCategory->posts();
		}else{
			$pub = $getCategory->postpersubCategory();
		}	
		$pub->select('id','condicion','title','precios','category_id','subcategoryId','marca_id','Modelos_id');
		$pub->where('status', 'PUBLISHED');

		if ($cat_id = $request->category) {
			$pub->where('subcategoryId', $cat_id);
		}
		if ($cat_condicion = Session::get('catCondicion')) {
			$pub->where('condicion', $cat_condicion);
		}
		if ($cat_marca = Session::get('catMarca')) {
			$pub->where('marca_id', $cat_marca);
		}
		if ($cat_modelo = Session::get('catModelo')) {
			$pub->where('Modelos_id', $cat_modelo);
		}
		if ($price_rangue = Session::get('catPriceRangue')) {
			$pub->where('precios', '<=', $price_rangue);
		}
        if ($orden = Session::get('catOrden')) {
            if ($orden == "AAZ") {
                $pub->OrderBy('title', 'ASC');

            }elseif($orden == "ZAA"){
                $pub->OrderBy('title', 'DESC');

            }else{
                $pub->OrderBy('precios', $orden);
            }
        }else{
            $pub->orderBy('created_at', 'DESC');
        }
		$render = $pub->paginate(15);
       
        $marcas     =  [];
        $modelos    =  [];
        $categorias =  [];
        $productos  =  []; 

        if ($render->count() > 0) {
        	foreach ($render as $allpub) {
                $marca    = $allpub->marca()->first();
                $modelo   = $allpub->modelo()->first();
                $category = $allpub->subCategory()->first();
                $imagen =  $allpub->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();                                                      
                
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
               	}
               $productos[] = [
                    "id"=>$allpub->id,
                    "title"=>$allpub->title,
                    "precios"=>$allpub->precios,
                    "condicion"=>$allpub->condicion,
                    "imagen"=>$setImg,
                    "storage"=>$storage
               ];

        	}
        }
        $h1 = Voyager::get_pauta("cath1");
        $h2 = Voyager::get_pauta("cath2");

        $this->dropSearchSession();
        
        return view('category.index')
        ->with('productos', $productos)
        ->with("h1",$h1)
        ->with("h2",$h2)
        ->with('render', $render)
        ->with('category',$getCategory)
        ->with('marcas', $marcas)
        ->with('modelos',$modelos)
        ->with('categorias', $categorias);
	}


    public function all()
    {
        $parent = categorias::whereNull('parent_id')->orderBy('name', 'ASC')->get();
        $marcas = marcas::orderBy('name', 'ASC')->get();
        return view('category.all')
            ->with('marcas', $marcas)
            ->with('parent', $parent);
    }
}
