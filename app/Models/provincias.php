<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class provincias
 * @package App\Models
 * @version August 15, 2017, 3:58 pm UTC
 */
class provincias extends Model
{

    public $table = 'provincias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'provincia'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'provincia' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function  localidades()
    {
        return $this->hasMany(\App\Models\localidades::class);
    }  


    static function GetUbicacionperProvincia($provincia_id) 
    {
        $provincia = \App\Models\provincias::select('id', 'provincia')
            ->where('id', $provincia_id)
            ->first();
        return $provincia->provincia;

    }


}
