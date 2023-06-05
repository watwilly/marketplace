<?php 

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Voyager;
use \App\Models\Category as categoria;
use \App\Models\Tiendas as tienda;

class ComerciosController extends Controller
{
	public $categorias;

    function __construct()
    {
        $this->categorias = categoria::wherenull('parent_id')->orderBy('name','ASC')->get();
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->tienda()->select("tiendas.id","tiendas.titulo","tiendas.logo", "c.name", "c.id as cat_id","tiendas.status")
        ->leftjoin("categories as c","tiendas.category_id",'=','c.id');

        if ($request->titulo) {
            $query->where("titulo","LIKE","%".$request->titulo."%");
        }
        if ($request->category_id) {
            $query->where("tiendas.category_id",$request->category_id);
        }
        if ($orden=$request->orden) {
            $query->orderBy("titulo", $orden);
        }

        $userStore = $query->get();

        $tiendas=[];
        $categorias=[];

        foreach ($userStore as $tienda) {
            $tiendas[]=[
                "id"=>$tienda->id,
                "titulo"=>$tienda->titulo,
                "logo"=>$tienda->logo,
                "status"=>$tienda->status
            ];
            if ($tienda->cat_id) {
                $categorias["cat".$tienda->cat_id]=[
                    "id"=>$tienda->cat_id,
                    "name"=>$tienda->name
                ];
            }
        }

        return view('auth.tiendas.index')
            ->with('categorias',$categorias)
            ->with('tiendas', $tiendas)
            ->with('user', $user);
    }
    public function create()
    {
        return view("auth.tiendas.create")
            ->with("categorias",$this->categorias);
    }

    public function edit(Request $request)
    {   $user = Auth::user();
        $tienda = $user->tienda()->where("id",$request->id)->first();
        if (is_null($tienda)) {
            return redirect()->back()->with(["operation_status"=>"danger","operation_message"=>"La tienda que deseas editar no esta disponible"]);
        }
        $categorias=$this->categorias;
        return view("auth.tiendas.edit", compact("user","tienda","categorias"));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $tienda = $user->tienda()->where("id",$request->tienda_id)->first();
        
        if (is_null($tienda)) {
            $tienda =  new tienda();
        }

        if ($tienda&&$tienda->status == "rev") {
            $status="rev";
        }else{
            $status=0;
            if ($request->status=="on") {
                $status=1;
            }
        }


        $tienda->status = $status;

        if ($request->titulo) {
            $tienda->titulo = $request->titulo;
        }

        if ($request->direccion) {
            $tienda->direccion = $request->direccion;
        }
        if ($request->descripcion) {
            $tienda->descripcion = $request->descripcion;
        }
        if ($request->category_id) {
            $tienda->category_id=$request->category_id;
        }
        if ($request->hasFile('image')) {
             $banner = $request->file('image');
             $pathBanner = Voyager::upload_image($banner, 'banner');
             $tienda->banner = $pathBanner;
        }

        if ($request->hasFile('logo')) {
             $logo = $request->file('logo');
             $path = Voyager::upload_image($logo, 'logo');
             $tienda->logo = $path;
        }

        $user->tienda()->save($tienda);
        return redirect("/comercio")->with(['status'=>'success', 'msg'=>'Proceso realizado con exito']);
    }

    public function delete($id)
    {
        $user = Auth::user();

        $tienda=$user->tienda()->where('id',$id)->first();

        if (is_null($tienda)) {
            return redirect()->back()->with(['status'=>'error', 'msg'=>'Ocurrio un error intente de nuevo mas tarde', 'operation_notif'=>'ERROR AL ELIMINAR LA TIENDA']);
        }
        $posts=$tienda->postsId()->get();

        if ($posts->count()>0) {
            foreach ($posts as $post) {
                $post->tienda_id=NULL;
                $post->save();
            }
        }

        $delete = $tienda->delete();

        if ($delete) {
            return redirect()->back()->with(['status'=>'success', 'msg'=>'Su tienda ha sido eliminada con exito, puedes volver a crear otra', 'operation_notif'=>'TIENDA ELIMINADA']);
        }else{
            return redirect()->back()->with(['status'=>'error', 'msg'=>'Ocurrio un error al eliminar la tienda', 'operation_notif'=>'ERROR AL ELIMINAR LA TIENDA']);
        }

    }

    public function status(Request $request)
    {
        $user = Auth::user();
        $tienda = $user->tienda()->where("id",$request->id)->first();

        if (is_null($tienda)) {
            return response()->json(["status"=>"danger","msg"=>"La tienda que quieres modificar no se encuentra disponible"]);
        }

        $status = intval($request->status);

        if (is_string($status)) {
            return response()->json(["status"=>"error","msg"=>"No se puede aplicar este estado a la tienda"]);
        }

        $tienda->status=$status;
        $tienda->save();
        return response()->json(["status"=>"success","msg"=>"La tienda ha sido actualizada"]);
    }

}