<?php

namespace App\Models;

use Eloquent as Model;


class CategoryNotas extends Model
{

    public $table = 'categorynotas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
    ];


    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];


    public static $rules = [
        
    ];


    public function notasId()
    {
        return $this->hasMany(\App\Models\Notas::class, 'category_id');
    }

}
