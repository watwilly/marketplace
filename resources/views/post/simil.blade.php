@extends('layouts.app')

@section('meta')
    <meta  name=title content="{{$posts->title}}" >
    <meta  name=description content="{{str_replace('-', '',  str_limit($posts->body, 130))}}">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="Vender por catalogo {{$posts->title}} en tucuman donde vender online es facil" >
    <meta  property=og:site_name content="{{$posts->title}}" >
    <title> Vender por internet {{$posts->title}} vende en Tucumán</title>
    <link rel="stylesheet" href="https://www.ventastucuman.com/OwlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://www.ventastucuman.com/OwlCarousel/dist/assets/owl.theme.default.min.css">

@stop


@section('content')
<div class="container-fluid py-5">
	<div class="col-md-3 col-xs-12 " style="background: white;">
		<div class="col-md-12 col-xs-12">
			<h3>Original</h3>
		</div>
		<div class="col-md-12 col-xs-12">
			<div class="col-md-12 col-xs-12">
				<?php $postImagenes = $posts->postimagenes()->get(); ?>
				<div class="owl-carousel owl-theme">
					@foreach($postImagenes as $img)
						<img src="{{Voyager::get_image($img->imagen, 'medium', $img->storage)}}" class="img-responsive">
					@endforeach
				</div>
			</div>

			<div class="col-md-12 col-xs-12">
				<h3>{{$posts->title}}</h3>
			</div>
			<div class="col-md-12">
				@if($posts->descuentos)
	
					<div class="col-md-3 sinpadding c-black">
						Antes <del><h6>$ {{$posts->precios}}</h6></del>
					</div>
					<div class="col-md-3 sinpadding">
						<h5 style="color: #ff6a00;font-size: 15px!important;">Ahora ${{$posts->returnDescuento($posts->precios, $posts->descuentos)}} <small> % {{$posts->descuentos}} OFF</small></h5>
					</div>
				@else
					<div class="col-md-3 sinpadding c-black">
						<h6>$ {{$posts->precios}}</h6>
					</div>				
				@endif				
			</div>
		</div>
	</div>
	<div class="col-md-8 col-xs-12" style="    border-left: 8px solid #0070c2;">
		<div class="col-md-12">
			<h1><b> {{$posts->name}}</b></h1>
		</div>
		<div class="postList">
            <div id="load_data" class="row my-3"></div>
            <div id="load_data_message" class="text-center"></div>
		</div>	
	</div>
</div>
@section('jsfooter')
<script src="https://www.ventastucuman.com/OwlCarousel/dist/owl.carousel.min.js"></script>
<script>
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:2,
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:2,
            nav:false,
            loop:false
        }
    }
})

$(document).ready(function(){
  var limit = 10;
  var start = 0;
  var action = 'inactive';
  function load_country_data(limit, start)
  {
    $.ajax({
      url:"/get-simil",
      method:"POST",
      data: {limit:limit,msg_id:1,post_id:{{$posts->id}}, start:start,"_token":"{{ csrf_token() }}"},
      cache:false,
      success:function(data)
      {
          $('#load_data').append(data);
          if(data == '')
          {
            $('#load_data_message').html("");
            action = 'active';
          }
          else
          {
            $('#load_data_message').html("<button type='button' class='btn btnmore boton text-center'>Cargando más publicaciones…</button>");
            action = "inactive";
          }
        } //end success
    }); //End ajax
  }//End method

  if(action == 'inactive')
  {
    action = 'active';
    load_country_data(limit, start);
  }
  $(window).scroll(function(){
    if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
    {
      action = 'active';
      start = start + limit;
      setTimeout(function(){
        load_country_data(limit, start);
      }, 1000);
    }
  });
  //}
});


</script>
@append


@endsection