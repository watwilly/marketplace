@if(count($item)>0 )
@foreach($item as $items)
	<?php
		$post = new \App\Models\Post();
		$verifyInsert = $post->select('id', 'ml_id')->where('user_id', Auth::user()->id)->where('ml_id', $items['body']->id)->where('status','<>','DRAFT')->take(1)->first();
	$price = $items["body"]->price;
	$array = [
		"title"=>$items["body"]->title,
		"id"=>$items["body"]->id,
		"category_id"=>$items["body"]->category_id,
		"price"=>$price,
		"initial_quantity"=>$items["body"]->initial_quantity,
		"condition"=>$items["body"]->condition,
		"pictures"=>$items["body"]->pictures
	];
	$json = json_encode($array);
	?>
    <div class="col-md-12 chekimport">
      <hr>
      <div class="col-md-1 py-5" > 
        <input type="checkbox" name="items[]" value="{{$json}}" @if(!is_null($verifyInsert)) disabled="true" @endif>
      </div>
      <div class="col-md-2">
        <img src="{{$items['body']->secure_thumbnail}}" class="img-responsive">
      </div>
      <div class="col-md-9 "> 
        <b>{{$items['body']->title}}</b>
        <p>ARS ${{$price}}</p>
        @if(!is_null($verifyInsert))
          <p class="btn btn-danger">Importado</p>
        @else
          <p class="btn btn-success">Listo para importar</p>
        @endif
      </div>
    </div>

	
@endforeach
@else
	<div class="alert alert-info">No tienes publicaciones en Mercado Libre</div>
@endif