<?php

namespace App\Models;

use Eloquent as Model;


class Mailen extends Model
{

    public $table = 'mailen';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'plantilla_id',
        'notif'
    ];


    protected $casts = [
       'id' => 'integer'
    ];


    public static $rules = [
        
    ];



    public function userId()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    public function plantillaId()
    {
        return $this->belongsTo(\App\Models\Plantillas::class, 'plantilla_id');
    }
}
