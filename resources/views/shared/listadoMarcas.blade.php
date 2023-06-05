
@if($marca->count() > 0)
  <option value="">Seleccione</option>
  @foreach($marca as $marcas_id)
    <?php $get_marca = $marcas_id->marcasId()->first(); ?>
      <option value="{{$get_marca->id}}" >{{ $get_marca->name }}</option>
  @endforeach
@else
  <option value="">Sin marca</option>
@endif