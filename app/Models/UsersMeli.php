<?php

namespace App\Models;

use Eloquent as Model;


class UsersMeli extends Model
{

    public $table = 'users_meli';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'users_id',
        'access_token',
        'refresh_token',
        'payment_accessToken',
        'payment_refresh_toke',
        'expires_in',
        'ml_user_id',
    ];


    protected $casts = [
      /*  'id' => 'integer',
        'users_id' => 'integer',
        'access_token'=>'string',
        'expires_in' => 'string',
        'ml_user_id' => 'string',
        'refresh_token' => 'string'*/
    ];


    public static $rules = [
        
    ];

    
}
