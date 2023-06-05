<div class="filter p-3 text-light">
    <button class="w-100 d-lg-none btn btn-outline-light" data-bs-toggle="collapse" data-bs-target="#filter-container">Filtrar Resultados</button>
    <div class="filter__container mt-4 collapse" id="filter-container">
        <div class="filter__header">
            <h4 class="section__lead section__lead--5 border-bottom border-light">Filtros aplicados</h4>
            <div class="border-bottom border-light pb-2">
            @foreach(Session::all() as $key => $value)
                    @if($key == 'tcondicion')
                            <a href="#"  class="filter__applied" onclick="drop_filtro('{{$key}}')">
                                {{$value}} <i class="fas fa-times"></i>
                            </a>                       
                    @endif
                    @if($key == 'tcmodelo')
                            <a href="#"  class="filter__applied" onclick="drop_filtro('{{$key}}')">
                                {{Session::get('tcmodelo_name')}} <i class="fas fa-times"></i>
                            </a>
                    @endif
                    @if($key == 'tcmarca')
                            <a href="#"  class="filter__applied" onclick="drop_filtro('{{$key}}')">
                                {{Session::get('tcmarca_name')}}   <i class="fas fa-times"></i>
                            </a>
                    @endif
                    @if($key == 'tcprice_rangue')
                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">Hasta ${{Session::get('tcprice_rangue')}} <i class="fas fa-times"></i></a>
                    @endif
            @endforeach 
            <?php if(isset($_GET['category'])) {?>
                <a href="/tienda/{{str_slug($tienda->titulo)}}/{{$tienda->id}}"" class="filter__applied">{{$_GET['name']}}<i class="fas fa-times"></i></a>
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
                                        <a href="{{$url}}?category={{$categoria["id"]}}&name={{str_slug($categoria["name"], '-')}}" class="nav-link link-light custom-link custom-link-primary">{{$categoria["name"]}}</a>
                                    @else
                                        <a href="/tienda/{{str_slug($tienda->titulo)}}/{{$tienda->id}}?category={{$categoria["id"]}}&name={{str_slug($categoria["name"],'-')}}" class="nav-link link-light custom-link custom-link-primary">{{$categoria["name"]}}</a>
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
                                    <a href="#" onclick="filtro_search('tcmarca', '{{$marca["name"]}}', {{$marca["id"]}});" class="nav-link link-light custom-link custom-link-primary">{{$marca["name"]}} </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($modelos)
                    <div class="col-12">
                        <h4 class="section__lead section__lead--6">Modelos</h4>
                        <ul class="nav flex-column regular">
                            @foreach($modelos as $modelo)
                                <li class="nav-item">
                                    <a href="#" onclick="filtro_search('tcmodelo', '{{$marca["name"]}}', {{$marca["id"]}});" class="nav-link link-light custom-link custom-link-primary">{{$modelo["name"]}} </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-12">
                    <h4 class="section__lead section__lead--6">Condición</h4>
                    <ul class="nav flex-column regular">
                        <li class="nav-item">
                            <a href="#" onclick="filtro_search('tcondicion', 'nuevo');" class="nav-link link-light custom-link custom-link-primary">
                                Nuevo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="filtro_search('tcondicion', 'usado');" class="nav-link link-light custom-link custom-link-primary">
                                Usado
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <h4 class="section__lead section__lead--6">Precio máximo</h4>
                    <h5 class="lead">ARS $<span id="price-show"></span></h5>
                    <input type="range" name="price_rangue" class="form-range" min="0" max="20000" step="100" id="price-change" value="@if(Session::get('tcprice_rangue')){{Session::get('tcprice_rangue')}}@else 100 @endif">
                </div>
            </div>
        </div>
    </div>
</div>
@section('jsfooter')
 <script>
    let priceShow = document.getElementById("price-show")
    let priceChange = document.getElementById("price-change")
    let filterContainer = document.getElementById("filter-container")

    priceShow.innerHTML = priceChange.value
    priceChange.oninput = function() {
        priceShow.innerHTML = this.value
    }

    window.onload = () => {
        if(window.innerWidth >= 992){
            filterContainer.classList.add("show")
        }
    }

    $('#price-change').change(function() {
        var xhttp = new XMLHttpRequest();
        var price = $(this).val();
        
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.location = "";
            }
        };
        xhttp.open("GET", "/filtro-category?argument=tcprice_rangue&max_price="+price, true);
        xhttp.send();
    });

    function orderatribute(o){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.location = "";
            }
        };
        xhttp.open("GET", "/filtro-category?argument=tcOrden&atribute="+o, true);
        xhttp.send();
    }

 </script>
@append