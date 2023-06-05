<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Notas as notas;
use \App\Models\CategoryNotas as category;


class NotaController extends Controller
{

	public function index()
	{
		$category = category::where("id",1)->first();

		$notas = $category->notasId()->get();
		return view("notas.index", compact("notas","category"));
	}

    public function show($id)
    {
        $nota = notas::where('id', $id)->where('status', 1)->first();

        if (is_null($nota)) {
            return redirect('/page-not-found');
        }

        return view('notas.show')->with('nota', $nota);
    }

    
}
