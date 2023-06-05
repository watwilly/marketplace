<?php

namespace App\Models;

use Eloquent as Model;


class PostVisitas  extends Model
{

    public $table = 'posts_visitas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'posts_id',
        'cant_visita',

    ];


    protected $casts = [
       /* 'id' => 'integer',
        'name' => 'string',*/

    ];


    public static $rules = [
        
    ];


    public function posts()
    {
        return $this->belongsTo(\App\Models\Post::class, 'posts_id');
    }


}
