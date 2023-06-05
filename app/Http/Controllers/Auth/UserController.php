<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Voyager;
use File;
use Hash;
use Mail;
use \App\User as user;
use \App\Mail\AccountValidate as accountvalidate;
use \App\Models\UserconfComercial as comercial;
use Illuminate\Support\Facades\Validator;
use \App\Mail\PerfilComercial as perfilcomercial;
use \App\Models\Payments as paid;

class UserController extends Controller
{
    public function dashboard()
    {
    	return view('dashboard.index');
    }


    public function index()
    {

        if (Auth::check()) {
            $usuario = Auth::user();

            return view('auth.user.cuenta')
            ->with('provincias', $this->get_all_provincias())
            ->with('user', $usuario);

        }else{
            return redirect('/');
        }
    }
 
    public function edit(Request $request)
    {


        $user = Auth::user();
        
        if ($request->newPassword) {
            $user->password = Hash::make($request->newPassword);
        }

        if ($email = $request->email) {
            Validator::make($request->input(), [
                'email' => ['unique:users'],
            ])->validate();
            $user->email = $email;
        }
        if ($name = $request->name) {
            $user->name = $name;
        }
        if ($apellido = $request->apellido) {
            $user->apellido = $apellido;
        }
        if ($telefono = $request->telefono) {
            $user->telefono = $telefono;
        }
        if ($direccion = $request->direccion) {
            $user->direccion = $direccion;
        }
        if ($provincia_id = $request->provincia_id) {
            $user->provincia_id = $provincia_id;
        }
        if ($localidad_id = $request->localidad_id) {
            $user->localidad_id = $localidad_id;
        }

        if ($empresa = $request->empresa) {
            $user->empresa = $empresa;
        }
        if ($cuit = $request->cuit) {

            if ($cuit <> $user->cuit) {
                Validator::make($request->input(), [
                    'cuit' => ['unique:users'],
                ])->validate();
            }

            $user->cuit = $cuit;
        }

        if ($cpa = $request->cpa) {
            $user->cpa = $cpa;
        }


        $user->save();

        return redirect()->back()->with(['status'=>'success', 'msg'=>'Su cuenta ha sido modificada']);

    }

    public function validate_account(Request $request)
    {
        $user = user::where('email', $request->email)->whereNull('active')->first();

        if (is_null($user)) {
            return redirect('/validate/false');
        }

        $user->active = 1;
        $user->save();

        return redirect('/validate/true');
    }

    public function validateAccount(Request $request)
    {
        return view('user.validate')->with('status',$request->status);
    }

    public function emailvalidate()
    {
       $user = Auth::user();
       if ($user->active==0) {
        $data=[
            "email"=>$user->email,
            "name"=>$user->name,
            "apellido"=>$user->apellido,
            "_token"=>"RE-VALIDATE"
        ];
        Mail::to($user->email)
            ->send(new accountvalidate($data));
        return response()->json(["status"=>"info","msg"=>"Se ha enviado un email a su correo para validar su cuenta"]);
       }

       return response()->json(["status"=>"success","msg"=>"El usuario ya esta validado"]);
    }

    public function first()
    {
        $user = Auth::user();

        return view('shared.first')
        ->with('user',$user);
    }
}
