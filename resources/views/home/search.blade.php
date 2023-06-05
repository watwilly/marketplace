@extends('layouts.app')
<?php 
   $url = url()->full();
?>
@section('meta')
    <meta  name=title content="{{$busqueda}}" >
    <meta  name=description content="Encuentra los mejores productos y servicios en saldeello.com">
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="Encuentra Poductos y servicios en saldeello.com. descubre la mejor forma de publicar en internet" >
    <meta  property=og:site_name content="{{$busqueda}}" >
    <meta property="og:title" content="{{$busqueda}}"/>
    <title>{{$busqueda}} la mejor forma de publicar</title>
@stop
 

@section('content')
<section class="min-height">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0">
                <div class="filter p-3 text-light">
                    <button class="w-100 d-lg-none btn btn-outline-light" data-bs-toggle="collapse" data-bs-target="#filter-container">Filtrar Resultados</button>
                    <div class="filter__container mt-4 collapse" id="filter-container">
                        <div class="filter__header">
                            <h4 class="section__lead section__lead--5 border-bottom border-light">Filtros aplicados</h4>
                            <div class="border-bottom border-light pb-2">
                                @foreach(Session::all() as $key => $value)
                                    @if($key == 'seaCondition')
                                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">{{$value}} <i class="fas fa-times"></i></a>
                                    @endif
                                    @if($key == 'seaModel')
                                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">{{Session::get('seamodelo_name')}}<i class="fas fa-times"></i></a>
                                    @endif

                                    @if($key == 'seaMarca')
                                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">{{Session::get('seamarca_name')}}<i class="fas fa-times"></i></a>
                                    @endif
                                    @if($key=='seaOrden')
                                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">{{Session::get('seaOrden')}}<i class="fas fa-times"></i></a>
                                    @endif
                                @endforeach
                                <?php if(isset($_GET['category'])) {?>
                                    <a href="/search?data={{$busqueda}}" class="filter__applied">{{$_GET['name']}}  <i class="fas fa-times"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="filter__form mt-3">
                            <div class="row gy-3">
                                <div class="col-12">
                                    <h4 class="section__lead section__lead--6">Ordenar publicaciones</h4>
                                    <ul class="nav flex-column regular">
                                        <li class="nav-item">
                                            <a href="#" onclick="orderatribute('ASC');" class="orden nav-link link-light custom-link custom-link-primary">
                                                Menor precio
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" onclick="orderatribute('DESC');" class="orden nav-link link-light custom-link custom-link-primary">
                                                Mayor precio
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#"  onclick="orderatribute('AAZ');" class="orden nav-link link-light custom-link custom-link-primary">
                                                Alfabéticamente (A - Z)
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#"  onclick="orderatribute('ZAA');" class="orden nav-link link-light custom-link custom-link-primary">
                                                Alfabéticamente (Z - A)
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                @if($categorias)
                                    <div class="col-12">
                                        <h4 class="section__lead section__lead--6">Categoría</h4>
                                        <ul class="nav flex-column regular">
                                            @foreach($categorias as $categoria)
                                                <?php 
                                                    $pos = strpos($url, "category");
                                                ?>
                                                <li class="nav-item">
                                                    @if($pos === false)
                                                        <a href="{{$url}}&category={{$categoria["id"]}}&name={{$categoria["name"]}}" class="nav-link link-light custom-link custom-link-primary">
                                                            {{$categoria["name"]}}
                                                        </a>
                                                    @else
                                                        <a href="/search?data={{$busqueda}}&category={{$categoria["id"]}}&name={{$categoria["name"]}}" class="nav-link link-light custom-link custom-link-primary">
                                                            {{$categoria["name"]}}
                                                        </a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if($marcas)
                                    <div class="col-12">
                                        <h4 class="section__lead section__lead--6">Marcas</h4>
                                        <ul class="nav flex-column regular">
                                            @foreach($marcas as $marca)
                                            <li class="nav-item">
                                                <a href="#" onclick="filtro_search('marca', '{{$marca["name"]}}', {{$marca["id"]}});" class="nav-link link-light custom-link custom-link-primary">
                                                   {{$marca["name"]}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($modelos)
                                    <div class="col-12">
                                        <h4 class="section__lead section__lead--6">Marcas</h4>
                                        <ul class="nav flex-column regular">
                                            @foreach($modelos as $modelo)
                                            <li class="nav-item">
                                                <a href="#" onclick="filtro_search('modelo', '{{$modelo["name"]}}', {{$modelo["id"]}});" class="nav-link link-light custom-link custom-link-primary">
                                                   {{$modelo["name"]}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <h4 class="section__lead section__lead--6">Condición</h4>
                                    <ul class="nav flex-column regular">
                                        <li class="nav-item">
                                            <a href="#Nuevo" onclick="filtro_search('condicion', 'nuevo');" class="nav-link link-light custom-link custom-link-primary">
                                                Nuevo
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#Usado" onclick="filtro_search('condicion', 'usado');" class="nav-link link-light custom-link custom-link-primary">
                                                Usado
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="row gy-3 gx-2 justify-content-center">
                    <div class="col-12">
                        <h2 class="text-center">Resultado de su busqueda:  {{$busqueda}}</h2>
                    </div>
                    @if($paginate->count() > 0)
                        <?php $n1=1; ?>
                        @foreach ($productos as  $post)
                            {{Voyager::h_listview($post["title"], $post["id"], $post["imagen"], $post["storage"], $post["precios"], 'small', $post["cat_name"],$post["condicion"])}}
                            
                            @if($n1==4 && $h1)
                                <div class="col-11 col-sm-12 col-md-12 col-lg-12">
                                    <a href="{{$h1->link}}" target="_blank"><img src="{{Voyager::get_image($h1->banner, null, 'storage')}}" class="img-fluid w-100"></a>
                                </div>
                            @endif
                            @if($n1==12 && $h2)
                                <div class="col-11 col-sm-12 col-md-12 col-lg-12">
                                    <a href="{{$h2->link}}" target="_blank"><img src="{{Voyager::get_image($h2->banner, null, 'storage')}}" class="img-fluid w-100"></a>
                                </div>
                            @endif

                            <?php $n1++; ?>
                        @endforeach
                    @else
                        <div class="alert alert-info col-md-12">No se encontró resultado con <b>{{$busqueda}}</b> o con el filtro seleccionado, elimine el filtro para ver otros resultados</div>
                    @endif
                   <div class="col-12">
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                            {{$paginate->links()}}
                      </ul>
                    </nav>
                   </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('jsfooter')
<script>
    let filterContainer = document.getElementById("filter-container")
    window.onload = () => {
        if(window.innerWidth >= 992){
            filterContainer.classList.add("show")
        }
    }


    function orderatribute(o) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.location = "";
            }
        };
        xhttp.open("GET", "/filtro-category?argument=orden&atribute="+o, true);
        xhttp.send();
    }

</script>
@append