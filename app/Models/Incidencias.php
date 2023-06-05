<?php

namespace App\Models;

use Eloquent as Model;


class Incidencias extends Model
{

    public $table = 'incidencias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'users_id',
        'tipo',
        'detalle',
        'archivo'
    ];

  
    protected $casts = [
      
    ];

    public static $rules = [
        
    ];

   
    public function users()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id');
    }

}
