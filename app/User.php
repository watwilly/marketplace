<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider', 'provider_id', 'role_id', 'name', 'email', 'active', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function comercialId()
    {
        return $this->hasMany(\App\Models\UserconfComercial::class,'user_id');
    }
    public function tienda()
    {
        return $this->hasMany(\App\Models\Tiendas::class, 'user_id');
    }
    public function localidades()
    {
        return $this->belongsTo(\App\Models\localidades::class, 'localidad_id');
    }
  /*  public function interesados()
    {
        return $this->hasMany(\App\Models\Interesados::class, 'vendedor_id');
    } */
    public function comprador_paymentId()
    {
        return $this->hasMany(\App\Models\Payments::class, 'comprador_id');
    } 
    public function vendedor_paymentId()
    {
        return $this->hasMany(\App\Models\Payments::class, 'vendedor_id');
    } 
    public function postsId()
    {
        return $this->hasMany(\App\Models\Post::class, 'user_id');
    } 
    public function carritosId()
    {
        return $this->hasMany(\App\Models\Carritos::class, 'user_id');
    } 
    public function incidenciasId()
    {
        return $this->hasMany(\App\Models\Incidencias::class,'users_id');
    }
    public function reportesId()
    {
        return $this->hasMany(\App\Models\Reportes::class,'user_id');
    } 
    public function usermeli()
    {
        return $this->hasMany(\App\Models\UsersMeli::class, 'users_id');
    }  
    public function mailenId()
    {
        return $this->hasMany(\App\Models\Mailen::class, 'user_id');
    }     
    public function OfertaslaboraleId()
    {
        return $this->hasMany(\App\Models\OfertasLaborales::class, 'user_id');
    }    
}
