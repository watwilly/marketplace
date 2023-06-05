<option value="">Seleccione</option>
@foreach($modelos as $cmodelo)
	<?php 
		$modelo = $cmodelo->modelosId()->first();
	?>
    <option value="{{ $modelo->id }}" @if(isset($_POST['modelo_id']) && $_POST['modelo_id'] == $modelo->id){{ 'selected="selected"' }}@endif>{{ $modelo->name }}</option>
@endforeach
