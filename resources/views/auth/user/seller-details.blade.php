@extends('layouts.app')
@section('meta')
    <title>Detalle de Venta</title>
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
                        <h2 class="m-0">Título de publicación</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="/mis-ventas"  class="section__link section__link--secondary">Volver</a>
                    </div>
                </div>

                <div class="row gy-3 gx-2 mt-4 justify-content-center">
                    @if($item)
                        <div class="col-10 col-sm-6 col-md-4 col-lg-3">
                            <div class="card card-hover mx-2">
                                <img src="{{$item->fotos}}" class="card-img-top" alt="...">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title m-0 text-truncate h6">{{str_limit($item->titulo,38)}}</h5>
                                    <?php /*
                                    <small class="text-success section__title fw-bold"><?php echo $disccount ?>% OFF</small>
                                    <p class="card-text m-0 section__title fw-bold">
                                        ARS $<?php echo $final ?>
                                        <small class="text-decoration-line-through text-muted">$<?php echo $price ?></small>
                                    </p>
                                    */ ?>
                                    <p class="card-text m-0 section__title fw-bold">
                                        ARS ${{$item->precio}}
                                    </p>
                                </div>
                                <!-- Link del producto -->
                                <a href="posts.show.php" class="stretched-link"></a>
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-sm-6 col-md-8 col-lg-9">
                        <div class="card card-hover mx-2">
                            <div class="card-body">
                                <h5 class="card-title">Detalles de compra</h5>
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <b>Cantidad</b>
                                        <span>{{$item->cantidad}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <b>Precio</b>
                                        <span>ARS ${{$item->precio}}</span>
                                    </li>
                                    <?php /*<li class="list-group-item list-group-item-success d-flex justify-content-between">
                                        <b>Descuento</b>
                                        <span>ARS -$<?php echo $price * ($disccount / 100) ?></span>
                                    </li> */ ?>
                                    <?php /* <li class="list-group-item d-flex justify-content-between">
                                        <b>Envío</b>
                                        <span>ARS $500</span>
                                    </li> */ ?>
                                    <li class="list-group-item list-group-item-info d-flex justify-content-between">
                                        <?php 
                                            $total = $item->cantidad * $item->precio;
                                        ?>
                                        <b>Total</b>
                                        <span>ARS ${{$total}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <b>Fecha</b>
                                        <span>{{$payment->created_at->todateString()}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card card-hover mx-2 mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Detalles del pago</h5>
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Estado</b>
                                        <span class="status-{{$payment->status}}">{{$payment->status}}</span>
                                    </li>
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Detalle de estado</b>
                                        <span>{{$payment->status_detail}}</span>
                                    </li>
                                    @if($payment->orden_id)
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Id de Mercado Pago</b>
                                        <span>{{$payment->orden_id}}</span>
                                    </li>
                                    @endif
                                    @if($payment->cuotas)
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Cuotas</b>
                                        <span>{{$payment->cuotas}}</span>
                                    </li>
                                    @endif
                                    @if($payment->payment_method)
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Metodo de Pago</b>
                                        <span>{{$payment->payment_method}}</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @if($try->count()>0)
                            <div class="card card-hover mx-2 mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">Intentos de pago</h5>
                                    <ul class="list-group list-group-flush ">
                                        @foreach($try as $trys)
                                            <li class=" d-flex flex-column flex-md-row justify-content-between">
                                                <b>Id</b>
                                                <span>{{$trys->paidId}}</span>
                                            </li>
                                            <li class=" d-flex flex-column flex-md-row justify-content-between">
                                                <b>Monto de la transaccion</b>
                                                <span>{{$trys->transaction_amount}}</span>
                                            </li>
                                            <li class=" d-flex flex-column flex-md-row justify-content-between">
                                                <b>Total pagado</b>
                                                <span>{{$trys->total_paid_amount}}</span>
                                            </li>
                                            <li class=" d-flex flex-column flex-md-row justify-content-between">
                                                <b>Estado</b>
                                                <span class="status-{{$trys->status}}">{{$trys->status}}</span>
                                            </li>
                                            <li class=" d-flex flex-column flex-md-row justify-content-between">
                                                <b>Detalle de estado</b>
                                                <span>{{$trys->status_detail}}</span>
                                            </li>
                                            <hr>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>  
                        @endif
                        <div class="card card-hover mx-2 mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Detalles del comprador</h5>
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Nombre y Apellido</b>
                                        <span>{{$buyer->name}} {{$buyer->apellido}}</span>
                                    </li>
                                    @if($buyer->cuit)
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>DNI</b>
                                        <span>{{$buyer->cuit}}</span>
                                    </li>
                                    @endif
                                    @if($buyer->telefono)
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Teléfono</b>
                                        <span>{{$buyer->telefono}}</span>
                                    </li>
                                    @endif
                                    @if($buyer->direccion)
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Domicilio</b>
                                        <span>{{$buyer->direccion}}</span>
                                    </li>
                                    @endif
                                    @if($buyer->provincia)
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Provincia</b>
                                        <span>{{$buyer->provincia}}</span>
                                    </li>
                                    @endif
                                    @if($buyer->localidad)
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Localidad</b>
                                        <span>{{$buyer->localidad}}</span>
                                    </li>
                                    @endif
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                        <b>Localidad</b>
                                        <span>{{$buyer->email}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection