<?php

namespace App\Models;

use Eloquent as Model;

class Tiendas extends Model
{

    public $table = 'tiendas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'titulo',
        'logo',
        'banner',
        'status',
        'descripcion',
        'direccion',
        'category_id',
        'logo'
    ];


    protected $casts = [
        'id' => 'integer',
        //'user_id' => 'integer',
        'titulo' => 'string',
        'logo' => 'string',
        'banner' => 'string',
        'status'=>'string',
        'descripcion'=>'string',
        'direccion'=>'string',
        'logo'=>'string'
    ];


    public static $rules = [
        
    ];


    public function userId()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    public function categoryId()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
    public function postsId()
    {
        return $this->hasMany(\App\Models\Post::class, 'tienda_id');
    }
}
