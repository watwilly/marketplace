<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Session;
use \App\Models\provincias as provincias;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function dropallsession()
    {
       return session::forget(['seaCondition','seaModel','seaMarca','seaOrden','catOrden','catCondicion','catMarca','catModelo','catPriceRangue','bpOrden','bpmarca','bpmodelo','bpcondicion','tcOrden','tcmarca','tcmodelo','tcondicion','tcprice_rangue']);
    }

    public function dropSearchSession()
    {
       return session::forget(['seaCondition','seaModel','seaMarca','seaOrden']);
    }
    public function dropCategorySession()
    {
       return session::forget(['catOrden','catCondicion','catMarca','catModelo','catPriceRangue']);
    }

    public function get_interes()
    {   
        $interest = NULL;
        if ($interest = Session::get('interest')) {
            return \App\Models\Post::select('posts.id', 'precios', 'title', 'categories.name')
                ->where('status', 'PUBLISHED')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->where('subcategoryId', $interest)->inRandomOrder()->orderBy('precios', 'ASC')->take(7)->get();
        }
    }
    public function deleteFileIfExists($path)
    {
        if (Storage::disk(config('voyager.storage.disk'))->exists($path)) {
            Storage::disk(config('voyager.storage.disk'))->delete($path);
        }elseif (Storage::disk(config('voyager.storage.disk'))->exists($path.".webp")) {
            Storage::disk(config('voyager.storage.disk'))->delete($path.".webp");
        }
    }

    public function get_all_provincias()
    {
      return provincias::where('sratus', 1)->get();
    }

    public function getCarrito($carrito_id=null)
    {
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();
        $carrito =$user->carritosId()->orderBy("created_at","DESC")->first();
        if (is_null($carrito)) {
            return false;
        }
        $items = $carrito->carritoitemsId()->where("status","pending")->orderBy("created_at","DESC")->get();

        return [
            "carrito"=>$carrito,
            "items"=>$items
        ];

    }

    protected static function CallAPI($method, $url, $TOKEN=null, $data = false)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        if ($TOKEN<>null){
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $TOKEN
            ));
        }

        //return $curl;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }


}
