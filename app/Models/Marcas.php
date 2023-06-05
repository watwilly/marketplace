<?php

namespace App\Models;

use Eloquent as Model;


class Marcas extends Model
{

    public $table = 'marcas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'category_id',
        'post_tipos_id',
        'name'
    ];


    protected $casts = [
     /*   'id' => 'integer',
        'category_id' => 'integer',
        'name' => 'string'*/
    ];


    public static $rules = [
        
    ];

    public function marcas()
    {
        return $this->hasMany(\App\Models\Marcas::class, 'category_id');
    }
    public function marcas_modelos()
    {
        return $this->hasMany(\App\Models\MarcasModelos::class, 'marcas_id');
    }

    public function categoryId()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
    public function modelos()
    {
        return $this->hasMany(\App\Models\Modelos::class);
    }

}
