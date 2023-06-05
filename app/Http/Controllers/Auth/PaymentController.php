<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use \App\Models\Carritos as carritos;
use \App\Models\CarritoItems as items;
use \MercadoPago\SDK as mpsdk;
use \Carbon\Carbon as carbon; 
use \App\Models\PostImagenes as postimagenes;
use \App\Models\Payments as paid;
use \App\Models\PaymentCompras as compras;
use \App\Models\PaymentDetails as details;
use \App\Mail\Payment as email_payment;
use \App\Models\PaymentsIntentos as intentos;
use Mail;

class PaymentController extends Controller
{
    public function checkout($item_id)
    {	
    	$user = Auth::user();

    	$items = items::select("carritoItems.id","carritoItems.post_id","carritoItems.cantidad", "c.id as carrito_id", "carritoItems.status", "p.title", "p.precios")
    	->join("carritos as c", "carritoItems.carrito_id", "=", "c.id" )
    	->join("posts as p", "carritoItems.post_id","=","p.id")
    	->where("carritoItems.id",$item_id)
    	->where('c.user_id', $user->id)
    	->first();

    	if (is_null($items)) {
    		return redirect()->back()->with(["status"=>"danger","msg"=>"El item no esta disponible o ha sido eliminado"]);
    	}

    	return view('auth.payment.checkout', compact("items","user"));
    }


    public function payment($item_id)
    {
    	$user = Auth::user();
 		
 		$item = items::select("carritoItems.id as item_id","carritoItems.talle_id","carritoItems.color_id","carritoItems.cantidad","carritoItems.status","carritoItems.external_reference", "p.category_id","p.subcategoryId" ,"p.marca_id","p.Modelos_id","p.title","p.body","p.precios","p.condicion","p.tienda_id", "p.id as pubId", "seller.email as seler_email", "seller.name as seller_name", "seller.id as vendedor_id","mp.access_token") 
		->join("carritos as c", "carritoItems.carrito_id", "=", "c.id" )
		->join("posts as p", "carritoItems.post_id","=","p.id")
		->join("users as seller", "p.user_id","=","seller.id")
		->join("users_meli as mp", "seller.id","=","mp.users_id")
		->where('carritoItems.id',$item_id)
		->where('c.user_id', $user->id)
		->first();


 		if (is_null($item)) {
 			return response()->json(["status"=>"danger","msg"=>"Ocurrio un error al traer el item que quieres comprar intente de nuevo mas tarde"]);
 		}

 		if (is_null($item->access_token)) {
 			return response()->json(["status"=>"danger","msg"=>"El vendedor no tiene configurado su cuenta de MercadoPago para que le puedas pagar"]);
 		}

 		$getImg = postimagenes::where("posts_id",$item->pubId)->first();

 		$img=null;

 		if ($getImg){
 			if ($getImg->storage=="online") {
 				$img = $getImg->imagen;
 			}else{
 				$img = $getImg->imagen;
 			}
 		}

 		$external_reference = str_ireplace("...", "", str_limit($user->email, 4))."d".str_ireplace(" ","", str_ireplace(":", "", carbon::now()))."d".$item->id."d".$user->id."d".$item->pubId;
 		$total_payment = $item->precios * $item->cantidad;

 		$comicion = $total_payment * 2 / 100;

 		mpsdk::initialize();
        mpsdk::setAccessToken($item->access_token);

        $preference = new \MercadoPago\Preference();

        $mpitem = new \MercadoPago\Item();
        $mpitem->id = $item->pubId;
        $mpitem->title = $item->title;
        $mpitem->description =  $item->body;
        $mpitem->picture_url = "https://www.ventastucuman.com/storage/".$img;
        $mpitem->quantity = 1;
        $mpitem->currency_id = "ARS";
        $mpitem->unit_price = $total_payment;

        $payer = new \MercadoPago\Payer();
        $payer->date_created = carbon::now()->parse('this day')->toDateString();

        $payer->email = $user->email;
        $payer->name = $user->name;
        $payer->phone = [
            "area_code"=>"381",
            "number"=>$user->telefono
        ];
        $payer->address = [
            "street_name" => $user->direccion,
            "street_number"=>"",
            "zip_code"=>$user->cpa
        ];

        $preference->items = array($mpitem);
        $preference->payer = $payer;
        $preference->marketplace_fee = $comicion;
        $preference->notification_url = "https://www.ventastucuman.com/ipn?external_reference=".$external_reference;
        //$preference->notification_url = "https://".$_SERVER['HTTP_HOST']."/ipn?external_reference=".$external_reference;
    	$preference->auto_return = "approved";
        $preference->expires = true;
        $preference->external_reference = $external_reference;

        $preference->back_urls = [
            "success" => "https://".$_SERVER['HTTP_HOST']."/pament-success?ref=".$external_reference,
            "failure" => "https://".$_SERVER['HTTP_HOST']."/pament-failure?ref=".$external_reference,
            "pending" => "https://".$_SERVER['HTTP_HOST']."/pament-pending?ref=".$external_reference,
        ];

        $preference->expiration_date_from = carbon::now()->parse('this day')->format('Y-m-d\TH:i:s.000P');
        $preference->expiration_date_to =   carbon::now()->parse('next week')->format('Y-m-d\TH:i:s.000P');
        $preference->save();
        if (is_null($preference->error)) {
		        
		        #Actualizo el item del carrito agregandole la referencia externa
		        $itemupdate = items::where("id",$item_id)->first();

		        if (is_null($itemupdate)) {
		 			return response()->json(["status"=>"danger","msg"=>"Ocurrio un error asignandole la referencia externa al producto"]);
		        }
		        $itemupdate->external_reference = $external_reference;
		        $itemupdate->save();

		        #Agrego el pago a la tabla payment
		        $paid_atribute=[
		        	"comprador_id"=>$user->id,
		        	"vendedor_id"=>$item->vendedor_id,
		        	"external_reference"=>$external_reference,
		        	"ref_id"=>$preference->id
		        ];

		        $create_paid = paid::create($paid_atribute);

				#Si se agrega el pago agregar el items que el usuario esta comprando        
		        if ($create_paid) {
		        	$compra = new compras();
			        $compra->titulo = $item->title;
			        $compra->body = $item->body;
			        $compra->category_id = $item->category_id;
			        $compra->subcategory_id = $item->subcategoryId;
			        $compra->marca_id = $item->marca_id;
			        $compra->modelo_id = $item->Modelos_id;
			        $compra->precio = $item->precios;
			        $compra->cantidad = $item->cantidad;
			        $compra->condicion = $item->condicion;
			        $compra->tienda_id = $item->tienda_id;
			        $compra->talle_id = $item->talle_id;
			        $compra->color_id = $item->color_id;
			        $compra->fotos  =$img;   
			        $saveCompra = $create_paid->comprasId()->save($compra);

			        return response()->json(["status"=>"success", "uri"=>$preference->init_point, "msg"=>"Procesando por favor espere"]);
		        }else{
		        	$create_paid->delete();
		 			return response()->json(["status"=>"danger","msg"=>"No se ha podido asignar la compra al pago, intente de nuevo mas tarde"]);
		        }


        }else{
		 	return response()->json(["status"=>"danger","msg"=>"Ocurrio un error al crear el pago en Mercado Pago, intente de nuevo mas tarde"]);
        }

    }

    public function input_payment($payment=null, $request=null)
    {	

    	if ($request['collection_id']==0) {
    		return false;
    	}
        $seller = $payment->vendedorId()->select("users.id","users.name","users.apellido","users.email","um.access_token")
        ->join("users_meli as um", "users.id","=","um.users_id")->first();

        if (is_null($seller)) {
        	return ["status"=>"error-seller"];
        }
        
        $item = items::select("id","status")->where("external_reference",$request["ref"])->first();

        $filters = [
            "external_reference" =>$request['ref'],
            "id"=> $request['collection_id']
        ];

    	mpsdk::initialize();
        $access_token=$seller->access_token;

        $data = mpsdk::get('/v1/payments/'.$request['collection_id'].'?access_token='.$access_token.'', $filters);
	    $code = intval($data["code"]);

	    $codes = [200,201];
	    if (!in_array($code, $codes)) {
	    	return ["status"=>"error-mp"];
	    }


	    $status = $data["body"]["status"];
	    $status_details = $data["body"]["status_detail"];
	    $orden_id = $data["body"]["id"];
	    $cuotas = $data["body"]["installments"];
	    $payment_method = $data["body"]["payment_method_id"];
	    $paymen_type = $data["body"]["payment_type_id"];
	    $merchant_order_id = $request["merchant_order_id"];


        if ($item) {
            $item->status = $status;
            $item->save();
        }
        

	    $payment->status = $status;
	    $payment->status_detail = $status_details;
	    $payment->orden_id = $orden_id;
	    $payment->cuotas = $cuotas;
	    $payment->payment_method = $payment_method;
	    $payment->payment_thype =  $paymen_type;
	    $payment->merchant_order_id = $merchant_order_id;
	    $payment->save();

	    $card_holder = NULL;
	    $expiration = NULL;
	    $first_six_digits = NULL;
	    $last_four_digits = NULL;

	    if (array_key_exists("card", $data["body"]) && count($data["body"]["card"])>0) {
		    $card_holder = $data["body"]["card"]["cardholder"]["name"];
		    $expiration = $data["body"]["card"]["expiration_month"]."/".$data["body"]["card"]["expiration_year"];
		    $first_six_digits = $data["body"]["card"]["first_six_digits"];
		    $last_four_digits = $data["body"]["card"]["last_four_digits"];
	    }
      	
      	$mercadopago_fee=0;
      	$aplicacion_fee=0;
      	$financing_fee=null;

      	foreach ($data["body"]["fee_details"] as $fee_details){
	        if ($fee_details["type"] == 'financing_fee') {
	          $financing_fee = $fee_details["amount"];
	        }
	        if ($fee_details["type"] == 'mercadopago_fee') {
	          $mercadopago_fee = $fee_details["amount"];
	        }
	        if ($fee_details["type"] == 'application_fee') {
	          $aplicacion_fee = $fee_details["amount"];
	        }
      	}

      	$net_received_amount = $data["body"]["transaction_details"]["net_received_amount"];
      	$total_paid_amount =$data["body"]["transaction_details"]["total_paid_amount"];
	    

      	$getdetails = $payment->detailsId()->first();

      	if (is_null($getdetails)) {
	    	$details = new details();
      	}else{
      		$details = $getdetails;
      	}
        $details->mercadopago_fee = $mercadopago_fee;
        $details->aplicacion_fee = $aplicacion_fee;
        $details->financing_fee = $financing_fee;
        $details->neto_recibido = $net_received_amount;
        $details->card_holder = $card_holder;
        $details->expiration = $expiration;
        $details->first_six_digits = $first_six_digits;
        $details->last_four_digits = $last_four_digits;
        $details->total_paid_amount = $total_paid_amount;
        $payment->detailsId()->save($details);

        if ($status=="approved") {
            Mail::to(Auth::user()->email)->send(new email_payment($payment, __("web.payment-compra"), __("web.payment-subtitle"), __("web.payment-g2") ));
		  if ($seller) {
            Mail::to($seller->email)->send(new email_payment($payment, __("web.payment-venta"), __("web.payment-subtitle-venta"), __("web.payment-g1") ));
          }
        }
    	return ["status"=>$status];
    }
    public function events(Request $request)
    {
    	$user = Auth::user();
    	$payment = $user->comprador_paymentId()->where("external_reference",$request->ref)->first();

    	if (is_null($payment)) {
    		return redirect("/diff/error");
    	}
      	$paid = $this->input_payment($payment, $request->all());

    	return redirect("/diff/".$paid["status"]);
    }

    public function failure(Request $request)
    {
    	return redirect("/diff/cancelled");
    }
    public function diff($status)
    {
    	return view("auth.payment.paymentdiff", compact("status"));
    }


    public function ipn(Request $request)
    {	
    	
    	$paid = paid::where("external_reference", $request->external_reference)->first();
    	$seller = $paid->vendedorId()->select("users.id","um.access_token")->join("users_meli as um", "users.id","um.users_id")->first();

        if (is_null($seller)) {
            return false;
        }

  		if (isset($_GET["topic"])) {

	        mpsdk::initialize(); 
	        mpsdk::setAccessToken($seller->access_token); 
	        $merchant_order = null;
	        switch($_GET["topic"]) {
	            case "payment":
	                $payment = \MercadoPago\Payment::find_by_id($_GET["id"]);
	                $merchant_order = \MercadoPago\MerchantOrder::find_by_id($payment->order->id);
	                break;
	            case "merchant_order":
	                $merchant_order = \MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
	                break;
	        }

      		$collection_id = 0;
		    foreach ($merchant_order->payments as $getpaid) {
		        $collection_id = $getpaid->id;

		        $call=$paid->intentosId()->where("paidId",$collection_id)->first();
		        if (is_null($call)) {
		        	$intentos = new intentos();
		        }else{
		        	$intentos = $call;
		        }
		        $intentos->paidId = $collection_id;
		        $intentos->transaction_amount = $getpaid->transaction_amount;
		        $intentos->total_paid_amount = $getpaid->total_paid_amount;
		        $intentos->status = $getpaid->status;
		        $intentos->status_detail = $getpaid->status_detail;
		        $intentos->operation_type = $getpaid->operation_type;
		        $intentos->date_approved = $getpaid->date_approved;
		        $intentos->date_created = $getpaid->date_created;
		        $intentos->last_modified = $getpaid->last_modified;
		        $intentos->amount_refunded = $getpaid->amount_refunded;

		        $paid->intentosId()->save($intentos);


		    }
            if ($collection_id>0) {
                
                $collection_id = $getpaid->id;
                $requestPayment = [
                    'collection_id'=>$collection_id,
                    'preference_id'=>$merchant_order->preference_id,
                    'ref'=>$merchant_order->external_reference,
                    'merchant_order_id'=>$merchant_order->id

                ];
                $npt = $this->input_payment($paid,$requestPayment);
                exit(json_encode($npt));
            }

  		}
    }
}
