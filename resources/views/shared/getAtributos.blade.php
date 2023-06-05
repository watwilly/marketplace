@if(!is_null($haveAtribute))

<div class="col-12 col-md-6 col-lg-6">
   <div class="form-floating">
		<select class="form-control inputstl" name="talle[]" id="dom_talles" multiple  style="height: 151px;">
			@foreach($talles->get() as $talle)
				<option value="{{$talle->id}}">{{$talle->talle}}</option>
			@endforeach
		</select>
		<label>Talles</label>
	</div>
</div>

<div class="col-12 col-md-6 col-lg-6">
    <div class="form-floating">
		<select class="form-control" name="colore[]" id="dom_colores" multiple style="height: 151px;">
			@foreach($colores->get() as $color)
	            <option value="{{$color->id}}" style="background-color: {{$color->color}};"></option>
			@endforeach
		</select>
		<label>Colores</label>
	</div>
</div>	
@endif