<?php

namespace App\Http\Controllers\Auth;

require 'meli/Meli/meli.php';
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Meli;
use Auth;
use Voyager;
use \App\Models\UsersMeli as user_meli;
use \App\Models\Category as categorias;
use \App\Models\Post as publicaciones;
use Session;

class MlController extends Controller
{
    public $appId;
    public $secretKey;
    private $uri;

    public function __construct()
    {
        
       $this->appId = "2398807130513562";
       $this->secretKey = "yKHNIWLlx8jbo93PNVfn6An6R29AY6ND";
       $this->meli = new Meli($this->appId, $this->secretKey);
       $this->uri="https://www.ventastucuman.com/ml/auth/ancle";
    
    }
    public function index(Request $request)
    {
        $user = Auth::user();

        $get_relations =  $user->usermeli()->first();
        $item = [];
        $code = NULL;
        $scroll_id = null;
        
        if($get_relations){
          $get_orders = $this->meli->get("https://api.mercadolibre.com/users/$get_relations->ml_user_id/items/search?access_token=$get_relations->access_token&search_type=scan&status=active&limit=60");
          $code = $get_orders["httpCode"];
          if ($code == 200) {
            $scroll_id = $get_orders["body"]->scroll_id;
          }

          if (!Session::get('item')) {
              if ($code !== 401) {
                foreach ($get_orders["body"]->results as  $items) {
                  $item[] = $this->meli->get("https://api.mercadolibre.com/items/$items?access_token=$get_relations->access_token");
                }
                Session(["item"=>$item]);
                Session(['scroll_id'=>$scroll_id]);
                Session(['code'=>$code]);
              }
         
          }else{
            $item = Session::get('item');
          }
        }
       return view('auth.meli.index')
        ->with('item', $item)
        ->with('scroll_id',$scroll_id)
        ->with('code', $code)
        ->with('get_relations', $get_relations);
    }
    public function authmla()
    {
      $get = "https://auth.mercadopago.com.ar/authorization?client_id=".$this->appId."&response_type=code&platform_id=mp&redirect_uri=".$this->uri."";
      return redirect($get);
    }

    public function meliAncleauth(Request $request)
    {
        if($_GET['code']) {
            $user = Auth::user();
            $redirectURI = $this->uri;
            $mprquest = array(
                 "client_id" => $this->appId,
                 "client_secret" => $this->secretKey,
                 "grant_type" => "authorization_code",
                 "code" => $request->code,
                 "redirect_uri" => $redirectURI
            ); 
            $data = json_encode($mprquest);
            $user_meli = $this->CallAPI("POST", "https://api.mercadopago.com/oauth/token", null, $data);

            $add_user_atribute = new user_meli();

            $get_code_VT = $add_user_atribute->where('users_id', $user->id)->first();
            
            $get_data = json_decode($user_meli);
            
            $create = [
                'users_id'=>$user->id,
                'access_token'=>$get_data->access_token,
                'expires_in'=>$get_data->expires_in,
                'ml_user_id'=>$get_data->user_id,
                'refresh_token'=>$get_data->refresh_token
            ];

            if (is_null($get_code_VT)) {
              $set =  $add_user_atribute->create($create);
            }else{
              $set = $get_code_VT->update($create);
            }
           if ($set) {
              return redirect('/ml/importar')->with(['operation_status'=>'success', 'operation_message'=>'Su cuenta esta ha sido anclada correctamente', 'operation_notif'=>'SU CUENTA HA SIDO RELACIONADA']);
           }else{
             return redirect('/ml/importar')->with(['operation_status'=>'error', 'operation_message'=>'Ocurrio un error intente de nuevo mas tarde', 'operation_notif'=>'OCURRIO UN ERROR']);

           }
        }

        return redirect('/autenticate/importar')->with('status', 'Su cuenta de Ventas tucuman no pudo ser anclada a su cuenta de mercado libre intente de nuevo mas tarde');
    }

    public function import_items(Request $request)
    {
        
      if ($request->items) {
          
          $user = Auth::user();
          $get_relations =  $user->usermeli()->first();

          $array_json = $request->items;
          $count = count($array_json);

          if ($count >= 60) {
            return redirect()->back()
            ->with(['operation_status'=>'error', 'operation_message'=>'El maximo permitio son 60 publicaciones por lote', 'operation_notif'=>'EL MAXIMO ES 60']);
          }
          foreach ($array_json as  $json){
            $decode = json_decode($json);
            $pub = publicaciones::where("user_id",$user->id)->where('ml_id', $decode->id)->first();
           
            $getMLCategory = $this->meli->get("https://api.mercadolibre.com/categories/$decode->category_id");
            $mlCatChildren = $getMLCategory['body']->path_from_root[1];
            $categoryId = null;
            $subCategoryId = null;

            $verify_category =categorias::where('ml_id', $mlCatChildren->id)->take(1)->first();
            if (!is_null($verify_category)) {
              $subCategoryId = $verify_category->id;
              $categoryId = $verify_category->parent_id;  
            } 

            $get_description = $this->meli->get("https://api.mercadolibre.com/items/$decode->id/description");
            $description = "El vendedor no incluyó una descripción del producto";
            
            if ($get_description["httpCode"]==200) {
              $description = $get_description['body']->plain_text;
            }
            
            $condicion = 'USADO';
            if ($decode->condition == 'new') {
              $condicion = 'NUEVO';
            }
            $data = [
                'user_id'=>$user->id,
                'category_id' =>$categoryId,
                'subcategoryId'=> $subCategoryId,
                'provincia_id' =>$user->provincia_id,
                'localidad_id'=>$user->localidad_id,
                'title' =>$decode->title,
                'body' =>$description,
                'precios'=>$decode->price,
                'cantidad' =>$decode->initial_quantity,
                'status' =>'PUBLISHED',
                'condicion'=>$condicion,
                'ml_id'=>$decode->id
            ];

            if (is_null($pub)) {
              $operation = publicaciones::create($data);
              if ($operation) {
                foreach ($decode->pictures as $picture_url){
                  $img = [
                   'imagen' =>$picture_url->secure_url,
                   'storage'=>'online' 
                  ];
                  $operation->postimagenes()->create($img);
                }

              }
            }else if (!is_null($pub)) {
              $operation = $pub->update($data);
            }

          }
            return redirect()->back()->with(['status'=>'success', 'msg'=>'Las publicaciones seleccionadas han sido importadas']);
      }else{
        return redirect()->back()->with(['status'=>'info', 'msg'=>'Seleccione alguna publicacion disponible para importar']);
      }
             
    }
    public function morepublication($scroll_id)
    {
      $user = Auth::user();
      $get_relations =  $user->usermeli()->first();
      $get_orders = $this->meli->get("https://api.mercadolibre.com/users/$get_relations->ml_user_id/items/search?search_type=scan&access_token=$get_relations->access_token&status=active&scroll_id=".$scroll_id."&order=desc");
      
      $code = $get_orders["httpCode"];
      if ($code != 200) {
        return $code;
      }
      $item = [];
      foreach ($get_orders["body"]->results as  $items) {
       $pub = $this->meli->get("https://api.mercadolibre.com/items/$items?access_token=$get_relations->access_token");
       $item[]=$pub;

      }  
      return view('auth.meli.more')
        ->with('item',$item);
    }
}
