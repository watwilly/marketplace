<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Auth;
use \App\Models\Post as post;
use \App\Models\PostImagenes as imagenes;
use Illuminate\Http\Request;

class PostImageController extends Controller
{
    public function order(Request $request)
    {
        $post = post::select("id","title")->where("id",$request->pubId)->first();
        if(is_null($post)){
            abort(404);
        }

        $imagenes = $post->postimagenes()->orderBy("orden", "ASC")->get();

        return view("auth.publicaciones.orden", compact("imagenes","post"));
    }

    public function reorder(Request $request)
    {

        $model = new imagenes();
        $order = json_decode($request->input('order'));
        $column = "orden";
        foreach ($order as $key => $item) {
            $i = $model->where("posts_id", $request->pubId)->findOrFail($item->id);
            $i->$column = ($key + 1);
            $i->save();
        }
    }
}
