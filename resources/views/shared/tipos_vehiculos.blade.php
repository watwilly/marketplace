<div class="col-12 col-md-6 col-lg-3">
     <div class="form-floating">
		<input id="dom_kilometros" type="text" name="kilometros" class="form-control" required>	
		<label >Kilometros</label>
	</div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="form-floating">
		<input id="dom_anio" type="number" name="anio" class="form-control" required>	
		<label >Año</label>
	</div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="form-floating">
		<select name="transmision" class="form-control" id="dom_transmision" required>
			<option value="">Seleccione Transmision</option>
			<option value="manual" >Manual</option>
			<option value="automatica">Automatica</option>
		</select>
		<label>Transmision</label>	
	</div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="form-floating">
		<select name="colores_id" class="form-control" id="dom_colores_id" required>
			<option value="">Seleccione Color</option>
				@foreach($colores as $color)
		        	<option value="{{$color->id}}" style="background-color: {{$color->color}};">{{$color->color}}</option>
		        @endforeach
		</select>
		<label >Color</label>	
	</div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="form-floating">
		<select name="tipos_vehiculos_id" class="form-control" id="dom_tipos_vehiculos_id" required >
			<option value="">Tipo de Vehiculo</option>
				@foreach($tipo as $tipos)
		        	<option value="{{$tipos->id}}">{{$tipos->name}}</option>
		        @endforeach
		</select>
		<label>Tipo</label>
	</div>	
</div>