<div class="filter p-3 text-light">
    <button class="w-100 d-lg-none btn btn-outline-light" data-bs-toggle="collapse" data-bs-target="#filter-container">Filtrar Resultados</button>
    <div class="filter__container mt-4 collapse" id="filter-container">
        <div class="filter__header">
            <h4 class="section__lead section__lead--5 border-bottom border-light">Filtros aplicados</h4>
            <div class="border-bottom border-light pb-2">
                @foreach(Session::all() as $key => $value)
                    @if($key == 'catCondicion')
                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">{{$value}} <i class="fas fa-times"></i></a>
                    @endif
                    @if($key == 'catModelo')
                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">{{Session::get('catModelo_name')}}<i class="fas fa-times"></i></a>
                    @endif

                    @if($key == 'catMarca')
                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">{{Session::get('catMarca_name')}}<i class="fas fa-times"></i></a>
                    @endif
                    @if($key == 'catPriceRangue')
                        <a href="#" onclick="drop_filtro('{{$key}}');" class="filter__applied">Hasta ${{Session::get('catPriceRangue')}} <i class="fas fa-times"></i></a>
                    @endif
                @endforeach
                <?php if(isset($_GET['category'])) {?>
                    <a href="/categoria/{{$category->id}}/{{str_slug($category->name, '-')}}" class="filter__applied">{{$_GET['name']}}  <i class="fas fa-times"></i></a>
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
                                        <a href="{{$url}}?category={{$categoria["id"]}}&name={{str_slug($categoria["name"], '-')}}" class="nav-link link-light custom-link custom-link-primary">
                                            {{$categoria["name"]}}
                                        </a>
                                    @else
                                        <a href="/categoria/{{$category->id}}/{{str_slug($category->name, '-')}}?category={{$categoria["id"]}}&name={{$categoria["name"]}}" class="nav-link link-light custom-link custom-link-primary">
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
                                <a href="#" onclick="filtro_search('catMarca', '{{$marca["name"]}}', {{$marca["id"]}});" class="nav-link link-light custom-link custom-link-primary">
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
                                <a href="#" onclick="filtro_search('catModelo', '{{$modelo["name"]}}', {{$modelo["id"]}});" class="nav-link link-light custom-link custom-link-primary">
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
                            <a href="#Nuevo" onclick="filtro_search('catCondicion', 'nuevo');" class="nav-link link-light custom-link custom-link-primary">
                                Nuevo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#Usado" onclick="filtro_search('catCondicion', 'usado');" class="nav-link link-light custom-link custom-link-primary">
                                Usado
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <h4 class="section__lead section__lead--6">Precio máximo</h4>
                    <h5 class="lead">RD $<span id="price-show"></span></h5>
                    <input type="range" name="price_rangue" class="form-range" min="0" max="20000" step="100" id="price-change" value="@if(Session::get('catPriceRangue')){{Session::get('catPriceRangue')}}@else 100 @endif">
                </div>
            </div>
        </div>
    </div>
</div>