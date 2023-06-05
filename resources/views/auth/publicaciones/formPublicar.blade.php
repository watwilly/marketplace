@extends('layouts.app')
@section('meta')
    <title>Creando Publicacion</title>
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
                        <h2 class="m-0">Editar/Nueva Publicación</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="/ventas"  class="section__link section__link--secondary">Volver</a>
                    </div>
                </div>

                <div class="row g-3 mt-6">


                    @if($cant_pub > 0 && is_null($user->provincia_id))
                      <div class="alert alert-info">
                        Estimado usuario para poder seguir publicando Seleccione su provincia y localidad haciendo click <a href="/cuenta">Aquí.</a>
                      </div>
                    @elseif($cant_pub >= 2 && is_null($user->telefono))
                      <div class="alert alert-info">
                        Estimado usuario para poder seguir publicando es necesario ingresar su <b>Teléfono</b> ya que por este medio se pondrán en contacto con usted. <a href="/cuenta">Aquí</a>
                      </div>
                    @elseif(is_null($user->email))
                      <div class="alert-info alert text-center">
                        Para poder publicar tus productos y servicios es necesario que agregue tu e-mail <a href="/cuenta" class="btn btn-success">Agregar e-mail</a>
                      </div>
                    @else
                      <div class="col-12 mt-6">
                          <h4 class="lead text-center text-lg-start">¿Qué deseas vender?</h4>
                      </div>

                      <!--Begin Form-->
                      <form method="POST" action="/store_ventas" accept-charset="UTF-8" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                              <select class="form-select" id="category_id" required name="category_id" aria-label="Floating label select example">
                                <option  value="">Seleccione</option>
                              @foreach($listCategorias as $category)
                                  <option  value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                              </select>
                              <label for="input_category">Categoría</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="subcategoryId" required id="dom_subcategoryId" aria-label="Floating label select example">
                                    <option value="" hidden>Seleccione</option>
                                </select>
                                <label for="input_subcategory">Sub-Categoría</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <div class="form-floating">
                              <select name="marca_id" class="form-select" id="marca_id">
                                <option value="" hidden>Seleccione una Marca</option>
                              </select>
                            <label >Marca</label>
                          </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <div class="form-floating">
                            <select name="modelo_id" class="form-select" id="modelo_id" >
                              <option value="">Seleccione un Modelo</option>
                            </select>
                            <label >Modelo</label>
                          </div>
                        </div>

                        <div class="col-12">
                            <h4 class="lead mt-6 text-center text-lg-start">Detalla tu publicación</h4>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="form-floating">
                                <select class="form-select" name="condicion" id="input_condition" aria-label="Floating label select example">
                                  <option value="NUEVO">Nuevo</option>
                                  <option value="USADO">Usado</option>
                                  <option value="like-new">Usado Como nuevo</option>
                                </select>
                                <label for="input_condition">Condición</label>
                            </div>
                            @error('condicion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="form-floating">
                                <input type="number" name="precio" value="{{ old('precio') }}" class="form-control" id="input_price" placeholder="Ejemplo">
                                <label for="input_price">Precio</label>
                            </div>
                            <input type="checkbox" name="withoutprice" class="form-copntrol"> Marque aquí para publicar sin precio
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 ocultar">
                            <div class="form-floating">
                                <input type="number" name="cantidad" value="{{ old('cantidad') }}" class="form-control" id="input_stock" placeholder="Ejemplo">
                                <label for="input_stock">Cantidad</label>
                            </div>
                            @error('cantidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>

                        @if($tiendas->count()>0)
                          <div class="col-12 col-md-6 col-lg-3">
                              <div class="form-floating">
                                  <select required class="form-select" name="tienda_id" id="tienda_id" aria-label="Floating label select example">
                                    <option value="">Seleccione</option>
                                    @foreach($tiendas as $tienda)
                                      <option value="{{$tienda->id}}">{{$tienda->titulo}}</option>
                                    @endforeach
                                  </select>
                                  <label for="input_condition">Tienda</label>
                              </div>
                              @error('tienda_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        @endif
      
                        <div id="tipovehiculos" class="row"></div>
                        <div id="getAtributos" class="row"></div>

                        <div class="col-12">
                            <div class="form-floating mt-6">
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" id="input_title" placeholder="Ejemplo">
                                <label for="input_title">Título de la publicación </label>
                                <small class="ms-3 text-muted section__lead">(Max. 70 caracteres)</small>
                            </div>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea type="text" name="descripcion" class="form-control" id="input_details" placeholder="Ejemplo" style="height: 200px;">{{ old('descripcion') }}</textarea>
                                <label for="input_details">Descripción de la publicación</label>
                            </div>
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <div class="grid mt-6 rows-2 rows-lg-1 cols-1 cols-lg-2 justify-content-stretch align-items-center">
                                <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                                    <h4 class="lead">Fotos e imágenes</h4>
                                </div>
                                <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                                    <input type="file" name="image[]" id="input_images" multiple class="d-none">
                                    <label for="input_images" class="section__link section__link--primary">Subir fotos</label>
                                </div>
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div id="input_preview" class="grid g-2 rows-1 cols-2 cols-sm-3 cols-md-4 cols-lg-5 cols-xl-6">
                           
                            </div>
                        </div>

                        <div class="col-12 d-flex mt-6">
                            <button class="btn btn-success mx-auto">Guardar cambios</button>
                        </div>
                      </form>
                      <!--End form-->
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>

@append

@section('jsfooter')

<script>

  $(document).ready(function(){
     $("#category_id").change(function () {
        $("#category_id option:selected").each(function () {
          elegido=$(this).val();

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("dom_subcategoryId").innerHTML = this.responseText;
            }
          };
          xhttp.open("POST", "/get-subcategory", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("elegido="+elegido+"&_token="+"{{ csrf_token() }}");
          if (elegido == 6){
            $(".ocultar").remove();

            var xhttp1 = new XMLHttpRequest();
            xhttp1.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tipovehiculos").innerHTML = this.responseText;
                $("#tipovehiculos").show("slow");
              }
            };
            
            xhttp1.open("GET", "/get-tipos-vehiculos", true);
            xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp1.send("cat_id="+elegido+"&edit="+"NULL");

          }else{
            $("#tipovehiculos").hide("slow");
          }
        });
     });
  });

$(document).ready(function(){
     $("#dom_subcategoryId").change(function () {
        $("#dom_subcategoryId option:selected").each(function () {
          
          elegido=$(this).val();

          var xhttp2 = new XMLHttpRequest();
          xhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("getAtributos").innerHTML = this.responseText;
            }
          };

          xhttp2.open("POST", "/getAtributos", true);
          xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp2.send("elegido="+elegido+"&_token="+"{{csrf_token()}}");


          var xhttp3 = new XMLHttpRequest();
          xhttp3.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("marca_id").innerHTML = this.responseText;
            }
          };

          xhttp3.open("POST", "/lista_marca", true);
          xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp3.send("elegido="+elegido+"&_token="+"{{csrf_token()}}");

        });
     })
  });

  $(document).ready(function(){
     $("#marca_id").change(function () {
        $("#marca_id option:selected").each(function () {
          elegido=$(this).val();
          var xhttp4 = new XMLHttpRequest();
          xhttp4.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("modelo_id").innerHTML = this.responseText;
            }
          };
          xhttp4.open("POST", "/lista_modelos", true);
          xhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp4.send("elegido="+elegido+"&_token="+"{{csrf_token()}}");
        });
     })
  });

</script>
@append