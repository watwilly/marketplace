<?php

namespace App\Models;

use Eloquent as Model;


class Category extends Model
{

    public $table = 'categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'parent_id',
        'order',
        'name',
        'slug',
        'home',
        'image'
    ];


    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'order' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'home' => 'integer',
        'image' => 'string'
    ];


    public static $rules = [
        
    ];


    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class, 'category_id');
    }

    public function postpersubCategory()
    {
        return $this->hasMany(\App\Models\Post::class, 'subcategoryId');
    }

    public function subcategoryId(){
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }

    public function get_parent(){
        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    }

    public function categorymarcasId()
    {
        return $this->hasMany(\App\Models\CategoryMarcas::class, 'category_id');
    }
    
    public function tipos()
    {
        return $this->hasMany(\App\Models\Tipos::class, 'category_id');
    }

}
