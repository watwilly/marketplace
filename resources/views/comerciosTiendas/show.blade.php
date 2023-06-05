@extends('layouts.app')
<?php 
   $url = url()->full();

    if($tienda->banner):
        $banner =  Voyager::get_image($tienda->banner, NULL, 'storage'); 
    else:
        $banner = '/img/p1.png'; 
    endif

?>
@section('meta')
    <meta  name="title" content="{{$tienda->titulo}} " >
    <meta  name="description" content="@if($tienda->descripcion) {{str_limit($tienda->descripcion, 80)}} @else compra al mejor precio en {{$tienda->titulo}} el comercio digital en Republica Dominicana @endif ">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="@if($tienda->descripcion) {{str_limit($tienda->descripcion, 80)}} @else compra al mejor precio en {{$tienda->titulo}} el comercio digital en Republica Dominicana @endif" >
    <meta  property=og:site_name content="{{$tienda->titulo}}" >
    <title>{{$tienda->titulo}} en {{Voyager::setting('site.title')}} </title>
@stop

@section('content')
 <section class="min-height">
    <div class="banner">
        <div class="banner__background" style=" background-image: url('{{$banner}}');background-attachment: fixed;background-size: cover;background-position: center center;background-repeat: no-repeat;"></div>
        <div class="banner__foreground banner__foreground--curtain text-center text-lg-end">
            <h1 class="section__title fw-bold banner__title banner__title--primary">{{$tienda->titulo}}</h1>
            <h4 class="d-none d-lg-block fw-normal banner__title banner__title--light">@if($tienda->name){{$tienda->name}}@endif</h4>
        </div>
        <img src="{{Voyager::get_image($tienda->logo, 'cropped', 'storage')}}" alt="" class="banner__brand rounded border border-light">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0">
                @include('comerciosTiendas.filter')
            </div>
            @if(count($publicaciones) > 0)
                <div class="col-12 col-lg-8 col-xl-9 py-5">
                    <div class="row gy-3 gx-2 justify-content-center">
                        <div class="col-12">
                            <h2 class="text-center">Publicaciones de la tienda</h2>
                        </div>
                        @foreach($publicaciones as $publicacion)
                            {{Voyager::h_listview($publicacion["title"], $publicacion["id"], $publicacion["imagen"], $publicacion["storage"], $publicacion["precios"], 'small', $publicacion["prdcatname"], $publicacion["condicion"])}}
                        @endforeach
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                {{$render->render()}}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 col-lg-8 col-xl-9 py-5">
                    <div class="alert alert-info">Esta tienda no tiene publicaciones</div>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
