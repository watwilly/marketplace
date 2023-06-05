@extends('layouts.app')
@section('meta')
    <title>Tienda</title>
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
                        <h2 class="m-0">Mis Tiendas</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="/tiendas/nuevo" class="section__link section__link--success">Nueva tienda</a>
                    </div>
                </div>
                <div id="alertset"></div>
                <form action="" method="get">
                  <div class="row g-3 mt-2">
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <input type="text" list="addresses" name="titulo" class="form-control" id="input_email" placeholder="Ejemplo">
                              <datalist id="addresses">
                                  <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                                  <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                                  <option value="Lorem ipsum dolor sit amet consectetur adipisicing.">
                              </datalist>
                              <label for="input_email">Nombre</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <select name="category_id" class="form-select" id="input_addressType" aria-label="Floating label select example">
                                @if(count($categorias)>0)
                                  <option value="">Seleccione</option>
                                  @foreach($categorias as $categoria)
                                    <option value="{{$categoria["id"]}}">{{$categoria["name"]}}</option>
                                  @endforeach
                                @endif
                              </select>
                              <label for="input_addressType">Categoría</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <select class="form-select" name="orden" id="input_addressType" aria-label="Floating label select example">
                                  <option value="ASC">Alfabéticamente (A - Z)</option>
                                  <option value="DESC">Alfabéticamente (Z - A)</option>
                              </select>
                              <label for="input_addressType">Ordenar por</label>
                          </div>
                      </div>
                      <div class="col-12 d-flex">
                          <button class="btn btn-outline-secondary mx-auto">Filtrar publicaciones</button>
                      </div>
                  </div>
                </form>

                <div class="row gy-3 gx-2 mt-4">
                  @foreach($tiendas  as $tienda)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card card-hover mx-2">
                                <div class="card-body">
                                    <div class="dropdown position-absolute top-0 end-0" style="z-index: 1000;">
                                        <button class="btn btn-sm px-3 py-2 lh-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-sm fa-ellipsis-v"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @if($tienda["status"] <> "rev")
                                              @if($tienda["status"]==1)
                                                  <li><a class="dropdown-item" href="#" onclick="tupdate({{$tienda["id"]}},0);"><i class="fas fa-pause-circle"></i> Suspender</a></li>
                                              @elseif($tienda["status"]==0)
                                                  <li><a class="dropdown-item" href="#" onclick="tupdate({{$tienda["id"]}},1);"><i class="fas fa-play-circle"></i> Habilitar</a></li>
                                              @endif
                                            @endif
                                            
                                            <li><a class="dropdown-item" href="/tienda-edit/{{$tienda["id"]}}/{{str_slug($tienda["titulo"])}}"><i class="fas fa-edit"></i> Editar</a></li>
                                            <li><a class="dropdown-item" href="/deletestore/{{$tienda["id"]}}/trash"><i class="fas fa-trash"></i> Eliminar</a></li>
                                        </ul>
                                    </div>
                                    <div class="row gx-2 align-content-center">
                                        <div class="col-4">
                                            <img src="{{Voyager::get_image($tienda["logo"], 'cropped', 'storage')}}" class="img-fluid" alt="...">
                                        </div>
                                        <div  class="col-8 d-flex flex-column justify-content-evenly align-content-start">
                                            <h5 class="m-0 h6">{{str_limit($tienda["titulo"],38)}}</h5>
                                            <div id="status{{$tienda["id"]}}">
                                              @if($tienda["status"]==1)
                                                  <span class="badge bg-success h5">Activa</span>
                                              @elseif($tienda["status"]=="0")
                                                  <span class="badge bg-secondary h5">Suspendida</span>
                                              @elseif($tienda["status"]=="rev")
                                                  <span class="badge bg-danger h5">En revision</span>
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  @endforeach
                    <!--<div class="col-12">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-primary">Cargando más tiendas...</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('jsfooter')
<script>
  function tupdate(id,status) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        toastr(response["status"],response["msg"]);

        if (status==1){
          $("#status"+id).html('<span class="badge bg-success h5">Activa</span>');
        }else{
          $("#status"+id).html('<span class="badge bg-secondary h5">Suspendida</span>');

        }
      }
    };
    xhttp.open("POST", "/tienda-status/"+id+"/"+status+"", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("_token="+"{{ csrf_token() }}");
  }
</script>
@append