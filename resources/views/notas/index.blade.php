@extends('layouts.app')
@section("meta")
<title>{{$category->name}}</title>
@stop
@section('content')
<section class="mb-5"  >
    <div class="p-6 bg-dark bars-primary-3 d-flex flex-wrap align-items-center">
        <h2 class="text-center text-lg-start ms-0 ms-lg-6 section__title section__title--5 text-light text-shadow">{{$category->name}}</h2>
    </div>
</section>
<section class="container">
    <div class="row mb-5">
    @foreach($notas as $nota)
        <div class="col-md-3">
           <a href="/nota/{{$nota->id}}/{{str_slug($nota->titulo,'-')}}">
            <img src="/storage/{{$nota->imagen}}" class="img-fluid mb-3">
            <h6>{{$nota->titulo}}</h6>
            </a>
        </div>
    @endforeach
    </div>
</section>
@endsection