@extends('layouts.app')

@section('meta')
    <meta  name="title" content="{{Voyager::setting('site.title')}}" >
    <meta  name="description" content="{{Voyager::setting('site.description')}}">
    <meta  name="keywords" content="{{Voyager::setting('site.keywords')}}" >
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:image content="https://www.saldeello.com/storage/{{Voyager::setting('site.ogimage')}}" >
    <meta  property=og:title content="{{Voyager::setting('site.title')}}" >
    <meta  property=og:description content="{{Voyager::setting('site.description')}}" >
    <meta  property=og:site_name content="{{Voyager::setting('site.title')}}" >
    <meta name="twitter:title" content="{{Voyager::setting('site.title')}}" > 
    <meta name="twitter:image" content="https://www.saldeello.com/storage/{{Voyager::setting('site.ogimage')}}">
    <meta name="twitter:description" content="{{Voyager::setting('site.description')}}" > 

    <title>{{Voyager::setting('site.title')}}</title>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://www.saldeello.com/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://www.saldeello.com/search?data={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://www.saldeello.com",
      "name":"Saldeello",
      "logo": "https://www.saldeello.com/storage/{{Voyager::setting('site.logo')}}",
        "sameAs": [
        "https://www.facebook.com/saldeello.20",
        "https://www.instagram.com/saldeello/"
      ],
       "address": {
       "@type": "PostalAddress",
       "streetAddress": "Santo Domingo Este",
       "addressRegion": "DOM",
       "postalCode": "11605",
       "addressCountry": "DOP"
     }
    }
    </script>

@stop


@section('content')

@if($sliders->count() > 0)
  <div class="section slider slider--main">
      <div class="slider__container">
          @foreach($sliders as $showSlider)
            <div class="slider__item">
                <img src="/storage/{{$showSlider->image}}" alt="{{$showSlider->tittle}}" class="slider__background">
                <div class="slider__foreground text-center">
                    <!--<h2 style="font-size: 34px;" class="display-lg-2 section__title fw-bold slider__title slider__title--primary">{{$showSlider->tittle}}</h2>
                    <h3 style="    font-size: 22px;" class="display-lg-6 d-none d-md-block fw-normal slider__title slider__title--light">saldeello.com Tu compra venta Online</h3>-->
                    <a href="{{$showSlider->link}}" class="mt-2 mt-md-5 btn btn-primary">Tiendas Online</a>
                </div>
            </div>
          @endforeach
      </div>
  </div>
@endif
<section class="section text-center">
  <!-- Anuncio home 2 JUNIOR-->
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-8375200710331851"
       data-ad-slot="1604596297"
       data-ad-format="auto"
       data-full-width-responsive="true"></ins>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</section>

<section class="section">
    <div class="container">
    <h1 class="section__title h3 text-center">
          <b>Publicá tu tienda</b> en nuestro <b>Marketplace Republica Dominicana.</b>
          <br>
          Encuentra todo los que estas buscando cerca tuyo.
      </h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="d-flex flex-wrap aling-items-center mb-4">
            <h4 class="section__lead">Productos más visitados</h4>
            <a href="#" class="btn btn-outline-secondary ms-auto">Ver más</a>
        </div>
        <div class="slider slick-theme slider--home">
            <div class="slider__container">
              @foreach($visitas as $visita)
                  <?php 
                    $imagen =  \App\Models\PostImagenes::select('imagen', 'storage')->where("posts_id",$visita->id)->orderBy('orden', 'ASC')->take(1)->first();
                  ?>
                  @if($imagen)
                    <div class="card card-hover mx-2">
                        <img data-src-load="{{Voyager::get_image($imagen->imagen, 'medium', $imagen->storage)}}" class="card-img-top index-img" alt="{{$visita->title}}">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title m-0 text-truncate h6">{{str_limit($visita->title, 38)}}</h5>
                            <p class="card-text m-0 section__title fw-bold">
                                RD ${{$visita->precios}}
                            </p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text text-muted">+{{$visita->cant_visita}} visitaron este producto</p>
                        </div>
                        <a href="/rd-{{$visita->id}}/{{str_slug($visita->name,'-')}}/{{$visita->condicion}}/{{str_slug($visita->title)}}" class="stretched-link"></a>
                    </div>
                  @endif
              @endforeach
            </div>
        </div>
    </div>
</section>

@if($h1)
<section class="section">
  <div class="container">
    <img data-src-load="{{Voyager::get_image($h1->banner, null, 'storage')}}" class="index-img img-fluid w-100">
  </div>
</section>
@endif
<section class="section">
    <div class="container">
        <div class="d-flex flex-wrap aling-items-center mb-4">
            <h4 class="section__lead">Tiendas Digitales</h4>
            <a href="/tiendas-digitales" class="btn btn-outline-secondary ms-auto">Ver más</a>
        </div>
        <div class="slider slick-theme slider--home">
            <div class="slider__container">
              @foreach($tiendas as $tienda)
                <div class="card overflow-hidden card-hover mx-2">
                    <img data-src-load="{{Voyager::get_image($tienda->logo, 'cropped','storage')}}" class="index-img card-img-top" alt="{{$tienda->titulo}}">
                    <div class="card-header-overlay">
                        <h5 class="card-title text-center m-0 section__lead h6">{{str_limit($tienda->titulo,38)}}</h5>
                    </div>
                    <a href="/tienda/{{str_slug($tienda->titulo)}}/{{$tienda->id}}" class="stretched-link"></a>
                </div>
              @endforeach
            </div>
        </div>
    </div>
</section>
<section class="section text-center">
    <!-- Horizontal Willy 1 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-4090153222985235"
         data-ad-slot="2599220058"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</section>
<!--Item a desarrollar-->
<section class="section">
    <div class="container">
        <div class="grid rows-4 cols-1 cols-lg-4" style="min-height: 500px;">
            <div class="grid-item p-3 bRD-primary-7-lg bg-dark a-lg-4x1">
                <a @if($v1) href="{{$v1->link}}" target="_blank" @else href="/" @endif>
                    <div class="d-flex flex-wrap flex-column h-100 justify-content-evenly align-items-center">
                        @if($v1)
                          <img data-src-load="{{Voyager::get_image($v1->banner, null, 'storage')}}" alt="" class="index-img img-fluid">
                        @else
                          <img data-src-load="assets/img/logos.png" alt="" class="index-img img-fluid">
                          <h3 class="text-shadow text-light text-center">Crea tu  tienda gratis</h3>
                        @endif
                    </div>
                </a>
            </div>
            <div class="grid-item p-3 bRD-primary-3-sm bg-dark a-lg-2x3">
                <a @if($h2) href="{{$h2->link}}" target="_blank" @else href="/" @endif>
                    <div class="d-flex flex-wrap h-100 justify-content-center align-items-center">
                        @if($h2)
                          <img data-src-load="{{Voyager::get_image($h2->banner, null, 'storage')}}" alt="" class="index-img img-fluid" style="height: 230px;">
                        @else
                          <img style="max-width: 333px;" data-src-load="/storage/{{setting('site.logo')}}" alt="" class="img-fluid index-img">
                          <h3 class="lead text-light">Publica gratis y vende mas</h3>
                        @endif
                    </div>
                </a>
            </div>
            <div class="grid-item p-3 bRD-primary-5-sm bg-dark r-2 a-lg-2x2">
                <div class="container-fluid">
                    <div class="row gy-2">
                        <div class="col-12 col-md-6 col-lg-8">
                            <h6 class="text-light">Creando tu tienda en nuestro sitio web podras tener todos tus productos y servicios en un solo lugar, tambien puedes crear multiples tiendas</h6>
                            <a href="/tiendas-digitales" class="btn btn-outline-primary mt-3">Ver más</a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <img data-src-load="assets/img/cards/c002.jpg" alt="" class="index-img img-fluid rounded border shadow">
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-item p-3 bRD-primary-1-sm bg-dark r-lg-2">
                <div class="text-end">
                    <h3 class="lead text-light">Registrate con Facebook o Google.</h3>
                    <a href="/auth/user/register" class="btn btn-outline-primary mt-3">Ver más</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End item a desarrollar-->

<section class="section">
    <div class="container">
        <div class="d-flex flex-wrap aling-items-center mb-4">
            <h4 class="section__lead">Mejores Precios</h4>
            <a href="/promociones" class="btn btn-outline-secondary ms-auto">Ver más</a>
        </div>
        <div class="slider slick-theme slider--home">
            <div class="slider__container">
              @foreach($ofertas as $oferta)
                <?php 
                  $imgOfertas =  $oferta->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();
                ?>
                 @if($imgOfertas)
                    <div class="card card-hover mx-2">
                       <img data-src-load="{{Voyager::get_image($imgOfertas->imagen, 'medium', $imgOfertas->storage)}}" class="card-img-top index-img" alt="{{$oferta->title}}">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title m-0 text-truncate h6">{{str_limit($oferta->title, 38)}}</h5>
                            <p class="card-text m-0 section__title fw-bold">
                                RD ${{$oferta->precios}}
                            </p>
                        </div>
                        <a href="/rd-{{$oferta->id}}/{{str_slug($oferta->name,'-')}}/{{$oferta->condicion}}/{{str_slug($oferta->title)}}" class="stretched-link"></a>
                    </div>
                    @endif
              @endforeach
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php 
            $n=1;
        ?>
        @foreach ($categorias as $categoria)
         
          @if(!is_null($categoria->parent_id))
            <?php $pro = $categoria->postpersubCategory();?>
          @else
            <?php $pro = $categoria->posts(); ?>
          @endif

          <?php 
            $pro->select('condicion','posts.id','title', 'body', 'marca_id', 'precios', 'posts.created_at', 'pv.cant_visita');
            $pro->where('status', 'PUBLISHED');
            $pro->leftjoin('posts_visitas as pv', 'posts.id','=','pv.posts_id');
            $pro = $pro->inRandomOrder()->take(8)->get(); 
          ?>

          <div class="d-flex flex-wrap aling-items-center mb-4">
            <h4 class="section__lead">{{$categoria->name}}</h4>
            <a href="/categoria/{{$categoria->id}}/{{str_slug($categoria->name, '-')}}" class="btn btn-outline-secondary ms-auto">Ver más</a>
          </div>
          <div class="slider slick-theme slider--home">
              <div class="slider__container">
              @foreach($pro as $productos)
                    <?php 
                      $imagenes =  $productos->postimagenes()->select('imagen', 'storage')->orderBy('orden', 'ASC')->take(1)->first();
                    ?>
                    @if($imagenes)
                    <div class="card card-hover mx-2">
                        <img data-src-load="{{Voyager::get_image($imagenes->imagen, 'medium', $imagenes->storage)}}" class="card-img-top index-img" alt="{{$productos->title}}">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title m-0 text-truncate h6">{{str_limit($productos->title, 38)}}</h5>
                            <p class="card-text m-0 section__title fw-bold">
                                RD ${{$productos->precios}}
                            </p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text text-muted">+{{$productos->cant_visita}} visitaron este producto</p>
                        </div>
                        <a href="/rd-{{$productos->id}}/{{str_slug($categoria->name,'-')}}/{{$productos->condicion}}/{{str_slug($productos->title)}}" class="stretched-link"></a>
                    </div>
                    @endif
                @endforeach
              </div>
          </div>
          @if($n==1)
            <div class="row">
                <div class="col-md-6 text-center p-3">
                    <!-- Ventas tucuman pruducto 1 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-4090153222985235"
                         data-ad-slot="1292236182"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>                
                </div>
                <div class="col-md-6 text-center p-3">
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-8375200710331851"
                         data-ad-slot="2607186321"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>                
            </div>

          @endif
          @if($n==4)
            <div class="row">
                <div class="col-md-6 text-center p-3">
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-ad-format="fluid"
                         data-ad-client="ca-pub-8375200710331851"
                         data-ad-slot="3702127664"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>                   
                </div>
                <div class="col-md-6 text-center p-3">
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-ad-format="fluid"
                         data-ad-client="ca-pub-4090153222985235"
                         data-ad-slot="2170357567"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
          @endif

          <?php 
            $n++;
          ?>
        @endforeach
    </div>
</section>

<?php $position = 1; ?>
@section('jsheader')
@if($url_ultimos)
  <script type="application/ld+json">
  {
    "@context":"https://schema.org",
    "@type":"ItemList",
    "itemListElement":[
      @foreach($url_ultimos as $geturl)

        {
          "@type":"ListItem",
          "position":{{$position}},
          "url":"{{$geturl}}"
        },
        <?php $position ++; ?>
      @endforeach
      {
        "@type":"ListItem",
        "position":11,
        "url":"https://www.saldeello.com/"
      }

    ]
  }
  </script>
@endif
@append
@endsection