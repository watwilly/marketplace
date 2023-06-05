<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use \App\Models\Servicios as servicios;
use Voyager;
use Validator;

class ServiciosController extends Controller
{

  public function index()
  {	
  	$user = Auth::user();
    $buscar = NULL;
  	$servicios = servicios::where('users_id', $user->id)
  	->where('status', '!=', 'TRASH')
  	->paginate(10);
  	$categorias = \App\Models\Category::where('atributos', 'SERVICIOS')->orderBy('name', 'ASC')->get();
  	
  	return view('auth.servicios.index')
  		->with('categorias', $categorias)
      ->with('buscar', $buscar)
  		->with('servicios', $servicios);
  }

  public function store(Request $request)
  {
    
    $validation =  Validator::make($request->all(), [
      'category_id' => 'required',
      'titulo' => 'required',
      'descripcion' => 'required',
    ]);

    if($validation->fails()){
      return redirect()->back()->with(['operation_status'=>'error', 'operation_message'=>'Todos los campos son obligatorios', 'operation_notif'=>'LLENE TODOS LOS CAMPOS']);
    }

    $upload = NULL; 

    if ($request->hasFile('image')){
      $file = $request->file('image');
      $upload = Voyager::upload_image($file, 'servicios');
    }

    $atributos = [
      'users_id' => Auth::user()->id,
      'category_id' => $request->category_id,
      'titulo' => $request->titulo,
      'descripcion' => $request->descripcion,
      'status'=>'PUBLISHED',
      'foto'=>$upload
    ];

    $create = servicios::create($atributos);

    if ($create) {
      return redirect()->back()->with(['operation_status'=>'success', 'operation_message'=>'Servicio creado', 'operation_notif'=>'SE HA CREADO UN SERVICIO']);
    }else{
      return redirect()->back()->with(['operation_status'=>'error', 'operation_message'=>'Ocurrio un error intente mas tarde', 'operation_notif'=>'OCURRIO UN ERROR']);
    }

  }

  public function edit(Request $request)
  {
    $user = Auth::user();
    $servicio = $user->serviciosId()->where('id', $request->id)->first();
    return view('auth.servicios.edit')->with('servicio', $servicio);
  }

  public function update(Request $request)
  {
    $user = Auth::user();
    $servicio = $user->serviciosId()->where('id', $request->id)->first();
    $servicio->titulo = $request->titulo;
    $servicio->descripcion = $request->descripcion;
    $servicio->save();
    return redirect('/servicios')->with(['operation_status'=>'success', 'operation_message'=>'Servicio actualizado con exito', 'operation_notif'=>'SERVICIO ACTUALIZADO']);

  }

  public function status(Request $request)
  {
    $user = Auth::user();
    $servicio = $user->serviciosId()->where('id', $request->id)->first();
    $servicio->status = $request->status;
    $servicio->save();
  }

  public function autoload_servicios()
  {
    $user = Auth::user();
    $servicios = $user->serviciosId() ->where('status', '!=', 'TRASH')->paginate(10);
    
    return view('auth.servicios.listaservicios')
      ->with('servicios', $servicios);
  }
}
