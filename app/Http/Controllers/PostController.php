<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post as post;
use \App\Models\Tiendas as tiendas;
use App\Mail\interesados as emailInteresados;
use App\Mail\reportes as emailreportes;
use \App\Models\Interesados as interesados;
use \App\Models\Reportes as reportes;
use Session;
use Auth;
use Mail;
use Voyager;

class PostController extends Controller
{
	
	public function show(Request $request)
	{  
        $publicacion = post::select('posts.id', 'posts.user_id','posts.category_id','subcategoryId','marca_id','Modelos_id','title','body','precios','cantidad','condicion', 'categories.name as category_name', 'getsubcat.name as subcategory_name', 'posts.created_at', 'ma.name as ma_name', 'mo.name as mo_name', 'u.telefono', 'prov.provincia', 'loc.localidad')
        ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
        ->join('users as u', 'posts.user_id', '=', 'u.id')
        ->leftJoin('categories as getsubcat', 'posts.subcategoryId', '=', 'getsubcat.id')
        ->leftJoin('marcas as ma', 'posts.marca_id', '=', 'ma.id')
        ->leftJoin('modelos as mo', 'posts.Modelos_id', '=', 'mo.id')
        ->leftJoin('provincias as prov', 'u.provincia_id', '=', 'prov.id')
        ->leftJoin('localidades as loc', 'u.localidad_id', '=', 'loc.id')
        ->where('posts.id', $request->id)->where('status', 'PUBLISHED')->take(1)->first();
       
        if (is_null($publicacion)) {
            return redirect('/')->with(['status'=>'danger', 'msg'=>'Producto no disponible o ha sido eliminado', 'operation_notif'=>'PUBLICACION NO DISPONIBLE']);
        }

        $talles = $publicacion->poststalles()->get();
        $colores = $publicacion->postscolores()->get();
        $imagenes = $publicacion->postimagenes()->select('id','imagen', 'storage')->orderBy("orden","ASC")->take(6)->get();

        if (!is_null($publicacion->subcategoryId)) {
            Session::put(['interest'=>$publicacion->subcategoryId]);
        }

        $simil = post::select('posts.id', 'title', 'condicion','precios', 'categories.name')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->where('posts.status', 'PUBLISHED')
        ->where('posts.id', '!=', $request->id)
        ->where('category_id', $publicacion->category_id)
        ->orderBy('posts.updated_at', 'DESC')->take(12)->get();

        $consultas = $publicacion->interesadosId()->orderBy("created_at", 'DESC')->get();
		$tienda = tiendas::where('user_id', $publicacion->user_id)->where('status',1)->first();

        $visit = $publicacion->postvisitas()->take(1)->lockForUpdate();
        $cantidad = NULL;        
        if ($visit->count() > 0) {
        	$update = $visit->first();
        	$update->cant_visita = $update->cant_visita + 1;
        	$update->save();
            $cantidad = $update->cant_visita;
        }else{
        	$atribute = [
        		"cant_visita" => 1
        	];
        	$visit->create($atribute);
        }
        $h1 = Voyager::get_pauta("prdh1");
        $v1 = Voyager::get_pauta("prdv1");
        

        $this->dropallsession();

        return view('post.show')
        	->with('post', $publicacion)
            ->with('talles', $talles)
            ->with("h1",$h1)
            ->with("v1",$v1)
            ->with('colores', $colores)
            ->with('tienda', $tienda)
            ->with("consultas",$consultas)
            ->with("simil",$simil)
            ->with('cant_visitas',$cantidad )
            ->with('imagenes', $imagenes);

	}

   /* public function simil(Request $request)
    {
        $post = post::select('posts.id', 'title', 'category_id', 'precios','categories.name')
               ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->where('posts.id', $request->post_id)->first();

        if ($request->msg_id) {
            $simil = post::select('posts.id', 'title', 'precios', 'categories.name')->where('category_id', $post->category_id)
               ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->where('status', 'PUBLISHED')
                ->orderBy('posts.id', 'DESC');
           $result =  $simil->skip($request->start)->limit($request->limit)->orderBy('precios', 'ASC')->get();
           return view('post.ajaxsimil')->with('result', $result);
        }
        return view('post.simil')
            ->with('posts', $post);
    }*/

   /* public function contact_seller(Request $request)
    {

        $user = Auth::user();
        $email = $user->email;
        $nombre = $user->name."\t".$user->apellido;
        $telefono = $user->telefono;

        $post = post::where('id', $request->post_id)->first();

        if (is_null($post)) {
            return redirect('/')->with(['operation_status'=>'error', 'operation_message'=>'Producto no disponible o ha sido eliminado', 'operation_notif'=>'PUBLICACION NO DISPONIBLE']);
        }
        $vendedor = $post->user()->select('id','name','email','apellido')->first();


        Mail::to($vendedor->email)
            ->send(new emailInteresados($nombre, $email, $vendedor->name, $vendedor->apellido, $post->title, $post->id, $request->mensaje, $telefono));
        
        $atributos = [            
            'post_id'=>$post->id,
            'vendedor_id'=>$vendedor->id,
            'nombre'=>$nombre,
            'email'=>$email,
            'mensaje'=>$request->mensaje,
            'telefono'=>$telefono
        ];

        $create = interesados::create($atributos);
        return redirect()->back()->with(['operation_status'=>'success', 'operation_message'=>'Su consulta ha sido enviada al vendedor, se pondrá en contacto a tu email o teléfono', 'operation_notif'=>'MENSAJE ENVIADO']);
    }*/

    public function reportes(Request $request)
    {
        if ($request->detalle_reporte) {
            $post = post::select('id', 'user_id')->where('id', $request->post_id)->first();
            if (is_null($post)) {
                return redirect('/')->with(['status'=>'danger', 'msg'=>'Producto no disponible o ha sido eliminado']);
            }

            $atributos = [
                "user_id"=>$post->user_id,
                "post_id"=>$post->id,
                "detalle_reporte"=>$request->detalle_reporte
            ];

            $create = reportes::create($atributos);

            if ($create) {
            Mail::to(Voyager::setting('site.from'))
                ->send(new emailreportes($post->id, $post->user_id, $request->detalle_reporte));
                return redirect()->back()->with(['status'=>'success', 'msg'=>'Gracias por ayudarnos a controlar los contenidos de nuestro sitio, a la brevedad revisaremos tu reporte.']);
            }else{
                return redirect()->back()->with(['status'=>'danger', 'msg'=>'Ocurrio un error interno intente de nuevo mas tarde']);
            }

        }else{
            return redirect()->back()->with(['status'=>'danger', 'msg'=>'Ingrese el motivo por el cual reporta esta publicacion como inadecuada']);
        }
    }
}