<?php

namespace App\Models;

use Eloquent as Model;


class PostImagenes extends Model
{

    public $table = 'post_imagenes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'imagen',
        'posts_id',
        'status',
        'storage',
        'orden'
    ];


    protected $casts = [
        'id' => 'integer',
        'imagen' => 'string',
        'posts_id' => 'integer',
        'status' => 'integer',
        'storage' =>'string'
    ];


    public static $rules = [
        
    ];

 
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }
}
