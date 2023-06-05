@extends('layouts.app')

@section('content')

<div class="container-fluid py-5">


  <div class="col-md-12">
      <div class="configuracion-user flex row">
        @include('auth.colder')
        <div class="col-md-7 col-sm-9 ">
          <div class="col-md-12 col-sm-12 col-xs-12 b-white">
              <div class="col-md-12" style="margin-bottom: 20px;">
                <div class="text-center titulo-cuenta">
                  <h2 class="titulos-lista">{{$servicio->titulo}}</h2>
                </div>
              </div>
              <div class="col-md-12">
                <form action="/servicios/{{$servicio->id}}/update" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                      <label>Titulo</label>
                      <input type="text" class="form-control" name="titulo" maxlength="110" value="{{$servicio->titulo}}">
                  </div>
                  <div class="form-group">
                      <label>Descripcion</label>
                      <textarea class="form-control" name="descripcion" maxlength="300">{{$servicio->descripcion}}</textarea>
                  </div>  
                  <button type="submit" class="btn btn-warning">Actualizar</button>
                </form>
              </div>
          </div>
        </div>
      </div>   
  </div>

</div>  


@endsection