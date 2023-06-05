@extends('layouts.app')
@section('content')

@section('meta')
    <meta  name=title content="Clasificacion de Servicios en Dominicana - saldeello.com" >
    <meta  name=description content="{{str_limit($servicio->descripcion, 90)}}">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="{{str_limit($servicio->descripcion, 90)}}" >
    <meta  property=og:site_name content="{{$servicio->titulo}}" >
    <title>{{$servicio->titulo}}</title>
@stop
<div class="container-fluid" style="margin: 25px;">
	<div class="row">
		<div class="col-md-4">
			<img src="/storage/{{$servicio->foto}}" class="img-responsive">
		</div>
		<div class="col-md-8 b-white">
			<h1 style="margin-bottom: 25px;">Servicio de, <b>{{$servicio->titulo}}</b></h1>
			<h4>Ponte en contacto con estos datos:</h4>
			<ul>
				<li>Telefono de Contacto: {{$servicio->telefono}}</li>
				<li>Email: {{$servicio->email}}</li>
			</ul>
			<h4>Mas detalle del servicio:</h4>
			<p>Detalle: {{$servicio->descripcion}}</p>			
		</div>
	</div>
</div>
@endsection