<?php

namespace App\Models;

use Eloquent as Model;

class PaymentsIntentos extends Model
{

    public $table = 'payment_intentos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'payment_id',
        'paidId',
        'transaction_amount',
        'total_paid_amount',
        'status',
        'status_detail',
        'operation_type',
        'date_approved',
        'date_created',
        'last_modified	',
        'amount_refunded',
    ];


    protected $casts = [
        'id' => 'integer',
    ];


    public static $rules = [
        
    ];


    public function paymentsId()
    {
        return $this->belongsTo(\App\Models\Payments::class, 'payment_id');
    }
}
