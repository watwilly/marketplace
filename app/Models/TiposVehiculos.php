<?php

namespace App\Models;

use Eloquent as Model;


class TiposVehiculos  extends Model
{

    public $table = 'tipos_vehiculos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'id',
        'name'

    ];


    protected $casts = [
        'id' => 'integer',
        'name' => 'string',

    ];


    public static $rules = [
        
    ];


    public function postsvehiculos()
    {
        return $this->hasMany(\App\Models\PostsVehiculos::class, 'posts_id');
    }



}
