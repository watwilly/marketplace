<?php

namespace App\Models;

use Eloquent as Model;

class OfertasLaborales extends Model
{

    public $table = 'ofertas_laborales';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'puesto',
        'vacantes',
        'direccion',
        'email',
        'descripcion',
        'tipo_solicitud',
        'status',
        'titulo',
        'imagen'
    ];


    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'puesto' => 'string',
        'vacantes' => 'integer',
        'direccion'=>'string',
        'email'=>'string',
        'descripcion'=>'string',
        'tipo_solicitud'=>'string',
        'status'=>'integer',
        'titulo'=>'string'
    ];


    public static $rules = [
        
    ];
    public function userId()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    public function postulanteId()
    {
        return $this->hasMany(\App\Models\OfertasPostulantes::class, 'oferta_id');
    } 
}
