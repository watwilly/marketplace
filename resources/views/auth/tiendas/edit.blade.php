@extends('layouts.app')
@section('meta')
    <title>Crear Tienda</title>
@stop
@section('content')
 
<section class="min-height">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0 d-none d-lg-block">
              @include('auth.colder')
            </div>
            <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="grid rows-2 rows-lg-1 cols-1 cols-lg-2 justify-content-stretch align-items-center">
                    <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                        <h2 class="m-0">Editar</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="/comercio"  class="section__link section__link--secondary">Volver</a>
                    </div>
                </div>
                <div id="alertset"></div>
                <form method="POST" action="/tienda_store_update" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tienda_id" value="{{$tienda->id}}">
                    <div class="row g-3 mt-6">
                        @if($tienda->status=="rev")
                            <div class="alert alert-warning">Tienda en revision, modifique los datos para validar</div>
                        @else
                            <div class="col-12">
                                <h4 class="lead text-center text-lg-start">Estado de la tienda</h4>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="status" type="checkbox" id="input_visible" @if($tienda->status==1) checked @endif>
                                    <label class="form-check-label" for="input_visible">Tienda Visible</label>
                                </div>
                            </div>
                        @endif

                        <div class="col-12 mt-6">
                            <h4 class="lead text-center text-lg-start">Detalla tu tienda</h4>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" value="@if($tienda){{$tienda->titulo}}@endif" name="titulo" class="form-control" id="input_title" placeholder="Ejemplo">
                                <label for="input_title">Nombre de la tienda </label>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="category_id" id="input_category" aria-label="Floating label select example">
                                  @foreach($categorias as $category)
                                    <option value="{{$category->id}}" @if($tienda && $tienda->category_id==$category->id) selected @endif>{{$category->name}}</option>
                                  @endforeach
                                </select>
                                <label for="input_category">Rubro (Categoría)</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input name="direccion" value="@if($tienda){{$tienda->direccion}}@endif" type="text" class="form-control" id="input_address" placeholder="Ejemplo">
                                <label for="input_address">Domicilio <small>(Opcional)</small></label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input name="descripcion" value="@if($tienda){{$tienda->descripcion}}@endif" type="text" class="form-control" id="input_details" placeholder="Ejemplo">
                                <label for="input_details">Háblanos de tu actividad</label>
                            </div>
                        </div>
                       
                        
                        <div class="col-12">
                            <h4 class="lead mt-6 text-center text-lg-start">Dale identidad a tu tienda</h4>
                        </div>

                        <div class="offset-2 offset-sm-3 offset-md-0 col-8 col-sm-6 col-md-4 col-lg-3 d-flex flex-column align-items-center align-self-stretch">
                            <label class="btn btn-outline-secondary mb-3" for="logo_input">Subir Logo</label>
                            <input type="file" name="logo"  class="d-none" id="logo_input">
                            <img src="@if($tienda->logo){{Voyager::get_image($tienda->logo, 'cropped', 'storage')}}@endif" alt="" id="logo_preview" class="img-fluid rounded border-0 shadow">
                        </div>

                        <div class="col-12 col-md-8 col-lg-9 d-flex flex-column align-items-center">
                            <label class="btn btn-outline-secondary mb-3" for="banner_input">Subir Banner</label>
                            <input type="file" name="image"  class="d-none" id="banner_input">
                            <img src="@if($tienda->banner){{Voyager::get_image($tienda->banner, NULL, 'storage')}}@endif" alt="" id="banner_preview" class="img-fluid rounded border-0 shadow">
                        </div>

                        <div class="col-12 d-flex mt-6">
                            <button class="btn btn-success mx-auto">Guardar cambios</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection