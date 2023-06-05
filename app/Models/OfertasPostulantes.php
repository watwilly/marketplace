<?php

namespace App\Models;

use Eloquent as Model;

class OfertasPostulantes extends Model
{

    public $table = 'ofertas_laborales_postulantes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'oferta_id',
        'user_id',
        'estado'
    ];


    protected $casts = [
        'id' => 'integer',
    ];


    public static $rules = [
        
    ];
    public function userId()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    public function ofertaId()
    {
        return $this->belongsTo(\App\Models\OfertasLaborales::class, 'oferta_id');
    }

}
