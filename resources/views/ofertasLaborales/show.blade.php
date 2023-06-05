@extends('layouts.app')

@section('meta')
    <meta  name="title" content="{{$oferta->titulo}}" >
    <meta  name="description" content="{{str_limit($oferta->descripcion, 110)}}">
    <meta  name=keywords content="{{$oferta->titulo}}">
    <meta  property=og:description content="{{$oferta->descripcion}}" >
    <meta  property=og:site_name content="{{$oferta->titulo}}" >
    <title>{{$oferta->titulo}} </title>
@stop

@section('content')
<section class="min-height">
    <div class="container">
        <div class="col-12 mt-3 d-none d-md-block">
            <nav aria-label="breadcrumb" class="bg-secondary rounded-pill py-3 px-5">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item section__title fw-bold"><a href="/republica-dominicana/empleos">Ver todos los empleos</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-4090153222985235"
                 data-ad-slot="9339845963"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div class="product my-3">
            @if($oferta->imagen)
              <div class="product__view">
                  <div class="container-fluid shadow rounded bg-white">
                      <div class="slider slider--main slider-show">
                          <img src="{{Voyager::get_image($oferta->imagen, 'cropped', null)}}" alt="{{$oferta->titulo}}" class="slider__frame slider__frame--slide">
                      </div>
                  </div>
              </div>
            @endif
            <div class="product__price">
                <div class="container-fluid py-3 h-100 shadow rounded bg-white">

                    <hr class="my-4">
                    <h4 class="mb-4">{{$oferta->titulo}}</h4>
                    <h5 class="mb-4 section__title fw-bold">
                       Vacantes: {{$oferta->vacantes}}
                    </h5>
                    <hr class="my-4">

                    <h6>Más información:</h6>
                    <div class="d-block rounded-pill bg-light border border-gray h6 fw-bold px-3 py-2">
                        Puesto: {{$oferta->puesto}}
                    </div>
                    <div class="d-block rounded-pill bg-light border border-gray h6 fw-bold px-3 py-2">
                        Direccion: {{$oferta->direccion}}
                    </div>
                    <div class="d-block rounded-pill bg-light border border-gray h6 fw-bold px-3 py-2">
                        E-mail: {{$oferta->email}}
                    </div>
                    <hr class="my-4">
                      <div class="d-grid gap-2">
                            @if(Auth::check())
                                <?php 
                                    $user = Auth::user();
                                    $postulado = $oferta->postulanteId()->where('user_id', $user->id)->first();
                                ?>
                                @if(is_null($postulado))
                                <a href="#postularme" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success">Postularse</a>
                                @else
                                    <a href="#postulado" class="btn btn-warning">Ya estas postulado</a>
                                @endif
                            @else
                                <a href="/auth/user/login" class="btn btn-success">Postularse</a>
                            @endif
                      </div>
                      <div class="d-grid gap-2">
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-8375200710331851"
                                 data-ad-slot="1524161662"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                 (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                      </div>
                </div>
            </div>
            <div class="product__description">
                <div class="container-fluid py-3 shadow rounded bg-white">
                  <h5 class="border-bottom border-gray mb-3">Descripción</h5>
                    @php
                      $body = str_replace("\n", "<p>", $oferta->descripcion);
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
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="modal-report-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h5 class="modal-title" id="modal-report-label">Postularse a {{$oferta->titulo}}</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿ Seguro que deseas postularte a este empleo?</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="/postularme/{{$oferta->id}}/{{str_slug($oferta->titulo,'-')}}" class="btn btn-danger text-light">Enviar</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsheader')

@append

@section('jsfooter')

@append

