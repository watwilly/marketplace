<?php

namespace App\Models;

use Eloquent as Model;


class PostsColores extends Model
{

    public $table = 'posts_colores';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'posts_id',
        'color_id',
        'cantidad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'posts_id' => 'integer',
        'color_id' => 'integer',
        'cantidad' => 'integer'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class);
    }

    public function colores()
    {
        return $this->belongsTo(\App\Models\Colores::class, 'color_id');
    }
}
