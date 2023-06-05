@extends('layouts.app')
@section('meta')
    <title>Reportar un Problema</title>
@stop
@section('content')


<section class="min-height">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0 d-none d-lg-block">
              @include('auth.colder')
            </div>
            <div class="col-12 col-lg-8 col-xl-9 py-5 min-height">
                <div class="grid rows-2 rows-lg-1 cols-1 justify-content-stretch align-items-center">
                    <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                        <h2 class="m-0">Reportar un problema</h2>
                    </div>
                </div>

                <h6 class="lead text-center text-lg-start mt-3">Para nosotros es muy importante que todo funcione bien, pero mucho mas que estés conforme con nuestros servicios, por eso pensamos en ti, si estas teniendo algún inconveniente en la plataforma o as visto algo inusual que no tiene que estar publicado no dudes en reportarlo y tomaremos las medidas necesaria para que estés conforme, navegando nuestro sitio.</h6>

              <form action="/store_incidencia" method="post" enctype="multipart/form-data" id="foincidencia" name="foincidencia">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row g-3 mt-6">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select name="tipo" required class="form-select" id="input_category" aria-label="Floating label select example">
                                <option value="1">Error en el proceso de compra</option>
                                <option value="2">Error al agregar un producto al carrito</option>
                                <option value="2">No puedo actualizar mi cuenta</option>
                                <option value="2">Denunciar una estafa</option>
                                <option value="2">Denunciar una cuenta falsa</option>
                                <option value="2">Denunciar una publicación</option>
                            </select>
                            <label for="input_category">Tipo de problema</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea required name="detalle" type="text" class="form-control" id="input_details" placeholder="Ejemplo" style="height: 200px;"></textarea>
                            <label for="input_details">Descripción del problema</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="formFile" class="form-label">Adjuntar archivo <small>(jpg, png, pdf)</small></label>
                        <input class="form-control" name="archivo" type="file" id="formFile" >
                    </div>

                    <div class="col-12 d-flex mt-6">
                        <button class="btn btn-success mx-auto">Enviar reporte</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</section>

@endsection