<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;

class SearchfiltroController extends Controller
{
	
	public function create(Request $request)
	{
		if ($request->argument == 'condicion'){
			Session(['seaCondition'=>$request->atribute]);
		}

		if ($request->argument == 'modelo') {
			Session(['seaModel'=> $request->id, 'seamodelo_name'=>$request->atribute]);
		}

		if ($request->argument == 'marca') {
			Session(['seaMarca'=>$request->id, 'seamarca_name'=>$request->atribute]);
		}

		if ($request->argument == 'orden') {
			Session(['seaOrden'=>$request->atribute]);
		}

		if ($request->argument == 'catOrden') {
			Session(['catOrden'=>$request->atribute]);
		}

		if ($request->argument == 'catCondicion') {
			Session(['catCondicion'=>$request->atribute]);
		}
		if ($request->argument == 'catMarca') {
			Session(['catMarca'=>$request->id, 'catMarca_name'=>$request->atribute]);
		}
		if ($request->argument == 'catModelo') {
			Session(['catModelo'=>$request->id, 'catModelo_name'=>$request->atribute]);
		}
		if ($request->argument == 'price_rangue') {
			Session(['catPriceRangue'=>$request->max_price]);
		}
		if ($request->argument == 'bpOrden') {
			Session(['bpOrden'=>$request->atribute]);
		}
		if ($request->argument == 'bpmarca') {
			Session(['bpmarca'=>$request->id, 'bpmarca_name'=>$request->atribute]);
		}
		if ($request->argument == 'bpmodelo') {
			Session(['bpmodelo'=>$request->id, 'bpmodelo_name'=>$request->atribute]);
		}
		if ($request->argument == 'bpcondicion') {
			Session(['bpcondicion'=>$request->atribute]);
		}
		if ($request->argument == 'tcOrden') {
			Session(['tcOrden'=>$request->atribute]);
		}
		if ($request->argument == 'tcmarca') {
			Session(['tcmarca'=>$request->id, 'tcmarca_name'=>$request->atribute]);
		}
		if ($request->argument == 'tcmodelo') {
			Session(['tcmodelo'=>$request->id, 'tcmodelo_name'=>$request->atribute]);
		}
		if ($request->argument == 'tcondicion') {
			Session(['tcondicion'=>$request->atribute]);
		}
		if ($request->argument == 'tcprice_rangue') {
			Session(['tcprice_rangue'=>$request->max_price]);
		}


		return response()->json(['status'=>'success']);
	}
    public function drop_filtro(Request $request)
    {
        Session::forget($request->key);
    }
}