<?php

namespace App\Models;

use Eloquent as Model;

class Auspiciantes extends Model
{

    public $table = 'auspiciante';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'razon_social',
        'dni',
        'cuil_cuit'
    ];


    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'apellido' => 'string',
        'telefono'>='string',
        'email'=> 'string',
        'razon_social'=> 'string',
        'dni'=> 'string',
        'cuil_cuit'=> 'string'
    ];


    public static $rules = [
        
    ];

  
    public function pautasId()
    {
        return $this->hasMany(\App\Models\Pautas::class, 'auspiciante_id');
    }


}
