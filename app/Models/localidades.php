<?php

namespace App\Models;

use Eloquent as Model;


class localidades extends Model
{

    public $table = 'localidades';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'provincias_id',
        'localidad'
    ];

    protected $casts = [
        'id' => 'integer',
        'provincias_id' => 'integer',
        'localidad' => 'string'
    ];


    public static $rules = [
        
    ];

    public function  provincias()
    {
        return $this->belongsTo(\App\Models\provincias::class);
    }

    public function  provinciasId()
    {
        return $this->belongsTo(\App\Models\provincias::class, 'provincias_id');
    }
    static function  GetUbicacionperLocalidad($localidad_id)
    {
        $localidad = \App\Models\localidades::select('id', 'localidad')
            ->where('id', $localidad_id)
            ->first();
        return $localidad->localidad;

    }

}
