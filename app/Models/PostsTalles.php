<?php

namespace App\Models;

use Eloquent as Model;


class PostsTalles extends Model
{

    public $table = 'posts_talles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'posts_id',
        'talle_id',
    ];


    protected $casts = [
        'id' => 'integer',
        'posts_id' => 'integer',
        'talle_id' => 'integer',
    ];


    public static $rules = [
        
    ];

    public function posts()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    public function talles()
    {
        return $this->belongsTo(\App\Models\Talles::class, 'talle_id');
    }
}
