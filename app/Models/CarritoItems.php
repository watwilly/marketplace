<?php

namespace App\Models;

use Eloquent as Model;


class CarritoItems extends Model
{

    public $table = 'carritoItems';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'carrito_id',
        'post_id',
        'talle_id',
        'color_id',
        'cantidad',
        'status',
        'external_reference'
    ];
    protected $casts = [
        'id' => 'integer',
        'cantidad' => 'integer',
    ];

    public static $rules = [
        
    ];
    public function carritoId()
    {
        return $this->belongsTo(\App\Models\Carrito::class, 'carrito_id');
    } 
    public function postId()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id');
    } 
    public function talleId()
    {
        return $this->belongsTo(\App\Models\Talles::class, 'talle_id');
    } 
    public function colorId()
    {
        return $this->belongsTo(\App\Models\Colores::class, 'color_id');
    } 
}
