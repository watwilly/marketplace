<?php

namespace App\Models;

use Eloquent as Model;


class Modelos extends Model
{

    public $table = 'modelos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'marcas_id',
        'name'
    ];

 
    protected $casts = [
      /*  'id' => 'integer',
        'marcas_id' => 'integer',
        'name' => 'string'*/
    ];


    public static $rules = [
        
    ];


    public function marcasId()
    {
        return $this->belongsTo(\App\Models\Marcas::class);
    }
}
