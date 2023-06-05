<?php

namespace App\Models;

use Eloquent as Model;


class Carritos extends Model
{

    public $table = 'carritos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'status',
        'external_reference'
    ];
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'status' => 'string',
        'external_reference' => 'string'
    ];

    public static $rules = [
        
    ];
    public function userId()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    } 
    public function carritoitemsId()
    {
        return $this->hasMany(\App\Models\CarritoItems::class, 'carrito_id');
    } 
}
