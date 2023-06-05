
@if($categoria->count() >  0)
  @foreach($categoria as $categorias)
      <option value="{{ $categorias->id }}">{{ $categorias->name }}</option>
  @endforeach
@endif