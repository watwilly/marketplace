<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use \App\Models\Post as publicaciones;
use \App\Models\Category as categorias;
use \App\Models\Colores as colores;
use \App\Models\TiposVehiculos as tiposvehiculos;
use \App\Models\PostsVehiculos as postvehiculos;
use \App\Models\CategoryMarcas as categorymarcas;
use \App\Models\Talles as talles;
use \App\Models\MarcasModelos as marcasmodelos;
use \App\Models\PostsColores as postscolores;
use \App\Models\PostsTalles as poststalles;
use \App\Models\PostImagenes as postimagenes;
use Voyager;
use Auth;


class PostController extends Controller
{
    public function ventas(Request $request)
    {
     	$publicaciones = publicaciones::query();
     	$user = Auth::user();

     	$publicaciones->where('user_id', $user->id);
     	$publicaciones->where('status', '<>', 'DRAFT');

     	if ($name=$request->buscar) {
           $publicaciones->where('title', 'like', '%'.$name.'%');
     	}
        if ($category_id=$request->category_id) {
           $publicaciones->where('category_id',$category_id);
        }
        if ($orden=$request->orden) {
            $publicaciones->orderBy('precios', $orden);
        }else{
            $publicaciones->orderBy('created_at', "DESC");

        }

        $query = $publicaciones->paginate(24);

        $categorias=categorias::wherenull("parent_id")->get();
        return view('auth.publicaciones.index')
          ->with('categorias', $categorias)
          ->with('buscar', $request->buscar)
          ->with('publicaciones',  $query);
    }

    public function vender($value='')
    {
        $categorias = categorias::whereNull('parent_id')->get(); 
        $user = Auth::user();
        $cant_pub = $user->postsId()->count();
        $tiendas = $user->tienda()->where("status",1)->get();

         return view('auth.publicaciones.formPublicar')
          ->with('user', $user)
          ->with('cant_pub', $cant_pub)
          ->with('tiendas',$tiendas)
          ->with('listCategorias', $categorias );        
    }

    public function lista_subcategoria(Request $request)
    {

        if ($request->elegido == 'servicios') {
            $category = categorias::where('atributos', 'SERVICIOS')->get();
        }else{
            $category = categorias::where('parent_id', $request->elegido)->get();
        }
        return view('shared.subCategory')->with('categoria', $category);
    }

    public function tiposvehiculos(Request $request)
    {
        $colores = colores::get();
        $tipo = TiposVehiculos::get();

        $edivehiculo = null;

        if ($request->edit) {
            $edivehiculo = postvehiculos::where('posts_id', $request->edit)->first();
        }
        return view('shared.tipos_vehiculos')
            ->with('colores', $colores)
            ->with('editvehiculo', $edivehiculo)
            ->with('tipo', $tipo);        
    }

    public function lista_marca(Request $request)
    {
        $get_marca = categorymarcas::where('category_id', $request->elegido)->get();
        return view('shared.listadoMarcas')->with('marca', $get_marca);
    }

    public function getAtributos(Request $request)
    {
        $categoryAtributo = categorias::where('id', $request->elegido)->where('atributos', 'SI')->first();
        $talle = new talles();
        $colores = new colores();

        return view('shared.getAtributos')
        ->with('talles', $talle)->with('colores', $colores)
        ->with('haveAtribute', $categoryAtributo);
    }

    public function lista_modelos(Request $request)
    {
        $modelo = marcasmodelos::where('marcas_id', $request->elegido)->get();
        return view('shared.listaModelos')->with('modelo', $modelo);
    }
   
    public function store(Request $request)
    {
        $vencimiento = voyager::vencimiento(90);
        $user = Auth::user();
        $post = new publicaciones();

        $validate = $request->validate([
            'category_id' => ['required', 'integer'],
            'condicion' => ['required', 'string'],
            'title' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'image' => ['required'],
        ]);
        if (!$request->precio && !$request->withoutprice) {
         return redirect()->back()->with(['status'=>'danger', 'msg'=>'Por favor ingrese un precio o marque la opcion de publicar sin precio', 'operation_notif'=>'ERROR EL PRECIO NO PUEDE SER 0 o 1']);
        }
    
        if($request->withoutprice){
            $precio = 1;
        }else{
            $precio = $request->precio;
        }

            $post->user_id = $user->id;
            $post->category_id = $request->category_id;
            $post->subcategoryId = $request->subcategoryId;
            if ($request->marca_id) {
                $post->marca_id = $request->marca_id;
            }
            if ($request->modelo_id) {
                $post->Modelos_id = $request->modelo_id;
            }
            if ($tienda_id=$request->tienda_id) {
                $post->tienda_id=$tienda_id;
            }
            $post->provincia_id = $user->provincia_id;
            $post->localidad_id = $user->localidad_id;
            $post->title = $request->title;
            $post->body = $request->descripcion;
            $post->precios = $precio;
            if ($request->cantidad) {
                $post->cantidad = $request->cantidad;
            }
            $post->status = 'PUBLISHED';
            $post->condicion = $request->condicion;
            $post->fecha_vencimiento = $vencimiento;

            $post->save();

            if ($request->colore) {
                foreach ($request->colore as $color_id) {
                    $postColor = new postscolores();
                    $postColor->color_id = $color_id;
                    $post->postscolores()->save($postColor);
                }           
            }
            if ($request->talle) {
                foreach ($request->talle as $talles_id) {
                    $postTalle = new poststalles();
                    $postTalle->talle_id = $talles_id;
                    $post->poststalles()->save($postTalle);
                }
            }
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $count_imagenes = count($file);
            foreach ($file as  $imagenes) {
                $upload = Voyager::upload_image($imagenes, 'post');
                $insertImagenes  = new postimagenes();
                $insertImagenes->imagen = $upload;
                $insertImagenes->status = 1;
                $post->postimagenes()->save($insertImagenes);
            }
        }

        if ($request->category_id == 6) {
            $postsVehicles = new postvehiculos();
            $postsVehicles->kilometros = $request->kilometros;
            $postsVehicles->anio = $request->anio;
            $postsVehicles->transmision = $request->transmision;
            $postsVehicles->colores_id = $request->colores_id;
            $postsVehicles->tipos_vehiculos_id = $request->tipos_vehiculos_id;
            $post->postsvehiculos()->save($postsVehicles);
        }

        return redirect('/ventas');
    }

    public function change_status(Request $request)
    {   
        $user = Auth::user();
        $publicacion = publicaciones::where('id', $request->id)
            ->where('user_id', $user->id)->first();

        if ($publicacion->user_id <> $user->id) {
            return response()->json(["response"=>false]);
        }

        if (is_null($publicacion)) {
            return response()->json(["response"=>false]);
        }

        if ($request->status == 0) {
          
          $status = "CANCELLED";

        }else{

          if ($publicacion->status == "PUBLISHED") {
              
              $status = "PENDING";
      
          }elseif ($publicacion->status == "PENDING") {
            
              $status = "PUBLISHED";
          }
        }

        $publicacion->status = $status;
        $update = $publicacion->save();
      
        if ($update) {
          return response()->json(["response"=>true]);
        }else{
          return response()->json(["response"=>0 ]);
        }
    }
    public function detroy(Request $request)
    {

          $post = publicaciones::select('id', 'status' )->where('id', $request->post_id)
            ->where('user_id', Auth::user()->id)->first();

          if (is_null($post)) {
            return response()->json(["response"=>false]);
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
              return response()->json(["response"=>true]);
            
          } elseif ($delete == false) {
              return response()->json(["response"=>false]);
              
          }
    }
    public function  publicacionAtributos($post_id)
    {
        
        $post = publicaciones::where('id', $post_id)->first();
        $talle = $post->poststalles()->get();
        $colores = $post->postscolores()->get();

        return view('auth.publicaciones.publicacionAtributos')->with('post', $post)
        ->with('talle', $talle)->with('colores', $colores);
    }

    public function quitAtributo(Request $request)
    {   
        $user = Auth::user();

        $publicacion = publicaciones::where('user_id', $user->id)
            ->where('id', $request->post_id)->first();

        if (is_null($publicacion)) {
             return response()->json(['status'=>false]);
        }
        if ($request->atribute == 'talle') {
            $poststalles  = $publicacion->poststalles()->where('id', $request->atributo_id)->delete();
        }elseif ($request->atribute == 'color') {
            $postscolores  = $publicacion->postscolores()->where('id', $request->atributo_id)->delete();
        }
        return response()->json(['status'=>true]);
    }

    public function edit(Request $request)
    {   
        $user = Auth::user();
        $tiendas = $user->tienda()->where("status",1)->get();
        $post = publicaciones::where('id', $request->id)->where('user_id', $user->id)->first();
        $imagenes = $post->postimagenes()->orderBy("orden","ASC")->get();
        $vehiculos = $post->postsvehiculos()->get();

        return view('auth.publicaciones.edit')
            ->with("edit", $post)
            ->with("tiendas",$tiendas)
            ->with('imagenes', $imagenes)
            ->with('vehiculos', $vehiculos);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $publicacion = publicaciones::where('id', $request->publicacion_id)->where('user_id', $user->id)->first();
        $category_id = $publicacion->category_id;

        if (is_null($publicacion)) {
         return redirect()->back()->with(['status'=>'danger', 'msg'=>'Ocurrio un error intente mas tarde', 'operation_notif'=>'ERROR']);
        }

        $status="PENDING";
        if ($request->status=="on") {
            $status="PUBLISHED";
        }

        if ($tienda_id=$request->tienda_id) {
            $publicacion->tienda_id=$tienda_id;
        }
            
        if($request->withoutprice){
            $precio = 1;
        }else{
            $precio = $request->precio;
        }
        $publicacion->status = $status;
        $publicacion->title = $request->title;
        $publicacion->precios = $precio;
        $publicacion->cantidad = $request->cantidad;
        $publicacion->condicion = $request->condicion;
        $publicacion->body = $request->body;


        $update = $publicacion->save();

        if ($category_id == 6) {
            $postsVehicles = $publicacion->postsvehiculos()->first();
            if ($postsVehicles) {
                $updateatribute = [
                    'anio' => $request->anio,
                    'kilometros' => $request->kilometros
                ];
                $postsVehicles->update($updateatribute);
            }

        }

        if ($request->hasFile('image_edit')){
            $file = $request->file('image_edit');
            foreach ($file as  $imagenes) {
                $upload = Voyager::upload_image($imagenes, 'post');
                $insertImagenes  = new postimagenes();
                $insertImagenes->imagen = $upload;
                $insertImagenes->status = 1;
                $publicacion->postimagenes()->save($insertImagenes);
            }
        }

        return redirect()->back()->with(['status'=>'success', 'msg'=>'Su publicacion ha sido modificada', 'operation_notif'=>'OPERACION REALIZADA']);
    }

    public function delete_image(Request $request)
    {   
        
        $imagen = postimagenes::where('id', $request->id)->first();
        $arrays = [
            "me" => "medium",                    
            "mn" => "mini",
            "sm" => "small"
        ];
        $find = explode(".", $imagen->imagen);
        $type = end($find);
        $filename = basename($imagen->imagen, $type);
        $filename = str_replace(".", "", $filename);
        $dir = dirname($imagen->imagen);
                
        foreach ($arrays as $crop) {
           $resultImgane = $dir.DIRECTORY_SEPARATOR.$filename.'-'.$crop.'.'.$type;
            $this->deleteFileIfExists($resultImgane);
        }

        $this->deleteFileIfExists($imagen->imagen);

        $imagen->delete();

        return response()->json(['response'=>true]);
    }




}