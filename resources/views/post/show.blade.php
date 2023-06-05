@extends('layouts.app')

@section('meta')
    <meta  name="title" content="{{$post->title}}" >
    <meta  name="description" content="Precio:${{$post->precios}} {{str_replace('-', '',  str_limit($post->body, 130))}}" />
    <meta  property=og:description content="Precio:${{$post->precios}}  {{str_replace('-', '',  str_limit($post->body, 130))}}" />
    <meta  property=og:site_name content="{{$post->title}}" >
    <meta property="og:title" content="{{$post->title}}" />
    <meta  name="keywords" content="{{$post->category_name}}, {{$post->subcategory_name}}" />
    <title>{{$post->title}} </title>
    <meta name="twitter:title" content="{{$post->title}}" /> 
    <meta name="twitter:description" content="{{str_replace('-', '',  str_limit($post->body, 130))}}" /> 
@stop

@section('content')
<section class="min-height">
    <div class="container">
        <div class="col-12 mt-3 d-none d-md-block">
            <nav aria-label="breadcrumb" class="bg-secondary rounded-pill py-3 px-5">
                <ol class="breadcrumb m-0">
                    @if(!is_null($post->category_id))
                      <li class="breadcrumb-item section__title fw-bold"><a href="/categoria/{{$post->category_id}}/{{str_slug($post->category_name)}}">{{$post->category_name}}</a></li>
                    @endif
                    @if(!is_null($post->subcategoryId))
                      <li class="breadcrumb-item section__title fw-bold"><a href="/categoria/{{$post->subcategoryId}}/{{str_slug($post->subcategory_name)}}">{{$post->subcategory_name}}</a></li>
                    @endif
                    @if(!is_null($post->ma_name))
                      <li class="breadcrumb-item section__title fw-bold active" aria-current="page">{{$post->ma_name}}</li>
                    @endif
                    @if(!is_null($post->mo_name))
                      <li class="breadcrumb-item section__title fw-bold active" aria-current="page">{{$post->mo_name}}</li>
                    @endif
                </ol>
            </nav>
        </div>
        <div class="col-12 p-3">
          <!-- Ads product - saldeello.com - 2023 -->
          <ins class="adsbygoogle"
              style="display:block"
              data-ad-client="ca-pub-4090153222985235"
              data-ad-slot="1224030602"
              data-ad-format="auto"
              data-full-width-responsive="true"></ins>
          <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>

        <div class="product my-3">
            @if($imagenes->count() > 0)
              <div class="product__view">
                  <div class="container-fluid shadow rounded bg-white">
                      <div class="slider slider--main slider-show">
                        @foreach($imagenes as $imagen)
                          <img src="{{Voyager::get_image($imagen->imagen, NULL, $imagen->storage)}}" alt="{{$post->title}}" class="slider__frame slider__frame--slide">
                          <?php $thubnail[] = $imagen; ?>
                        @endforeach
                      </div>
                      <div class="slider slider-nav">
                        @foreach($thubnail as $th)
                          <img src="{{Voyager::get_image($th->imagen, 'small', $imagen->storage)}}" alt="{{$post->title}}" class="slider__frame slider__frame--nav">
                        @endforeach
                      </div>
                  </div>
              </div>
            @endif
            <div class="product__price">
                <div class="container-fluid py-3 h-100 shadow rounded bg-white">
                    @if($tienda)
                    <div class="row align-items-center">
                        <div class="col-3 col-sm-2 col-lg-3">
                            <a href="/comercio/{{str_slug($tienda->titulo, '-')}}/{{$tienda->id}}">
                                <img src="{{Voyager::get_image($tienda->logo, 'cropped', 'storage')}}" alt="" class="rounded-circle shadow img-fluid">
                            </a>
                        </div>
                        <div class="col-9 col-sm-10 col-lg-9">
                            <a href="stores.show.php" class="custom-link link-secondary">
                                <h4 class="section__lead h6 text-truncate">{{str_limit($tienda->titulo, 25)}}</h4>
                            </a>
                        </div>
                    </div>
                    @endif

                    <hr class="my-4">
                    <h4 class="mb-4">{{$post->title}}</h4>
                    <h5 class="mb-4 section__title fw-bold">
                        @if($post->precios == 1 or $post->precios == 0) PRECIO A CONVENIR @else RD ${{$post->precios}} @endif
                    </h5>
                    @if($post->condicion=='like-new') 
                      <span class="rounded-pill bg-secondary text-light section__title h6 fw-bold px-5 py-2"> Usado como nuevo </span>
                    @elseif($post->condicion=='nuevo') 
                      <span class="rounded-pill bg-success text-light section__title h6 fw-bold px-5 py-2">NUEVO</span>
                    @else
                      <span class="rounded-pill bg-secondary text-light section__title h6 fw-bold px-5 py-2">{{$post->condicion}}</span>
                    @endif
                    <hr class="my-4">

                    <h6>Información del vendedor:</h6>
                    @if($post->provincia)
                    <div class="d-block rounded-pill bg-light border border-gray h6 fw-bold px-3 py-2">
                        <i class="fas fa-map-marker-alt"></i>
                        {{$post->provincia}}, {{$post->localidad}}
                    </div>
                    @endif
                    @if(!is_null($post->telefono))
                      <div class="d-block rounded-pill bg-light border border-gray h6 fw-bold px-3 py-2">
                          <i class="fas fa-phone-alt"></i>
                          {{$post->telefono}}
                      </div>
                    @endif

                    @if($colores->count() !== 0)
                      <hr class="my-4"> 
                      <h6>Colores disponibles:</h6>
                      <div class="d-flex flex-wrap justify-content-center">
                          @foreach($colores as $colores)
                            <?php
                              $atributo_color = $colores->colores()->first();
                            ?>
                            <a href="#" id="color{{$atributo_color->id}}" onclick="get_atribute({{$atributo_color->id}}, 'color', {{$post->id}} )" class="picker-color rounded-circle border border-3 border-dark card-hover" style="background-color: {{$atributo_color->color}};"></a>
                          @endforeach
                        </div>
                    @endif

                    @if($talles->count() !== 0)
                      <hr class="my-4">
                      <h6>Talles disponibles:</h6>
                      <div class="d-flex flex-wrap justify-content-center">
                        @foreach($talles as $talles)
                          @php
                            $atributo_talle = $talles->talles()->first();
                          @endphp
                          <a href="#" id="talle{{$atributo_talle->id}}"  onclick="get_atribute({{$atributo_talle->id}}, 'talle', {{$post->id}} )" data-toast="1" class="toast-btn-toggle rounded bg-dark text-light h6 p-2 me-2 mb-2">{{$atributo_talle->talle}}</a>
                        @endforeach
                      </div>
                    @endif
                    <hr class="my-4">
                        <!-- Anuncio Home saldeello.com -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8375200710331851"
                             data-ad-slot="1758379272"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    <hr class="my-4">
                      <div class="d-grid gap-2">
                          @if($tienda)
                            <a href="/tienda/{{str_slug($tienda->titulo)}}/{{$tienda->id}}" class="btn btn-outline-success">Ver más publicaciones del vendedor</a>
                          @endif
                          <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-report">Denunciar publicación</button>
                      </div>
                      @if($v1)
                      <div class="d-grid gap-2">
                        <hr class="my-4">
                        <a href="{{$v1->link}}" target="_blank"><img src="{{Voyager::get_image($v1->banner, null, 'storage')}}" class="img-fluid"></a>
                      </div>
                      @endif
                </div>
            </div>
            <div class="product__description">
                <div class="container-fluid py-3 shadow rounded bg-white">
                  <h5 class="border-bottom border-gray mb-3">Descripción de la publicación</h5>
                   
                      <ul class="list-group list-group-flush h5 mb-3">
                          @if(!is_null($post->ma_name))
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                <span class="text-muted fw-normal">Marca</span>
                                <b>{{$post->ma_name}}</b>
                            </li>
                          @endif

                          @if(!is_null($post->mo_name))
                          <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                              <span class="text-muted fw-normal">Modelo</span>
                              <b>{{$post->mo_name}}</b>
                          </li>
                          @endif
                          @if(!is_null($post->category_id) && $post->category_id == 6)
                            <?php $vehiculo =  $post->postsvehiculos()->first(); ?>

                                @if(!is_null($vehiculo->tipos_vehiculos_id))
                                  <?php $tipoVehiculos = $vehiculo->tiposvehiculos()->first(); ?>
                                  <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                      <span class="text-muted fw-normal">Tipo</span>
                                      <b>{{$tipoVehiculos->name}}</b>
                                  </li>
                                @endif
                                <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                    <span class="text-muted fw-normal">Año</span>
                                    <b>{{$vehiculo->anio}}</b>
                                </li>
                                <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                    <span class="text-muted fw-normal">Kilometraje</span>
                                    <b>{{$vehiculo->kilometros}}</b>
                                </li>
                                <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                    <span class="text-muted fw-normal">Transmisión</span>
                                    <b>{{$vehiculo->transmision}}</b>
                                </li>
                                @if(!is_null($vehiculo->colores_id))
                                  <?php $color = $vehiculo->colores()->first(); ?>
                                  <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                      <span class="text-muted fw-normal">Color</span>
                                      <b style="border: 1px solid {{$color->color}};">color</b>
                                  </li>
                                @endif
                          @endif
                      </ul>

                    @php
                      $body = str_replace("\n", "<p>", $post->body);
                    @endphp
                    <p>{!! $body !!}</p>

                    <div class="row g-3 mt-3">
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u={{url()->current()}}','Compartir', 'toolbar=0, status=0, width=650, height=450');" class="d-block w-100 btn btn-blue">
                                <i class="fab fa-facebook-square"></i> Compartir
                            </a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href=" https://api.whatsapp.com/send?text= Mira que bueno esta, {{url()->current()}}" class="d-block w-100 btn btn-green text-white">
                                <i class="fab fa-whatsapp"></i> Compartir
                            </a>
                        </div>
                    </div>
                    @if($h1)
                      <div class="row g-3 mt-3">
                        <div class="col-12 col-md-6 col-lg-12">
                            <a href="{{$h1->link}}" target="_blank"><img src="{{Voyager::get_image($h1->banner, null, 'storage')}}" class="img-fluid"></a>
                        </div>
                      </div>
                    @endif
                </div>
            </div>
            <div class="product__questions">
                <div class="container-fluid py-3 shadow rounded bg-white">
                    <h5 class="border-bottom border-gray mb-3">Consultas al vendedor</h5>
                    <div class="mb-3 row g-2 align-items-center">
                        <div class="col-12 col-md-8 col-lg-10">
                            <input type="text" name="consulta" maxlength="255" id="consulta" class="form-control" placeholder="Escribí aquí tu consulta...">
                        </div>
                        <div class="col-12 col-md-4 col-lg-2">
                          @if(Auth::check())
                            <button class="btn btn-outline-info w-100" onclick="btnbconsulta();">Enviar</button>
                          @else
                            <a href="/auth/user/login" class="btn btn-outline-info w-100">Enviar</a>
                          @endif
                        </div>
                    </div>

                    <h5 class="mb-3 mt-5">Últimas Consultas </h5>
                    <div id="autoload">
                      @if($consultas->count()>0)
                        @foreach($consultas as $consulta)
                            <div class="alert alert-gray">
                                <h6 class="text-black">{{$consulta->mensaje}}</h6>
                                @if($consulta->answered)
                                <p class="ms-4" style="word-break: break-all;">{{$consulta->answered}}</p>
                                @endif
                                <span class="d-block text-end">{{$consulta->created_at->todateString()}}</span>
                            </div>
                        @endforeach
                      @else
                        <div class="alert alert-info">Nadie ha comentado nada, se el primero en hacerlo.</div>
                      @endif
                    </div>
                </div>
            </div>

            <div class="product__similars">
                <div class="container-fluid py-3 shadow rounded bg-white">
                    <h5 class="border-bottom border-gray mb-3">Publicaciones Similares</h5>

                    <div class="slider slick-theme slider--home">
                        <div class="slider__container">
                          @if($simil->count()>0)
                            @foreach($simil as $simils)
                              <?php 
                                $imgsimil = $simils->postimagenes()->limit(1)->first();
                                $las_storage = NULL;
                                $laspImg = NULL;
                                if ($imgsimil) {
                                    $laspImg = $imgsimil->imagen;
                                    $las_storage = $imgsimil->storage;
                                }
                              ?>
                                <div class="card card-hover mx-2">
                                    <img src="{{voyager::get_image($laspImg,'small',$las_storage)}}" class="card-img-top" alt="{{$simils->title}}">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title m-0 text-truncate h6">{{str_limit($simils->title,37)}}</h5>
                                            <p class="card-text m-0 section__title fw-bold">
                                                RD ${{$simils->precios}}
                                            </p>
                                    </div>
                                    <a href="/rd-{{$simils->id}}/{{str_slug($simils->name,'-')}}/{{str_slug($simils->condicion)}}/{{str_slug($simils->title)}}" class="stretched-link"></a>
                                </div>
                              @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modal-report" tabindex="-1" aria-labelledby="modal-report-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h5 class="modal-title" id="modal-report-label">Denunciar publicación</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <form action="/reportaraviso" method="post">
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="modal-body">
                <h6 class="mb-5">{{$post->title}}</h6>
                <textarea name="detalle_reporte" maxlength="200" class="form-control" id="modal-report-text" rows="5" placeholder="Escribí aquí el motivo de la denuncia. Se admiten hasta 200 caracteres."></textarea>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger text-light">Enviar</button>
            </div>
          </form>
        </div>
    </div>
</div>

@endsection

@section('jsheader')
   @if($imagenes->count() > 0)
    <meta property="og:image" content="@if($imagen->storage !='online') https://www.saldeello.com{{Voyager::get_image($imagen->imagen, 'small', $imagen->storage)}} @else {{Voyager::get_image($imagen->imagen, 'small', $imagen->storage)}}  @endif"/>
    <meta name="twitter:image" content="@if($imagen->storage !='online') https://www.saldeello.com{{Voyager::get_image($imagen->imagen, 'small', $imagen->storage)}} @else {{Voyager::get_image($imagen->imagen, 'small', $imagen->storage)}}  @endif">
  @endif 
  <script type='application/ld+json'> 
      {
        "@context": "http://www.schema.org",
        "@type": "product",
         "sku": "{{str_slug($post->title,'-')}}-{{$post->id}}-{{str_slug($post->category_name,'-')}}",
        "brand": "@if(!is_null($post->ma_name)){{$post->ma_name}} @else saldeello @endif",
        "name": "{{$post->title}}",
        @if($imagenes->count() > 0) "image": @if($imagen->storage !='online') "https://www.saldeello.com/storage/{{$imagen->imagen}}" @else "{{$imagen->imagen}}" @endif , @endif
        "description": "{{str_replace('-', '',  str_limit($post->body, 130))}}",
        "aggregateRating": {
          "@type": "aggregateRating",
          "ratingValue": "5.0",
          "reviewCount": "{{$cant_visitas}}"
        },

        "review": {
          "@type": "Review",
          "reviewRating": {
            "@type": "Rating",
            "ratingValue": "4",
            "bestRating": "5"
          },
          "author": {
            "@type": "Person",
            "name": "Willy Arredondo"
          }

          },
        "offers": {
          "@type": "Offer",
          "url": "https://www.saldeello.com/rd-{{$post->id}}/{{(str_slug($post->category_name,'-'))}}/{{str_slug($post->title)}}",
          "priceCurrency": "ARS",
          "price": "{{$post->precios}}",
          "priceValidUntil": "{{$post->created_at->format("Y-m-d")}}",
          "itemCondition": "https://www.saldeello.com/nota/2/condiciones-de-uso-online",
          "availability": "InStock",
          "seller": {
            "@type": "Organization",
            "name": "saldeello"
          }
        }
      }
  </script>
@append

@section('jsfooter')
<script>

  function autoload(postId) {
    var request = new XMLHttpRequest();

    request.open('GET', '/autload-consultas/'+postId, true);

    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        var resp = request.responseText;
        document.querySelector('#autoload').innerHTML = resp;
      }
    };

    request.send();
  }

  function btnbconsulta() {
   var consulta = $("#consulta").val();

   if (consulta==""){
    var myElement = document.getElementById("consulta");
    myElement.setAttribute('style', 'border: 1px solid #dc3545');
    return;
   }
    showload();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response["status"]=="success"){
          autoload({{$post->id}});
        }
        toastr(response["status"],response["msg"]);
        hideload();
      }
    };
    xhttp.open("POST", "/interesados-consultas", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta="+consulta+"&_token="+"{{csrf_token()}}&postId="+{{$post->id}});
 
 }
 function get_atribute(a, b, c) {
    showload();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (b=="talle"){
          d="Talle";
        }else{
          d="Color";
        }
        toastr("success","El "+d+" ha sido seleccionado");
        var myElement = document.getElementById(b+a);
        hideload();
      }
    };
    xhttp.open("POST", "/select-post-atribute", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("atributo_id="+a+"&_token="+"{{csrf_token()}}&atributo="+b+"&post_Id="+c);
 }

 function addCart(i,rightnow=null) {
   var cantidad = $("#cantidad").val();
   var now = rightnow

   if (cantidad==""){
    var myElement = document.getElementById("cantidad");
    myElement.setAttribute('style', 'border: 1px solid #dc3545');
    toastr("warning","Seleccione la cantidad");
    return;
   }
    showload();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        toastr(response["status"],response["msg"]);
        
        if(now){
          window.location = response["url"];
        }

        hideload();
      }
    };
    xhttp.open("POST", "/addtoCart", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("post_id="+i+"&_token="+"{{csrf_token()}}&cantidad="+cantidad+"&rightnow="+now);
 }

 function buynow(pubId) {
   addCart(pubId,true);
 }
</script>
@append

