@extends('layouts.app')
@section('meta')
    <title>Editando Oferta Laboral</title>
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
                        <h2 class="m-0">{{$oferta->titulo}}</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="#" onclick="history.back()" class="section__link section__link--secondary">Volver</a>
                    </div>
                </div>

                <div class="row g-3 mt-6">
                  <div id="alertset"></div>
                  <form method="POST" action="/update_oferta/{{$oferta->id}}" accept-charset="UTF-8" enctype="multipart/form-data" class="row">
                    @csrf
                    <div class="col-12">
                        <h4 class="lead text-center text-lg-start">Estado de la publicación</h4>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="input_visible" @if($oferta->status==1) checked @endif>
                            <label class="form-check-label" for="input_visible">Publicación Visible</label>
                        </div>
                    </div> 

                    <div class="col-12">
                        <h4 class="lead mt-6 text-center text-lg-start">Detalle de tu publicación</h4>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                       <div class="form-floating">
                            <input type="text" class="form-control" value="{{$oferta->titulo}}" name="titulo"  maxlength="120" >
                            <label>Titulo</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="text" class="form-control"  value="{{$oferta->puesto}}" name="puesto" required maxlength="60" >
                            <label>Puesto</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="number" class="form-control"  value="{{$oferta->vacantes}}" name="vacantes" required >
                            <label>Vacantes</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating  mt-6">
                            <input type="text" name="direccion"  value="{{$oferta->direccion}}" class="form-control" required maxlength="150">
                            <label>Dirección Laboral</label>
                        </div>  
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea name="descripcion" class="form-control"  required="">  {{$oferta->descripcion}}</textarea>
                            <label>Descripción</label>
                        </div> 
                    </div>
                    
                    <div class="col-12">
                        <div class="grid mt-6 rows-2 rows-lg-1 cols-1 cols-lg-2 justify-content-stretch align-items-center">
                            <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                                <h4 class="lead">Fotos e imágenes</h4>
                            </div>
                            <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                                <input type="file" id="input_images"  name="imagen"  class="d-none">
                                <label for="input_images" class="section__link section__link--primary">Subir fotos</label>
                            </div>
                        </div>
                        @if($oferta->imagen)
                            <div id="input_preview" class="grid g-2 rows-1 cols-2 cols-sm-3 cols-md-4 cols-lg-5 cols-xl-6">
                              <div class="grid-item p-0">
                                <img src="{{voyager::get_image($oferta->imagen,null,null)}}" class="img-preview">
                                <a class="btn btn-danger img-preview-remove"  onclick="delete_image({{$oferta->id}});"><i class="fas fa-trash-alt"></i></a>
                              </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 d-flex mt-6">
                        <button class="btn btn-success mx-auto" type="submit">Guardar cambios</button>
                    </div>
                  </form>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection