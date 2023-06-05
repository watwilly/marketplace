<?php

namespace App\Models;

use Eloquent as Model;


class Interesados extends Model
{

    public $table = 'interesados';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'post_id',
        'user_id',
        'answered',
        'mensaje',
    ];


    protected $casts = [

    ];


    public static $rules = [
        
    ];

  
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id');
    }

  
}
