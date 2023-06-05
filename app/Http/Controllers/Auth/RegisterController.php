<?php

namespace App\Http\Controllers\Auth;
require_once '../vendor/google/recaptcha/src/autoload.php';

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\USer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{


    use RegistersUsers;


    protected $redirectTo = '/first';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'apellido'=>['required','string','max:50'],
            'email' => ['required', 'string', 'email', 'max:40', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {   
        $recaptcha = new \ReCaptcha\ReCaptcha(setting('site.ccdg'));
        
        $resp = $recaptcha->setExpectedHostname('www.saldeello.com')->verify($_POST["g-recaptcha-response"], $_SERVER["REMOTE_ADDR"]);
        if ($resp->isSuccess()) {
            return USer::create([
                'name' => $data['name'],
                'apellido'=>$data['apellido'],
                'email' => $data['email'],
                'role_id'=>5,
                'password' => Hash::make($data['password']),
            ]);
        }else{
            $errors = $resp->getErrorCodes();
            return redirect()->back()->with(['status'=>'danger', 'msg'=>'El captcha es necesario', 'operation_notif'=>'EL CAPTCHA ES OBLIGATORIO']);
        }


    }
}
