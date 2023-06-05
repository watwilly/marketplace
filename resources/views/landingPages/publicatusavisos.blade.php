@extends('layouts.app')
@section('content')




    @section('meta')

    <meta  name=title content="{{Voyager::setting('site.title')}}" >
    <meta  name=description content="marketplace donde comprar y vender es mucho mas barato">
    <meta  name=keywords content="compra venta, ventas en tucuman" >
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="{{Voyager::setting('site.description')}}" >
    <meta  property=og:site_name content="{{Voyager::setting('site.title')}}" >
    
    <title>Compra Venta Tucuman | Donde todo es mas barato</title>
    <link rel="stylesheet" href="https://blackrockdigital.github.io/startbootstrap-new-age/device-mockups/device-mockups.min.css">
    <link href="https://blackrockdigital.github.io/startbootstrap-new-age/css/new-age.min.css" rel="stylesheet">
    @append


    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5">Ventas Tucumán es un sitio web de compra venta en linea donde personas particulares y comerciantes pueden publicar y vender de todo.</h1>
            </div>
          </div>
          <div class="col-lg-5 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <img src="/img/v1.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section class="download bg-primary text-center" id="download">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 class="section-heading">Publicaciones infinitas.</h2>
            <p>Publica todo lo que quieras gratis, sin comisiones ni intermediarios.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="features" id="features">
      <div class="container">
        <div class="section-heading text-center">
          <h2>Crea tu tienda y obtiene Beneficios</h2>
          <hr>
        </div>
        <div class="row">
          <div class="col-lg-4 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <img src="/img/v2.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 my-auto">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-screen-smartphone text-primary"></i>
                    <h3>Visibilidad</h3>
                    <p class="text-muted">Los productos que perteneciesen a una tienda se verán siempre primero.</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-camera text-primary"></i>
                    <h3>Listado de productos </h3>
                    <p class="text-muted">Tendrás un listado solamente con tus publicaciones.</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-present text-primary"></i>
                    <h3>Contacto directo con el comprador</h3>
                    <p class="text-muted">Podrás tener contacto directo con tu comprador para definir los métodos de pago y entrega del producto</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-lock-open text-primary"></i>
                    <h3>Publicación de tu Marca </h3>
                    <p class="text-muted">El logo de tu tienda será visible siempre desde diferentes partes de nuestra plataforma</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta">
      <div class="cta-content">
        <div class="container">
          <h2>Vende lo que quieras <br> sin pagar comisión</h2>
        </div>
      </div>
      <div class="overlay"></div>
    </section>

    <section class="contact bg-primary" id="contact">
      <div class="container">
        <h2>Encuentra aquello que con 
          <i class="fa fa-heart"></i>
          has estado buscando</h2>
        <ul class="list-inline list-social">
          <li class="list-inline-item social-twitter">
            <a href="#">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item social-facebook">
            <a href="https://www.facebook.com/ventastucumana/">
              <i class="fa fa-facebook"></i>
            </a>
          </li>


        </ul>
      </div>
    </section>

@endsection