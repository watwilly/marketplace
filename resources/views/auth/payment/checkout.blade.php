@extends('layouts.app')

@section('meta')
    <title>CheckOut</title>
@stop

@section('content')
 
<section class="min-height">
    <div class="container mt-4">
        <h2 class="text-center mb-5">Confirmar Compra</h2>
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-7">
                <div class="container-fluid py-3 h-100 shadow rounded bg-white">
                    <h4 class="section__lead">Información de envío</h4>
                    <div class="row g-3">
                        <div class="alert alert-info">
                            El envio y la entrega coordinelo directamente con el vendedor, al finalizar la compra.
                        </div>
                       <?php /*<div class="col-12 col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="input_addressType" aria-label="Floating label select example">
                                    <option value="1" selected>Tucumán</option>
                                    <option value="2">Buenos Aires</option>
                                </select>
                                <label for="input_addressType">Provincia</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="input_addressType" aria-label="Floating label select example">
                                    <option value="1" selected>San Miguel de Tucumán</option>
                                    <option value="2">Yerba Buena</option>
                                </select>
                                <label for="input_addressType">Localidad</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4"></div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating">
                                <input type="text" list="addresses" class="form-control" id="input_email" placeholder="Ejemplo">
                                <datalist id="addresses">
                                    <option value="Lorem ipsum dolor sit amet. 351">
                                    <option value="Lorem, ipsum. 456">
                                    <option value="Lorem ipsum dolor sit. A 5">
                                </datalist>
                                <label for="input_email">Domicilio</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="input_addressType" aria-label="Floating label select example">
                                    <option value="1" selected>Casa</option>
                                    <option value="2">Trabajo</option>
                                </select>
                                <label for="input_addressType">Tipo</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="input_tel" placeholder="Ejemplo">
                                <label for="input_tel">Teléfono</label>
                            </div>
                        </div>  */ ?>
                    </div>



                    <h4 class="section__lead mt-5">Datos de Facturación</h4>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item d-flex justify-content-between">
                            <b>Nombre y Apellido</b>
                            <span>{{$user->name}} {{$user->apellido}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <b>DNI/CUIT</b>
                            <span>{{$user->cuit}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <a href="/cuenta" class="ms-auto section__link section__link--success">Editar Datos</a>
                        </li>
                    </ul>


                </div>
            </div>
            <?php 
                $subtotal = $items->precios * $items->cantidad;
            ?>
            <div class="col-12 col-lg-5">
                <div class="container-fluid py-3 h-100 shadow rounded bg-white">
                    <h4 class="section__lead">Total a pagar</h4>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item d-flex justify-content-between">
                            <b>{{$items->title}}(x{{$items->cantidad}})</b>
                            <span>ARS ${{$subtotal}}</span>
                        </li>
                    </ul>
                    @if(is_null($user->email))
                        <div class="alert-warning alert text-center">Agrega tu correo electronico para poder comprar, <a href="/cuenta" class="btn btn-success">Agregar Correo</a> </div>
                    @else
                        <a href="#payment" onclick="payment({{$items->id}});" class="btn btn-success w-100 mt-6">Pagar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('jsfooter')
<script>
    function payment(i) {
     showload();
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        toastr(response["status"],response["msg"]);
        
        if (response["status"]=="success"){
            window.location.href =response["uri"];
        }
        hideload();
      }
    };
    xhttp.open("POST", "/payment/"+i, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("_token="+"{{ csrf_token() }}");       

    }
</script>
@append

