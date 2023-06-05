@extends('layouts.app')
@section("meta")
<title>{{$nota->titulo}}</title>
@stop
@section('content')
<section class="min-height">
    <div class="p-6 bg-dark bars-primary-3 d-flex flex-wrap align-items-center">
        <h2 class="text-center text-lg-start ms-0 ms-lg-6 section__title section__title--5 text-light text-shadow">{{$nota->titulo}}</h2>
    </div>
    <div class="container my-4">
        <article class="card">
            <div class="card-body fs-5" style="text-align: justify;">
                {!! $nota->texto !!}       
                <hr>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                            <img src="/assets/img/logo.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
@endsection