@extends('layouts.app')
@section('content')

@section('meta')
    <meta  name="title" content="{{$oferta->titulo}}" >
    <meta  name="description" content="{{str_limit($oferta->descripcion, 110)}}">
    <meta  name=keywords content="{{$oferta->titulo}}">
    <meta  property=og:description content="{{$oferta->descripcion}}" >
    <meta  property=og:site_name content="{{$oferta->titulo}}" >
    <title>{{$oferta->titulo}} </title>
@stop
<div class="container-fluid trabajo" style="margin: 15px;">
		<div class="col-md-8 row  b-white" style="margin: auto;float: initial;">
			<h2>Detalles del trabajo</h2>
			<hr>
			<ul>
				<li><b></b></li>
				<li><b>Puesto:</b> {{$oferta->puesto}}</li>
				<li><b>Vacantes:</b> {{$oferta->vacantes}}</li>
				<li><b>Dirección Laboral:</b> {{$oferta->direccion}}</li>
				@if($oferta->email)<li><b>E-mail Corporativo:</b> {{$oferta->email}}</li>@endif
				<li><b>Fecha de Publicación:</b> {{$oferta->created_at->todateString()}}</li>
			</ul>
			<hr>
			<h2>Descripción</h2>
			<h1>{{$oferta->titulo}}</h1>
  				@php
                    $body = str_replace("\n", "<p>", $oferta->descripcion);
                @endphp
            <h3>{!! $body !!}</h3>
            @if($oferta->imagen)
			<h2>Descripción gráfica del empleo</h2>
			<img src="{{voyager::get_image($oferta->imagen,null,null)}}" class="img-responsive"  style="margin-bottom: 12px;" alt="{{$oferta->titulo}}">
			@endif

            <div class="col-md-8" style="margin: auto;float: initial;">
	            <div class="col-md-4">
	            	@if(Auth::check())
                        <?php 
                            $user = Auth::user();
                            $postulado = $oferta->postulanteId()->where('user_id', $user->id)->first();
                        ?>
                        @if(is_null($postulado))
	            		<a href="#postularme" data-toggle="modal" data-target="#exampleModal" class="btn btn-success">Postularse</a>
                        @else
                            <a href="#postulado" class="btn btn-warning">Ya estas postulado</a>
                        @endif
	            	@else
	            		<a href="/auth/user/login" class="btn btn-success">Postularse</a>
	            	@endif
	            </div>
	            <div class="col-md-3">
	            	<a href="/republica-dominicana/empleos" class="btn btn-info">Volver al listado</a>
	            </div>
	            <div class="col-md-3 text-right">
	                <div class="sharer" style="padding: 0;">
	                    <a href="javascript:void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=https://www.saldeello.com/empleo/{{str_slug($oferta->puesto,'-')}}/{{str_slug($oferta->titulo, '-')}}/{{$oferta->id}}','Compartir', 'toolbar=0, status=0, width=650, height=450');" title="Compartir en Facebook!" class="facebook">
	                        <i class="fa fa-facebook"></i>
	                    </a>  
	                   <a href=" https://api.whatsapp.com/send?text=Postulate a este trabajo, https://www.saldeello.com/empleo/{{str_slug($oferta->puesto,'-')}}/{{str_slug($oferta->titulo, '-')}}/{{$oferta->id}}" target="_blank" class="whatsapp">
	                        <i class="fa fa-whatsapp"></i>
	                    </a>
	                </div>
	            </div>            	
            </div>

		</div>
      @if(Auth::check())
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Postularse a {{$oferta->titulo}}</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p>¿ Seguro que deseas postularte a este empleo?</p>
		      </div>
		      <div class="modal-footer">
		        <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <a href="/postularme/{{$oferta->id}}/{{str_slug($oferta->titulo,'-')}}" class="btn btn-success">Postularse</a>
		      </div>
		    </div>
		  </div>
		</div>
		@endif

</div>
@endsection