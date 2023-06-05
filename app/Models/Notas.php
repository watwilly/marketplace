<?php

namespace App\Models;

use Eloquent as Model;

class Notas extends Model
{

    public $table = 'notas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'titulo',
        'texto',
        'imagen',
        'status',
        'category_id'
    ];


    protected $casts = [
        'id' => 'integer',
    ];


    public static $rules = [
        
    ];
    public function categoryId()
    {
        return $this->belongsTo(\App\Models\CategoryNotas::class,'category_id');
    }
}
