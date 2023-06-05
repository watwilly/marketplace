@extends('layouts.app')
@section('meta')
    <title>Consultas</title>
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
                        <h2 class="m-0">Consultas de productos</h2>
                    </div>
                </div>

                @if($interesados->count()>0)
                  <div class="row g-3 mt-2">
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <input type="date" @if(isset($_GET["fecha"])) value="{{$_GET["fecha"]}}" @endif id="fecha" class="form-control">
                              <label for="fecha">Fecha</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <input type="text" id="pub_name" @if(isset($_GET["name"])) value="{{$_GET["name"]}}" @endif class="form-control" placeholder="Bicicleta rodado 26">
                              <label for="input_category">Publicacion</label>
                          </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <div class="form-floating">
                              <select class="form-select" id="orden" aria-label="Floating label select example">
                                  <option value="">Seleccione</option>
                                  <option value="DESC" @if(isset($_GET["orden"])&&$_GET["orden"]=="DESC") selected @endif>Más reciente</option>
                                  <option value="ASC" @if(isset($_GET["orden"])&&$_GET["orden"]=="ASC") selected @endif>Más antigua</option>
                              </select>
                              <label for="input_order">Ordenar por</label>
                          </div>
                      </div>
                      <div class="col-12 d-flex">
                          <button onclick="filter_consultas();" class="btn btn-outline-secondary mx-auto">Filtrar consultas</button>
                      </div>
                  </div>

                <div class="row g-3 mt-2">
                    @foreach($interesados as $consulta)
                      <div class="col-12 remove{{$consulta->consultaId}}">
                          <div class="card">
                              <div class="card-body">
                                  <h6><small class="text-muted">{{$consulta->fecha}}</small></h6>
                                  <h6 class="text-truncate mb-4">
                                      Artículo: <a href="posts.show.php" class="link-success">{{$consulta->title}}</a>
                                  </h6>
                                  <h5 class="card-title">{{$consulta->mensaje}}</h5>
                                  <div class="my-3 form-floating">
                                      <textarea type="text" maxlength="255" class="form-control" id="input_answer{{$consulta->consultaId}}" placeholder="Ejemplo" style="height: 120px;"></textarea>
                                      <label for="input_answer">Respuesta</label>
                                  </div>
                                  <div class="d-flex justify-content-end">
                                      <a href="#contextar" onclick="answered({{$consulta->consultaId}})" class="section__link section__link--success">Contestar</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach
                </div>

                </div>
                @else
                  <div class="alert alert-info">No tienes consultas a tus publicaciones</div>
                @endif
            </div>
        </div>
    </div>
</section>


@endsection

@section('jsfooter')
<script>
  function answered(consultaId) {
    var answered = $("#input_answer"+consultaId).val();
    if (answered==""){
      var myElement = document.getElementById("input_answer"+consultaId);
      myElement.setAttribute('style', 'border: 1px solid #dc3545');
      return;
    }
    showload();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response["status"]=="success"){
          $(".remove"+consultaId).hide();
        }
        hideload();
      }
    };
    xhttp.open("POST", "/interesados-answered", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consultaId="+consultaId+"&_token="+"{{csrf_token()}}&answered="+answered);

  }
</script>
@append