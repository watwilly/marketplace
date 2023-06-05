<?php

namespace App\Models;

use Eloquent as Model;

use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;


class Post extends Model
{
    use Translatable;

    public $table = 'posts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'category_id',
        'subcategoryId',
        'marca_id',
        'Modelos_id',
        'provincia_id',
        'localidad_id',
        'title',
        'body',
        'precios',
        'cantidad',
        'condicion',
        'fecha_vencimiento',
        'status',
        'created_at',
        'updated_at',
        'ml_id',
        'tienda_id'
    ];


    protected $casts = [
        'id' => 'integer',
        'author_id' => 'integer',
        'category_id' => 'integer',
        'subcategoryId'=>'integer',
        'marca_id'=> 'integer',
        'Modelos_id'=> 'integer',
        'provincia_id'=> 'integer',
        'localidad_id'=> 'integer',
        'title' => 'string',
        'body' => 'string',
        'precios' => 'integer',
        'cantidad' => 'integer',
        'status' => 'string',
        'condicion' => 'string',
        'fecha_vencimiento' => 'date',
        'ml_id'=>'string',
        'tienda_id'=>'integer'
    ];


    public static $rules = [
        
    ];

    public function postscolores()
    {
        return $this->hasMany(\App\Models\PostsColores::class, 'posts_id');
    }
    public function poststalles()
    {
        return $this->hasMany(\App\Models\PostsTalles::class, 'posts_id');
    }
    public  function postimagenes()
    {
        return $this->hasMany(\App\Models\PostImagenes::class, 'posts_id');
    }
    public function postsvehiculos()
    {
        return $this->hasMany(\App\Models\PostsVehiculos::class, 'posts_id');
    }
    public  function postvisitas()
    {
        return $this->hasMany(\App\Models\PostVisitas::class, 'posts_id');
    }    
    public  function interesadosId()
    {
        return $this->hasMany(\App\Models\Interesados::class, 'post_id');
    } 
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
  
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(\App\Models\Category::class, 'subcategoryId');
    }
    public function marca()
    {
        return $this->belongsTo(\App\Models\Marcas::class, 'marca_id');
    }
    public function modelo()
    {
        return $this->belongsTo(\App\Models\Modelos::class, 'Modelos_id');
    }

    public function provincia()
    {
        return $this->belongsTo(\App\Models\provincias::class);
    }

    public function localidades()
    {
        return $this->belongsTo(\App\Models\localidades::class, 'localidad_id');
    }


    static function obtenerFechaEnLetra($fecha){
        $dia= Post::conocerDiaSemanaFecha($fecha);
        $num = date("j", strtotime($fecha));
        $anno = date("Y", strtotime($fecha));
        $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $mes = $mes[(date('m', strtotime($fecha))*1)-1];
        return $dia.' '.$num.'  de '.$mes;
    }
     
    static function conocerDiaSemanaFecha($fecha) {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $dia = $dias[date('w', strtotime($fecha))];
        return $dia;
    }


}
