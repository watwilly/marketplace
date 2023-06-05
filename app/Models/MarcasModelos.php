<?php

namespace App\Models;

use Eloquent as Model;


class MarcasModelos extends Model
{

    public $table = 'marcas_modelos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'marcas_id',
        'modelos_id'
    ];


    protected $casts = [
        'id' => 'integer',
    ];


    public static $rules = [
        
    ];


    public function marcasId()
    {
        return $this->belongsTo(\App\Models\Marcas::class, 'marcas_id');
    }

    public function modelosId()
    {
        return $this->belongsTo(\App\Models\Modelos::class, 'modelos_id');
    }


}
