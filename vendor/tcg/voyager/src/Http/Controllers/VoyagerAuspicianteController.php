<?php
namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use \App\Models\Auspiciantes as auspiciantes;
use \App\Models\Posiciones as posiciones;
use \App\Models\Pautas as pautas;

class VoyagerAuspicianteController extends Controller
{
	
	public function index(Request $request)
	{	
		$auspiciante = auspiciantes::where('id', $request->id)->first(); 
        if (is_null($auspiciante)) {
	        return back()->with([
	            'message'    => "Error, este auspiciante no existe en la base de datos con ese numero de ID",
	            'alert-type' => 'error',
	        ]);
        }
        $posiciones = posiciones::get();
        $pautas = $auspiciante->pautasId()->get();
        return view("voyager::auspiciante.index")
        	->with('posiciones', $posiciones)
        	->with('pautas', $pautas)
        	->with('auspiciante', $auspiciante);
	}	

	public function nuevaPauta(Request $request)
	{
		$auspiciante = auspiciantes::where('id', $request->id)->first(); 
        if (is_null($auspiciante)) {
	        return back()->with([
	            'message'    => "Error, este auspiciante no existe en la base de datos con ese numero de ID",
	            'alert-type' => 'error',
	        ]);
        }

        $desde = $request->desde;
        $hasta = $request->hasta;

        $disponibilidad = pautas::where('posicion_id', $request->posicion_id)
        	->whereDate('desde', '>=', $desde)
        	->whereDate('hasta', '<=', $hasta)->where('status', 1)->count();

        if ($disponibilidad > 0) {
	        return back()->with([
	            'message'    => "Espacio no disponible para la fecha ingresada",
	            'alert-type' => 'warning',
	        ]);
        }
        if ($request->hasFile('banner')){
            $file = $request->file('banner');
            $upload = Voyager::upload_image($file, 'pautas');
        }else{
	        return back()->with([
	            'message'    => "El banner es oblogatorio seleccione uno desde su computadora",
	            'alert-type' => 'error',
	        ]);        	
        }

        if ($request->hasFile('banner_responsive')) {
            $file_responsive = $request->file('banner_responsive');
            $banner_responsive = Voyager::upload_image($file_responsive, 'pautas');
        }else{
	        return back()->with([
	            'message'    => "El banner responsive es oblogatorio",
	            'alert-type' => 'error',
	        ]);        	
        }

        $atributos = [
        	"auspiciante_id"=>$request->id,
        	"posicion_id"=>$request->posicion_id,
        	"banner"=>$upload,
        	"desde"=>$desde,
        	"hasta"=>$hasta,
        	"status"=>1,
        	"banner_responsive"=>$banner_responsive,
        	"link"=>$request->link
        ];

        $create = pautas::create($atributos);
	    
	    if ($create) {
	        return back()->with([
	            'message'    => "La pauta ha sido creada se publicara a partir de la fecha DESDE",
	            'alert-type' => 'success',
	        ]); 
	    }else{
	        return back()->with([
	            'message'    => "Ocurrio un error al crear la PAUTA contacte al programador o intente de nuevo mas tarde",
	            'alert-type' => 'error',
	        ]); 	    	
	    }
	}

	public function changue_status(Request $request)
	{
		$pauta = pautas::where('id', $request->pauta_id)->first();

		if (is_null($pauta)) {
	        return back()->with([
	            'message'    => "Esta pauta no esta disponible o no pertenece a este auspiciante, reinicie session y intente de nuevo",
	            'alert-type' => 'error',
	        ]);
		}

		if ($request->status == "HABILITADO") {
			$pauta->status = 0;
		}elseif ($request->status == "DESHABILITADO") {
			$pauta->status = 1;
		}else{
        return back()->with([
            'message'    => "Este estado no esta permidio".$request->status,
            'alert-type' => 'error',
        ]);			
		}

		$pauta->save();
        return back()->with([
            'message'    => "El estado de la pauta ha sido modificado a".$request->status,
            'alert-type' => 'success',
        ]);
	}

	public function edit(Request $request)
	{
		$pauta = pautas::where('auspiciante_id', $request->auspiciante_id)
			->where('id', $request->pauta_id)->first();
	
		if (is_null($pauta)) {
	        return back()->with([
	            'message'    => "Esta pauta no esta disponible o no pertenece a este auspiciante, reinicie session y intente de nuevo",
	            'alert-type' => 'error',
	        ]);
		}
        $posiciones = posiciones::get();
        return view("voyager::auspiciante.editpauta")
        	->with('posiciones', $posiciones)
        	->with('pauta', $pauta);

	}

	public function update(Request $request)
	{
		$pauta = pautas::where('id', $request->pauta_id)->first();
		
        if ($request->hasFile('banner')){
            $file = $request->file('banner');
            $upload = Voyager::upload_image($file, 'pautas');
        	
        	$pauta->banner = $upload;
        }
        
        if ($request->hasFile('banner_responsive')) {
            $file_responsive = $request->file('banner_responsive');
            $banner_responsive = Voyager::upload_image($file_responsive, 'pautas');
        	
        	$pauta->banner_responsive = $banner_responsive;
        }
        $desde = $request->desde;
        $hasta = $request->hasta;

        if ($desde && $hasta) {
	        $disponibilidad = pautas::where('posicion_id', $request->posicion_id)
	        	->whereDate('desde', '>=', $desde)
	        	->whereDate('hasta', '<=', $hasta)
	        	->where('status', 1)->count();

	        if ($disponibilidad > 0) {
		        return back()->with([
		            'message'    => "Espacio no disponible para la fecha ingresada",
		            'alert-type' => 'warning',
		        ]);
	        }
        
	        $pauta->desde = $desde;
	        $pauta->hasta = $hasta;
        }


        $pauta->link = $request->link;
        $pauta->posicion_id = $request->posicion_id;
        $save = $pauta->save();

	    return back()->with([
	        'message'    => "Pauta actualizada correctamente",
	        'alert-type' => 'success',
	    ]);
	}
}