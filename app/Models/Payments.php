<?php

namespace App\Models;

use Eloquent as Model;

class Payments extends Model
{

    public $table = 'payments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'comprador_id',
        'vendedor_id',
        'external_reference',
        'ref_id',
        'status',
        'status_detail',
        'orden_id',
        'cuotas',
        'payment_method',
        'payment_thype',
        'merchant_order_id'
    ];


    protected $casts = [
        'id' => 'integer',
    ];


    public static $rules = [
        
    ];

    public function vendedorId()
    {
        return $this->belongsTo(\App\User::class, 'vendedor_id');
    }
    public function compradorId()
    {
        return $this->belongsTo(\App\User::class, 'comprador_id');
    }
    public function detailsId()
    {
        return $this->hasMany(\App\Models\PaymentDetails::class, 'payment_id');
    }
    public function comprasId()
    {
        return $this->hasMany(\App\Models\PaymentCompras::class, 'payment_id');
    }
    public function intentosId()
    {
        return $this->hasMany(\App\Models\PaymentsIntentos::class, 'payment_id');
    }
}
