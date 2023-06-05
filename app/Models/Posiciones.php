<?php

namespace App\Models;

use Eloquent as Model;

class Posiciones extends Model
{

    public $table = 'posiciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'ubicacion',
        'precio'
    ];


    protected $casts = [
        'id' => 'integer',
        'name' => 'sttring',
        'ubicacion' => 'sttring',
        'precio'=>'integer'
    ];


    public static $rules = [
        
    ];

  
 
  
    public function pautasId()
    {
        return $this->hasMany(\App\Models\Pautas::class, 'posicion_id');
    }


}
