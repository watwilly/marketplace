<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use Mail;
use \App\User as user;
use \App\Models\Plantillas as plantillas;
use \App\Models\Mailen as mailen;
use \App\Mail\Plantilla as send_mailen;

class VoyagerMailenController extends Controller
{
    public function index(Request $request)
    {   
        $plantillas = plantillas::orderBy('created_at','DESC')->get();
        $user = user::query();
        $user->select("users.id","users.email","users.name","users.apellido");

        if ($request->trueStore=="with-store") {
            $user->join('tiendas as t', 'users.id','=','t.user_id');
        }

        $url = url()->full();
        $data = $user->orderBy('users.email','DESC')->paginate(10)->setPath($url);

        return Voyager::view('voyager::users.mailen')
            ->with('plantillas',$plantillas)
            ->with('user',$data);
    }

    public function send(Request $request)
    {
        $selected = $request->selected;

        if (count($selected)==0) {
            return redirect()->back()->with([
                    'message'    =>"Seleccione a los usuario que le sera enviado el correo",
                    'alert-type' => 'warning',
            ]);
        }

        $plantilla=plantillas::where('id', $request->plantilla_id)->first();


        foreach ($selected as $data) {
            $a=explode(":", $data);

            if ($a[2]=="") {
                return redirect()->back()->with([
                        'message'    =>"Filtre seleccionando la plantilla para poder enviar el email",
                        'alert-type' => 'error',
                ]);
            }
            if (array_key_exists(0, $a) && array_key_exists(1, $a) && array_key_exists(2, $a) && array_key_exists(3, $a) && array_key_exists(4, $a)){
                
                $email=$a[0];
                $userId=$a[1];
                $plantillaId=$a[2];
                $name=$a[3];
                $apellido=$a[4];

                $co=mailen::where('user_id',$userId)->where('plantilla_id',$plantillaId)->first();

                if (is_null($co)) {
                    $send=Mail::to($email)
                        ->send(new send_mailen($name, $apellido, $email, $plantilla->titulo, $plantilla->imagen, $plantilla->texto));
                    $mailen = [
                        "user_id"=>$userId,
                        "plantilla_id"=>$plantillaId,
                        "notif"=>1
                    ];
                    $create=mailen::create($mailen);
                }

            }



            }
         return redirect()->back()->with([
                'message'    =>"Los email se enviaron segun plantilla seleccionada",
                'alert-type' => 'success',
        ]);


    }

}
