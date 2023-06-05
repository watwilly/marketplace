@extends('layouts.app')
@section('content')
@section('meta')
    <meta  name="title" content="Trabajos disponible en República Dominicana" >
    <meta  name="description" content="Busca trabajo en Santo Domingo, publica empleos y vacantes en Republica Dominicana consigue trabajo por internet ">
    <meta  name=keywords content="job hunting, secretaria de trabajo, trabajos disponibles, trabajador dominicano, trabajo online, ministerio del trabajo, trabajo dominicano" >
    <meta  property=og:image content="https://www.saldeello.com/storage/{{Voyager::setting('site.ogimage')}}" >
    <meta  property=og:title content="Trabajos disponible en República Dominicana" >
    <meta  property=og:description content="Busca trabajo en Santo Domingo, publica empleos y vacantes en Republica Dominicana consigue trabajo por internet" >
    <meta  property=og:site_name content="Trabajos disponible en Santo Domingo - Busca empleos en RD<" >
    <title>Empleos</title>
@stop


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center p-5 top-leyends">
            <h1>Trabajos online <b> consigue trabajos por Internet</b>  en Republica Dominicana</h1>
        </div>
        
        <div class="col-md-8 col-xs-12 col-sm-12" style="margin: auto;">
            @if($ofertas->count() > 0)
                <?php $n = 0; ?>
                @foreach($ofertas as  $post)

                    <div class="col-12 col-sm-6 col-md-12 col-lg-12 mb-3" >
                        <div class="card card-hover mx-2">
                            <div class=" col-md-12 col-sm-10 col-xs-12">
                                <div class=" col-xs-12 p-3 col-md-12">
                                      <h2>{{$post->titulo}}</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <ul>
                                            @if($post->vacantes)<li><b>Vacantes:</b> {{$post->vacantes}}</li>@endif
                                            @if($post->puesto)<li><b>Puesto:</b> {{$post->puesto}}</li>@endif
                                            @if($post->direccion)<li><b>Direccion Laboral: </b>{{$post->direccion}}</li>@endif
                                        </ul>
                                    </div>
                                    <div class=" col-md-6 col-xs-12">
                                        <a href="/empleo/{{str_slug($post->puesto, '-')}}/{{str_slug($post->titulo)}}/{{$post->id}}" class="btn btn-info">Ver Empleo</a>
                                        @if(Auth::check())
                                            <?php 
                                                $user = Auth::user();
                                                $postulado = $post->postulanteId()->where('user_id', $user->id)->first();
                                            ?>
                                            @if(is_null($postulado))
                                                <a href="/postularme/{{$post->id}}/{{str_slug($post->titulo,'-')}}" class="btn btn-success">Postularme</a>
                                            @else
                                                <a href="#postulado" class="btn btn-warning">Ya estas postulado</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($n==2)
                        <div class="col-md-12 ofertas col-sm-12 col-xs-12" style="margin-bottom:1.5rem!important;">
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-4090153222985235"
                                 data-ad-slot="5473921090"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                 (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    @endif
                    @if($n==5)
                    <div class="col-md-12 ofertas col-sm-12 col-xs-12" style="margin-bottom:1.5rem!important;">
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8375200710331851"
                             data-ad-slot="7882083273"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    @endif
                    @if($n==8)
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8375200710331851"
                             data-ad-slot="6726201664"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    @endif
                    <?php $n++; ?>
                @endforeach            
                <div class="text-center">
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                        {{$ofertas->links()}}
                      </ul>
                    </nav>
                </div>
            @else
                <div class="alert alert-info col-md-12">No se han creado ofertas laborales</div>
            @endif
        </div>
    </div>
</div>
@section('jsfooter')
 
@append
@endsection

