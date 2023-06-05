@extends('layouts.app')
@section('meta')
    <title>Conectar con Mercado Libre</title>
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
                        <h2 class="m-0">Importar desde MercadoLibre</h2>
                    </div>
                    @if(is_null($get_relations))
                      <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                          <a href="/ml/auth" class="section__link section__link--success">Asociar a Mercadolibre</a>
                      </div>
                   @elseif($code == 401)
                      <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                          <a href="/ml/auth" class="section__link section__link--success">Renovar credenciales</a>
                      </div>
                   @endif
                </div>

                  <h6 class="lead text-center text-lg-start mt-4">Desde aquí podés importar tus publicaciones realizadas en MercadoLibre. Para ello tenés que asociar tu cuenta de ventastucumán.com con mercadolibre.com.ar</h6>
                  @if($code == 200)
                    @if(count($item)>0)
                      <form action="/ml/import_items" method="post" >
                          <input type="hidden" id="scroll_id" class="form-control" name="scroll_id" value="{{$scroll_id}}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="mt-4 px-2">
                          <div id="scroll">

                            @foreach($item as $items)
                              <?php 
                                $post = new \App\Models\Post(); 
                                $verifyInsert = $post->select('id','ml_id')->where('user_id', Auth::user()->id)->where('ml_id',$items['body']->id)->where('status', 'PUBLISHED')->take(1)->first();
                                $price = $items["body"]->price;
                              
                                $array = [
                                  "title"=>$items["body"]->title,
                                  "id"=>$items["body"]->id,
                                  "category_id"=>$items["body"]->category_id,
                                  "price"=>$price,
                                  "initial_quantity"=>$items["body"]->initial_quantity,
                                  "condition"=>$items["body"]->condition,
                                  "pictures"=>$items["body"]->pictures
                                ];
                                $json = json_encode($array);
                              ?>
                              <div class="grid equal-cells p-3 mb-3 rows-2 rows-lg-1 align-items-center card card-hover">
                                  <div class="grid-item c-3 c-sm-2 c-lg-1">
                                      <img src="{{$items['body']->secure_thumbnail}}" class="img-fluid rounded-circle" alt="...">
                                  </div>
                                  <div class="grid-item c-9 c-sm-10 c-lg-8">
                                      <h5 class="text-truncate">{{$items['body']->title}}</h5>
                                      <h6 class="m-0">ARS ${{$price}}</h6>
                                  </div>
                                  <div class="grid-item c-3 c-sm-2 c-lg-1 p-lg-1-1 justify-self-center">
                                      <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input m-0" name="items[]" value="{{$json}}" type="checkbox" @if(!is_null($verifyInsert)) disabled="true" @endif id="flexSwitchCheckDefault">
                                      </div>
                                  </div>
                                  <div class="grid-item c-9 c-sm-10 c-lg-2">
                                    @if(!is_null($verifyInsert))
                                      <div class="rounded text-center p-2 bg-gray m-0 h6">Ya fué importado</div>
                                    @else
                                      <div class="rounded text-center p-2 bg-primary m-0 h6">Listo para importar</div>
                                    @endif
                                  </div>
                              </div>
                            @endforeach
                               </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <a href="#loadmore" onclick="loadmore();" class="btn btn-outline-secondary">Cargar más productos</a>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info my-3"><b>AVISO:</b> Una vez que los productos o servicios hayan sido importados se actualizarán automáticamente cuando hagas una modificación en MercadoLibre</div>

                            <div class="d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-success">Importar productos seleccionados</button>
                            </div>
                      </form>
                    @else
                      <div class="alert alert-warning">
                        No encontramos tus publicacions en Mercado Libre asegurate de que esten disponible.
                      </div>
                    @endif
                  @endif
            </div>
        </div>
    </div>
</section>

@section('jsfooter')
<script>
  function loadmore(){
    var scroll_id = $("#scroll_id").val();
    showload();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = this.responseText;
        $("#scroll").append(response);
     
        hideload();
      }
    };

    xhttp.open("GET", "/ml/morepublication/"+scroll_id, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();

  }

  $('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > 60) {
        $(this).prop('checked', false);
        toastr.info("El máximo para subir son 60", "Excediste el máximo permitido por carga");
        
    }
  });
</script>
@append

@endsection