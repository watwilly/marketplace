<?php

namespace App\Models;

use Eloquent as Model;


class Servicios extends Model
{

    public $table = 'servicios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'users_id',
        'category_id',
        'titulo',
        'descripcion',
        'status',
        'foto'
    ];


    protected $casts = [

    ];


    public static $rules = [
        
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class,'users_id');
    }

    public function categoryId()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

}
