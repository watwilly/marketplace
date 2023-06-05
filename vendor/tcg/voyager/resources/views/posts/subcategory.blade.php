		
<option value="">Sub categoría</option>
@foreach($categoria as $categorias)
    <option value="{{ $categorias->id }}" @if(isset($_POST['subcategoryId']) && $_POST['subcategoryId'] == $categorias->id){{ 'selected="selected"' }}@endif>{{ $categorias->name }}</option>
@endforeach
