<?php

namespace App\Models;

use Eloquent as Model;


class PostsVehiculos  extends Model
{

    public $table = 'posts_vehiculos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'posts_id',
        'kilometros',
        'anio',
        'transmision',
        'colores_id',
        'tipos_vehiculos_id'

    ];


    protected $casts = [
       /* 'id' => 'integer',
        'name' => 'string',*/

    ];


    public static $rules = [
        
    ];


    public function tiposvehiculos()
    {
        return $this->belongsTo(\App\Models\TiposVehiculos::class, 'tipos_vehiculos_id');
    }

    public function colores()
    {
        return $this->belongsTo(\App\Models\Colores::class, 'colores_id');
    }
    public function posts()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }


}
