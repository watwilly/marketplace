<option value="">Seleccione</option>
@foreach($marcas as $cmarca)
	<?php 
		$marca = $cmarca->marcasId()->first();
	?>
    <option value="{{ $marca->id }}" @if(isset($_POST['marca_id']) && $_POST['marca_id'] == $marca->id){{ 'selected="selected"' }}@endif>{{ $marca->name }}</option>
@endforeach
