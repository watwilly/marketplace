<?php

namespace App\Models;

use Eloquent as Model;


class UserconfComercial extends Model
{

    public $table = 'user_conf_comercial';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'rsocial',
        'cuit',
        'ingbruto',
        'telefono',
        'direccion',
        'horario',
        'email',
        'estado_solicitud',
        'motivo'
    ];
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'rsocial' => 'string',
        'cuit' => 'string',
        'ingbruto' => 'string',
        'telefono' => 'string',
        'direccion' => 'string',
        'horario' => 'string',
        'email' => 'string',
        'estado_solicitud' => 'string',
        'motivo' => 'string',
    ];

    public static $rules = [
        
    ];
    public function userId()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    } 
}
