<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Response;
use Voyager;
use Auth;
use \App\Models\Incidencias as incidencias;

class IncidenciasController extends Controller
{

   public function index()
   {
        return view('auth.incidencias.index');
   }

   public function store(Request $request)
   {    
        $file = NULL;
        $user = Auth::user();

        if (!$user) {
            return Response()->json(['response'=>false]);
        }

        if ($request->archivo) {
            $archivo = $request->file('archivo');
            $file = Voyager::uploadFile($archivo, 'incidencias', 'archivo');
        }

        $addnew = new incidencias();
        $addnew->users_id = $user->id;
        $addnew->tipo = $request->tipo;
        $addnew->detalle = $request->detalle;
        $addnew->archivo = $file;
        $addnew->save();
       
       return redirect()->back()->with(['status'=>'success', 'msg'=>'Hemos recibido su reporte', 'operation_notif'=>'MUCHAS GRACIAS HEMOS RECIBIDO SU REPORTE']);

        
   }
}
