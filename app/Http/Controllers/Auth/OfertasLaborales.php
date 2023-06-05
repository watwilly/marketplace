<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use \App\Models\OfertasLaborales as ofertas;
use Illuminate\Support\Facades\Validator;
use Voyager;

class OfertasLaborales extends Controller
{
    public function index()
    {
     $user = Auth::user();

     $ofertas = $user->OfertaslaboraleId()->whereNotNull('status')->paginate(12);

     $buscar = null;
     return view('auth.ofertas_laborales.index')
     	->with('ofertas', $ofertas)
     	->with('buscar', $buscar);

    }

    public function addoferta(Request $request)
    {   

        $imagen = null;
        if ($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $imagen = Voyager::upload_image($file, 'laboral');
        }
        $validate = $request->validate([
            'puesto' => ['required'],
            'vacantes'=>['required'],
            'titulo' => ['required'],
        ]);   

        $user = Auth::user();

        $atribute = [
            'puesto' => $request->puesto,
            'vacantes'=>$request->vacantes,
            'direccion' =>$request->direccion,
            'email' => $request->email,
            'descripcion' =>$request->descripcion,
            'titulo' =>$request->titulo,
            'imagen'=>$imagen
        ];

        $create = $user->OfertaslaboraleId()->create($atribute);

        if ($create) {
            return redirect()->back()->with(['status'=>'success', 'msg'=>'Su oferta laboral ha sido creada con exito']);
        }else{
            return redirect()->back()->with(['status'=>'error', 'msg'=>'Ocurrio un error intente de nuevo mas tarde']);

        }
    }

    public function status(Request $request)
    {
        $user = Auth::user();

        $oferta = $user->OfertaslaboraleId()->where('id', $request->id)->first();

        if (is_null($oferta)) {
            return redirect()->back()->with(['status'=>'warning', 'msg'=>'Esta publicacion no esta disponible intente de nuevo mas tarde', 'operation_notif'=>'OFERTA NO DISPONIBLE']);
        }

        if ($request->status == 'end') {
        	$status = 0;
        }elseif ($request->status == 'start') {
        	$status = 1;
        }elseif ($request->status == 'trash') {
        	$status = null;
        }

        $oferta->status = $status;
        $update = $oferta->save();

        if ($update) {
            return redirect()->back()->with(['status'=>'success', 'msg'=>'Operacion realizada correctamente', 'operation_notif'=>'OPERACION REALIZADA CORRECTAMENTE']);
        }else{

            return redirect()->back()->with(['status'=>'success', 'msg'=>'Ocurrio un error y estamos trabajando para resolverlo', 'operation_notif'=>'OCURRIO UN ERROR']);
        }

    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $oferta = $user->OfertaslaboraleId()->where('id', $request->id)->first();
        
        if (is_null($oferta)) {
            return redirect()->back()->with(['status'=>'warning', 'msg'=>'Esta publicacion no esta disponible intente de nuevo mas tarde', 'operation_notif'=>'OFERTA NO DISPONIBLE']);
        }

        return view('auth.ofertas_laborales.edit')->with('oferta', $oferta);
    }

    public function update(Request $request)
    {


        $user = Auth::user();
        $oferta = $user->OfertaslaboraleId()->where('id', $request->id)->first();

        if (is_null($oferta)) {
            return redirect()->back()->with(['status'=>'error', 'msg'=>'Esta oferta no esta disponible']);
        }

        if ($request->puesto) {
            $oferta->puesto=$request->puesto;
        }
        if ($request->vacantes) {
            $oferta->vacantes=$request->vacantes;
        }
        if ($request->direccion) {
            $oferta->direccion=$request->direccion;
        }
        if ($request->email) {
            $oferta->email=$request->email;
        }
        if ($request->descripcion) {
            $oferta->descripcion=$request->descripcion;
        }
        if ($request->titulo) {
            $oferta->titulo=$request->titulo;
        }

        if ($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $imagen = Voyager::upload_image($file, 'laboral');
            $oferta->imagen=$imagen;
        }

        $update = $oferta->save();
        if ($update) {
            return redirect()->back()->with(['status'=>'success', 'msg'=>'Operación realizada correctamente', 'operation_notif'=>'OPERACION REALIZADA CORRECTAMENTE']);
        }else{
            return redirect()->back()->with(['status'=>'success', 'msg'=>'Ocurrió un error y estamos trabajando para resolverlo', 'operation_notif'=>'OCURRIO UN ERROR']);
        }

    }

    public function postulantes(Request $request)
    {
        $user = Auth::user();
        $oferta = $user->OfertaslaboraleId()->where('id', $request->id)->first();
        if (is_null($oferta)) {
            return redirect()->back()->with(['operation_status'=>'warning', 'operation_message'=>'Esta publicación no esta disponible intente de nuevo mas tarde', 'operation_notif'=>'OFERTA NO DISPONIBLE']);
        }

        $postulantes = $oferta->postulanteId()->get();

        return view('auth.ofertas_laborales.postulantes')->with('oferta', $oferta)->with('postulantes', $postulantes);
    }

    public function descartar(Request $request)
    {
        $user = Auth::user();
        $oferta = $user->OfertaslaboraleId()->where('id', $request->oferta_id)->first();
        if (is_null($oferta)) {
            return redirect()->back()->with(['operation_status'=>'warning', 'operation_message'=>'Esta publicación no esta disponible intente de nuevo mas tarde', 'operation_notif'=>'OFERTA NO DISPONIBLE']);
        }

        $oferta_postulante = $oferta->postulanteId()->where('id', $request->postulante_id)->first();

        if (is_null($oferta_postulante)) {
            return redirect()->back()->with(['operation_status'=>'error', 'operation_message'=>'No puedes realizar esta operación cierre sección y intente de nuevo', 'operation_notif'=>'OCURRIO UN ERROR']);
        }

        $oferta_postulante->estado = 'DESCARTADO';
        $save = $oferta_postulante->save();

        if ($save) {
            return redirect()->back()->with(['operation_status'=>'success', 'operation_message'=>'Se ha descartado este postulante', 'operation_notif'=>'DESCARTADO']);
        }else{
            return redirect()->back()->with(['operation_status'=>'error', 'operation_message'=>'No puedes realizar esta operación cierre sección y intente de nuevo', 'operation_notif'=>'OCURRIO UN ERROR']);
        }
    }
}
