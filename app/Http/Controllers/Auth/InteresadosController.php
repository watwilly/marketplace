<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Mail\interesadosresponse as answered;
use \App\Models\Interesados as interesados; 
use Illuminate\Mail\Message;
use Mail;
use Response;
use Auth;

class InteresadosController extends Controller
{	
	public $query;
    public $user;

    public function __construct()
	{
		  $this->middleware(function ($request, $next) {
		    $this->user = Auth::user();
			$this->query = $this->user->postsId()->select("posts.id", "posts.user_id","posts.title", "i.mensaje",'i.created_at as fecha',"i.id as consultaId" )
	        ->join("interesados as i", "posts.id","i.post_id")
	        ->whereNull("i.answered");
		    
		    return $next($request);
		  });
	}
    public function index(Request $request)
    {	

        $concultas = $this->query;

        if ($fecha=$request->fecha) {
            $concultas->whereDate("i.created_at",$fecha);
        }
        if ($name=$request->name) {
            $concultas->where("posts.title", "LIKE","%".$name."%");
        }
        if ($orden=$request->orden) {
            $concultas->orderBy("i.created_at",$orden);
        }else{
            $concultas->orderBy("i.created_at","DESC");
        }
    	$interesados = $concultas->get();
        return view('auth.intereses.index')
            ->with('interesados', $interesados);
    }

    public function answered(Request $request)
    {
    	$question = interesados::select("interesados.id","interesados.answered", "p.id as pId", "p.title","interesados.mensaje", "u.email as interesadoemail")->where('interesados.id',$request->consultaId)
    	->join("users as u", "interesados.user_id", "=","u.id")
        ->join("posts as p", "interesados.post_id","=","p.id")->whereNull("interesados.answered")->first();

    	if (!$question) {
    		return Response()->json(["status"=>"error","msg"=>"Esta pregunta no esta disponible o ha sido respondida"]);
    	}
        $title = $question->title;
    	$question->answered = $request->answered;
    	$response = $question->save();


        Mail::to($question->interesadoemail)
            ->send(new answered($question->mensaje, $title, $request->answered));
    	
        if ($response) {
    		return Response()->json(["status"=>"success","msg"=>"Su respuesta ha sido enviada"]);
    	}
    	return Response()->json(["status"=>"error","msg"=>"Ocurrio un error intente de nuevo mas tarde"]);

    }
}
