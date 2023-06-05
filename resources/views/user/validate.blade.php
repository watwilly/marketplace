@extends('layouts.app')

@section('meta')
  <title>Validacion de  cuenta</title>
@stop


@section('content')
<div class="container contop b-white">
  <div class=" @if($status == 'true') success @else error @endif col-md-12 text-center">
    @if($status == 'true')
      <div class="col-md-12">
        <h1>SU CUENTA HA SIDO VALIDADA</h1>
        <div class="text-center"><i class="fa fa-smile-o"></i></div>
        <p>Ahora puedes publicar productos y servicios, crear tu comercio digital y mas.</p>
      </div>
      <div class="col-md-12">
        <a href="/vender" class="btn btn-warning">Publicar productos</a>
        <a href="/comercio" class="btn btn-success">Crear comercio digital</a>
      </div>
    @else
      <div class="col-md-12">
        <h1>OCURRIO UN ERROR</h1>
        <div class="text-center"><i class=" fa fa-frown-o"></i></div>
        <p>Al parecer esta cuenta ya esta validada o no esta registrada en nuestro sistema</p>
      </div>
      <div class="col-md-12">
        <a href="/auth/user/register" class="btn btn-warning">Registrarme </a>
        <a href="/auth/user/login" class="btn btn-success">Ingresar</a>
      </div>
    @endif
  </div>
</div>

@endsection