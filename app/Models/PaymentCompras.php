<?php

namespace App\Models;

use Eloquent as Model;

class PaymentCompras extends Model
{

    public $table = 'payment_compra';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'titulo',
        'body',
        'category_id',
        'subcategory_id',
        'marca_id',
        'modelo_id',
        'precio',
        'cantidad',
        'condicion',
        'tienda_id',
        'talle_id',
        'color_id',
        'payment_id',
        'fotos'
    ];


    protected $casts = [
        'id' => 'integer',
    ];


    public static $rules = [
        
    ];

    public function categoryId()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function SubcategoryId()
    {
        return $this->belongsTo(\App\Models\Category::class, 'subcategory_id');
    }

    public function marcasId()
    {
        return $this->belongsTo(\App\Models\Marcas::class, 'marca_id');
    }

    public function modelosId()
    {
        return $this->belongsTo(\App\Models\Modelos::class, 'modelo_id');
    }

    public function tiendasId()
    {
        return $this->belongsTo(\App\Models\Tiendas::class, 'tienda_id');
    }

    public function tallesId()
    {
        return $this->belongsTo(\App\Models\Talles::class, 'talle_id');
    }


    public function coloresId()
    {
        return $this->belongsTo(\App\Models\Colores::class, 'color_id');
    }

    public function paymentsId()
    {
        return $this->belongsTo(\App\Models\Payments::class, 'payment_id');
    }








}
