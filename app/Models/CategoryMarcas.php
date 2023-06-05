<?php

namespace App\Models;

use Eloquent as Model;


class CategoryMarcas extends Model
{

    public $table = 'category_marcas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'category_id',
        'marcas_id'
    ];


    protected $casts = [
        'id' => 'integer',
        /*'category_id' => 'integer',
        'marcas_id' => 'integer'*/
    ];


    public static $rules = [
        
    ];


    public function marcasId()
    {
        return $this->belongsTo(\App\Models\Marcas::class, 'marcas_id');
    }

    public function categoryId()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }


}
