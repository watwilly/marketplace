<?php

namespace App\Models;

use Eloquent as Model;

class Reportes extends Model
{

    public $table = 'reportes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'post_id',
        'detalle_reporte',
   
    ];


    protected $casts = [

    ];


    public static $rules = [
        
    ];

  
    public function usersId()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function postId()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id');
    }

}
