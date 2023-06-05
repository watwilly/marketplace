<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class USer extends Authenticatable
{
    use Notifiable;
    public $table = 'users';

    protected $fillable = [
         'name', 'email', 'password', 'role_id','apellido'
    ];

  
    protected $hidden = [
        'password', 'remember_token',
    ];

 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function serviciosId()
    {
        return $this->hasMany(\App\Models\Servicios::class,'users_id');
    }
    public function tienda()
    {
        return $this->hasMany(\App\Models\Tiendas::class, 'user_id');
    }
    public function localidades()
    {
        return $this->belongsTo(\App\Models\localidades::class, 'localidad_id');
    }
    public function interesados()
    {
        return $this->hasMany(\App\Models\Interesados::class, 'vendedor_id');
    } 
    public function postsId()
    {
        return $this->hasMany(\App\Models\Post::class, 'user_id');
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
}
