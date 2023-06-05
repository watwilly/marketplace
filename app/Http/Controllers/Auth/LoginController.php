<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use \App\User as User;
use Hash;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider($provider)  
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            abort(403, 'Unauthorized action.');
            return redirect()->to('/');
        }
        $attributes = [
            'provider' => $provider,
            'provider_id' => $user->getId(),
            'role_id'=>5,
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'active'=>1
        ];
        
        
        $userdb = User::where('email', $user->getEmail())->first();
        if (!$userdb){
            $userdb = User::where('provider_id',$user->getId())->first();
            if (!$userdb) {
                try{
                    $userdb = User::create($attributes);
                }catch (ValidationException $e){
                  return redirect()->to('/login');
                }
            }
        }
        
        return $this->authAndRedirect($userdb); // Login y redirección
    }
    public function authAndRedirect($user)
    {
        Auth::login($user);

        $user = Auth::user();

        $date = $user->created_at->todateString();

        $carbon = new \Carbon\Carbon(); 
        $now = $carbon->now()->todateString();

        if ($date ==$now) {
            return redirect()->to('/first');
        }

        return redirect()->to('/dashboard');
    }

    public function ingresar()
    {   
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('user.login');
    }
}
