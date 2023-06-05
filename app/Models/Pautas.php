<?php

namespace App\Models;

use Eloquent as Model;

class Pautas extends Model
{

    public $table = 'pautas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'auspiciante_id',
        'posicion_id',
        'banner',
        'desde',
        'hasta',
        'status',
        'banner_responsive',
        'link'
    ];


    protected $casts = [
        'id' => 'integer',
        'auspiciante_id' => 'integer',
        'posicion_id' => 'integer',
        'banner'=>'string',
        'desde'=> 'date',
        'hasta'=> 'date',
        'status'=>'string',
        'banner_responsive'=>'string',
        'link'=>'string'
    ];


    public static $rules = [
        
    ];

  
 
    public function auspicianteId()
    {
        return $this->belongsTo(\App\Models\Auspiciantes::class, 'auspiciante_id');
    }
    public function posicioneId()
    {
        return $this->belongsTo(\App\Models\Posiciones::class, 'posicion_id');
    }
    public function seguimientosId()
    {
        return $this->hasMany(\App\Models\Seguimiento::class, 'pauta_id');
    }
}
