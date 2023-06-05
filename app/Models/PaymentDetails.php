<?php

namespace App\Models;

use Eloquent as Model;

class PaymentDetails extends Model
{

    public $table = 'payments_details';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'payment_id',
        'mercadopago_fee',
        'aplicacion_fee',
        'financing_fee',
        'neto_recibido',
        'card_holder',
        'expiration',
        'first_six_digits',
        'last_four_digits',
        'total_paid_amount'
    ];


    protected $casts = [
        'id' => 'integer',
    ];


    public static $rules = [
        
    ];

    public function paymentId()
    {
        return $this->belongsTo(\App\Models\Payments::class, 'payment_id');
    }

}
