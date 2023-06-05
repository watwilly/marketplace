<?php

namespace App\Models;

use Eloquent as Model;


class Plantillas extends Model
{

    public $table = 'plantillasemail';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'titulo',
        'imagen',
        'texto'
    ];


    protected $casts = [
       'id' => 'integer',
       'titulo' => 'string',
       'imagen' => 'string',
       'texto' => 'string'
    ];


    public static $rules = [
        
    ];



    public function mailenId()
    {
        return $this->hasMany(\App\Models\Mailen::class, 'plantilla_id');
    }

}
