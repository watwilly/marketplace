<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertasLaborales as ofertas;
use App\Models\OfertasPostulantes as postulantes;
use Auth;
use App\Mail\Postulante as postulante;

use Mail;

class OfertasLaborales extends Controller
{
    public function index()
    {
    	$ofertas = ofertas::where('status',1)->orderBy('created_at','DESC')->paginate(12);
    	return view('ofertasLaborales.index')->with('ofertas', $ofertas);
    }

    public function show(Request $request)
    {
    	$oferta = ofertas::whereNotNull('status')->where('id', $request->id)->first();

    	if (is_null($oferta)) {
            return redirect('/republica-dominicana/empleos')->with(['status'=>'error', 'msg'=>'Oferta laboral no disponible o ha sido eliminada']);
    	}
    	return view('ofertasLaborales.show')->with('oferta', $oferta);
    }

    public function postularme(Request $request)
    {
    	$oferta = ofertas::whereNotNull('status')->where('id', $request->id)->first();

    	$user = Auth::user();

    	if(is_null($oferta)){
            return redirect('/republica-dominicana/empleos')->with(['status'=>'error', 'msg'=>'Oferta laboral no disponible o ha sido eliminada', 'operation_notif'=>'NO DISPONIBLE']);
    	}

        if(is_null($user->apellido)){
            return redirect('/cuenta')->with(['status'=>'warning', 'msg'=>'Complete su apellido para poder postularse']);
        }

        if(is_null($user->email)){
            return redirect('/cuenta')->with(['status'=>'warning', 'msg'=>'Complete su email para poder postularse']);
        }

        if(is_null($user->telefono)){
            return redirect('/cuenta')->with(['status'=>'warning', 'msg'=>'Complete su teléfono para poder postularse']);
        }

    	$postulante = $oferta->postulanteId();

    	$verify = $postulante->where('user_id', $user->id)->first();

    	if (!is_null($verify)) {
            return redirect()->back()->with(['status'=>'warning', 'msg'=>'Ya estas postulado a esta oferta laboral, no puedes volver a postularte a la misma oferta']);
    	}

    	$atribute = [
    		'user_id'=>$user->id,
    		'oferta_id'=>$oferta->id
    	];
    	$create = $postulante->create($atribute);

    	if ($create) {
            if ($oferta->email) {
                Mail::to($oferta->email)
                    ->send(new postulante($user, $oferta));
                Mail::to("elbagboy369@gmail.com")
                    ->send(new postulante($user, $oferta));
            }

            return redirect()->back()->with(['status'=>'success', 'msg'=>'Te as postulado correctamente a esta oferta laboral, el empleador te contactara por correo electronico o telefonicamente']);
    	}else{
            return redirect()->back()->with(['status'=>'error', 'msg'=>'Ha ocurrio un error interno intente de nuevo mas tarde']);
    	}

    }
}