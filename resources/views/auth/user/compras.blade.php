@extends('layouts.app')
@section('meta')
    <title>Compras</title>
@stop
@section('content')
<section class="min-height">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0 d-none d-lg-block">
              @include('auth.colder')
            </div>
            <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="grid rows-2 rows-lg-1 cols-1 cols-lg-2 justify-content-stretch align-items-center">
                    <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                        <h2 class="m-0">Mis Compras</h2>
                    </div>
                </div>

                <form accept="" method="get">
                    <div class="row g-3 mt-2">
                        <div class="col-12 col-md-3">
                            <div class="form-floating">
                                <input type="text" list="addresses" @if(isset($_GET["publicacion"])) value="{{$_GET["publicacion"]}}" @endif class="form-control" id="publicacion" name="publicacion" placeholder="Ejemplo">
                                <datalist id="addresses">
                                    <option value="Ingrese el nombre de una publicacion">
                                </datalist>
                                <label for="input_email">Publicación</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-floating">
                                <input type="date" id="input_dateStart" @if(isset($_GET["desde"])) value="{{$_GET["desde"]}}" @endif name="desde" class="form-control">
                                <label for="input_dateStart">Desde</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-floating">
                                <input type="date" id="input_dateEnd" @if(isset($_GET["hasta"])) value="{{$_GET["hasta"]}}" @endif name="hasta" class="form-control">
                                <label for="input_dateEnd">Hasta</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-floating">
                                <select class="form-select" id="orden" name="orden" aria-label="Floating label select example">
                                    <option value="">Seleccione</option>
                                    <option value="ASC" @if(isset($_GET["orden"])&&$_GET["orden"]=="ASC") selected @endif >Más antigua</option>
                                    <option value="DESC" @if(isset($_GET["orden"])&&$_GET["orden"]=="DESC") selected @endif>Más reciente</option>
                                </select>
                                <label for="input_addressType">Ordenar por</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <button type="submit" class="btn btn-outline-secondary mx-auto">Filtrar ventas</button>
                        </div>
                    </div>
                </form>

                <div class="mt-4 px-2">
                  @if($query->count()>0)
                    @foreach($query as $compras)
                      <div class="grid p-3 mb-3 rows-4 cols-2 rows-md-2 cols-md-4 rows-lg-1 cols-lg-6 align-items-center card card-hover">
                          <div class="grid-item c-2 c-md-4 c-lg-2">
                              <a href="posts.show.php" class="custom-link link-secondary">
                                <h5 class="m-0 text-truncate">{{$compras->titulo}}</h5>
                              </a>
                          </div>
                          <div class="grid-item">
                              <h6 class="m-0 text-muted">{{$compras->seller_name}}</h6>
                          </div>
                          <div class="grid-item justify-self-end justify-self-lg-end">
                              <h6 class="m-0 status-{{$compras->status}} ">{{$compras->status}}</h6>
                          </div>
                          <div class="grid-item c-2 c-md-1 justify-self-center justify-self-lg-end">
                              <h6 class="m-0">ARS ${{$compras->total_paid_amount}}</h6>
                          </div>
                          <div class="grid-item c-2 c-md-1 justify-self-center justify-self-md-end">
                              <a href="/detail/{{$compras->id}}/{{$compras->ref_id}}" class="section__link section__link--success">Detalles</a>
                          </div>
                      </div>
                    @endforeach
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                          {{$query->render()}}
                          <!--  <a href="#" class="btn btn-primary">Cargando más compras...</a>-->
                        </div>
                    </div>
                  @else
                    <div class="alert alert-info">No se han encontrado compras.</div>
                  @endif
                </div>
            </div>
        </div>
    </div>
</section>
 

@endsection