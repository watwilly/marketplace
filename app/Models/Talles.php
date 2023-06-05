<?php

namespace App\Models;

use Eloquent as Model;


class Talles extends Model
{

    public $table = 'talles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'talle'
    ];

    protected $casts = [
        'id' => 'integer',
        'talle' => 'string'
    ];


    public static $rules = [
        
    ];


    public function productostalles()
    {
        return $this->hasMany(\App\Models\PostsTalle::class, 'talle_id');
    }
}
