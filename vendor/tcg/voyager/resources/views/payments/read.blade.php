@extends('voyager::master')

@section('page_title','View '.$dataType->display_name_singular)

@section('page_header')

@stop

@section('content')

    <div class="container">
        <div class="datos-carrito bg-light border my-4 p-5">
            <h5 class="text-center mb-5 pb-2">Datos de las partes</h5>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Comprador</h4>
                    <ul>
                        <li><span>Nombre:</span> {{$comprador->name}}  </li>
                        <li><span>Apellido:</span> {{$comprador->apellido}}</li>
                        <li><span>Email:</span> {{$comprador->email}}</li>
                        <li><span>Telefono:</span> {{$comprador->telefono}}</li>
                        <a href="" class="btn btn-success">Ver usuario</a>
                    </ul>

                </div>
                <div class="col-sm-6">
                    <h4>Vendedor</h4>
                    <ul>
                        <li><span>Nombre:</span> {{$vendedor->name}}</li>
                        <li><span>Fecha:</span> {{$vendedor->apellido}}</li>
                        <li><span>Email:</span> {{$vendedor->email}}</li>
                        <li><span>Telefono:</span> {{$vendedor->telefono}}</li>
                        <a href="" class="btn btn-success">Ver usuario</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="datos-carrito bg-light border my-4 p-5">
            <h5 class="text-center mb-5 pb-2">Datos del pago</h5>
            <div class="row">
                <div class="col-sm-6">
                    <ul>
                        <li><span>Referencia Externa:</span> {{$dataTypeContent->external_reference}}  </li>
                        <li><span>MP ref_id:</span> {{$dataTypeContent->ref_id}}</li>
                        <li class="status-{{$dataTypeContent->status}}"><span>MP estado:</span> {{$dataTypeContent->status}}</li>
                        <li><span>MP detalle del estado:</span> {{$dataTypeContent->status_detail}}</li>
                    </ul>

                </div>
                <div class="col-sm-6">
                    <ul>
                        <li><span>MP numero de Orden:</span> {{$dataTypeContent->orden_id}}</li>
                        <li><span>MP Cuotas:</span> {{$dataTypeContent->cuotas}}</li>
                        <li><span>MP Metodo de pago:</span> {{$dataTypeContent->payment_method}}</li>
                        <li><span>MP Tipo de pago:</span> {{$dataTypeContent->payment_thype}}</li>
                    </ul>
                </div>
            </div>
        </div>
        @if($details)
        <div class="datos-carrito bg-light border my-4 p-5">
            <h5 class="text-center mb-5 pb-2">Datos de la transaccion</h5>
            <div class="row">
                <div class="col-sm-6">
                    <ul>
                        <li><span>Tarifa de Mercado Pago:</span> {{$details->mercadopago_fee}}  </li>
                        <li><span>Tarifa de Ventas Tucuman:</span> {{$details->aplicacion_fee}}</li>
                        <li><span>Tarifa de financiacion:</span> {{$details->stafinancing_feetus}}</li>
                        <li><span>Neto recibido por el usuario:</span> {{$details->neto_recibido}}</li>
                    </ul>

                </div>
                <div class="col-sm-6">
                    <ul>
                        <li><span>Nombre en la tarjeta:</span> {{$details->card_holder}}</li>
                        <li><span>Expiracion de la tarjeta:</span> {{$details->expiration}}</li>
                        <li><span>Primeros seis digitos:</span> {{$details->first_six_digits}}</li>
                        <li><span>Ultimos cuatros digitos:</span> {{$details->last_four_digits}}</li>
                        <li class="alert alert-success"><span>Total Pagado:</span> {{$details->total_paid_amount}}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endif

        @if($intentos->count()>0)
            <div class="datos-carrito bg-light border my-4 p-5">
                <h5 class="text-center mb-5 pb-2">Intentos de pagos</h5>
                <div class="row">
                    <?php $n1=1; ?>
                    @foreach($intentos as $intento)
                        <div class="col-sm-12">
                            <div class="col-md-12 alert alert-info">
                                <p>Intento: {{$n1}}</p>
                            </div>
                            <ul>
                                <div class="col-md-6">
                                    <li><span>Id de pago:</span> {{$intento->paidId}}  </li>
                                    <li><span>Monto del pago:</span> {{$intento->transaction_amount}}</li>
                                    <li><span>Total :</span> {{$intento->total_paid_amount}}</li>
                                    <li><span>Estado:</span> {{$intento->status}}</li>
                                    <li><span>Detalle del estado:</span> {{$intento->status_detail}}</li>
                                </div>
                                <div class="col-md-6">
                                    <li><span>Tipo de operacion:</span> {{$intento->operation_type}}</li>
                                    <li><span>Fecha de aprovacion:</span> {{$intento->date_approved}}</li>
                                    <li><span>Fecha de creacion:</span> {{$intento->date_created}}</li>
                                    <li><span>Ultima modificacion:</span> {{$intento->last_modified}}</li>
                                    <li><span>Monto devuelto:</span> {{$intento->amount_refunded}}</li>
                                </div>
                            </ul>
                        </div>
                        <?php $n1++; ?>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="productos-carrito bg-light border p-5 mb-4">
            <h5 class="text-center mb-5 pb-2">Productos de la transaccion</h5>
            <div class="row encabezados-carrito text-center py-2 bg-dark text-white">
                <div class="col-md-3"><span>Producto</span></div>
                <div class="col-md-2"><span>Atributos</span></div>
                <div class="col-md-1"><span>Cantidad</span></div>
                <div class="col-md-2"><span>Precio Unitario</span></div>
                <div class="col-md-2"><span>Subtotal</span></div>
                <div class="col-md-2"><span>Condicion</span></div>
                    
            </div>

            <?php 
                $price = $item->precio;
                $img = $item->fotos;
                $topTotal =  $price * $item->cantidad;
                $talle = $item->tallesId()->first();
                $color = $item->coloresId()->first();
            ?>

            <div class="row bg-white border border-top-0 d-flex align-items-center py-2">
                <div class="col-md-3 col-12 d-flex align-items-center">
                    <div class="col-md-3 col-xs-5">
                        <img src="{{$img}}" alt="Producto" class="img-responsive py-2">
                    </div>
                    <div class="col-md-9 col-7">
                        <p class="mb-0">{{$item->titulo}}</p>
                    </div>
                </div>
                <div class="col-md-2 col-4 d-flex flex-column align-items-center">
                    <div>Talle: @if(!is_null($talle)) {{$talle->talle}} @endif</div>
                    <div class="d-flex align-items-center">
                        <span class="pr-1">Color:</span> 
                        @if(!is_null($color))
                         <span class="color" style="background-color:  {{$color->color}}; "></span>
                        @else
                            <span class="color">NN</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-1 col-4 d-flex justify-content-center cantidad">
                    {{$item->cantidad}}
                </div>
                <div class="col-md-2 col-4 d-flex justify-content-center unitario">
                    ${{$price}}
                </div>
                <div class="col-md-2 col-4 d-flex justify-content-center subtotal">
                    <div>${{$topTotal}}</div>
                </div>
                <div class="col-md-2 col-4 d-flex justify-content-center subtotal">
                    <div>{{$item->condicion}}</div>                        
                </div>
            </div>

        </div>
        <div class="d-flex flex-wrap total mt-3 border">
            <div class="col-md-10 col-xs-7 mb-0 py-2 text-right">Total</div>
            <div class="col-md-2 col-xs-5 mb-0 text-center py-2">${{$topTotal}}</div>
        </div>
    </div>

@stop

@section('css')
     <style>
.status-pending {
    color:#0dcaf0;
}
.status-approved{
    color:#198754;
}
.status-refunded{
    color:#dc3545;
}
.status-rejected{
    color:#dc3545;
}
.status-in_process{
    color:#ffc107;
}

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .datos-carrito, .productos-carrito {
            background: #fff;
            border: 1px solid #e9ecef;
        }
        .datos-carrito ul {
            list-style: none;
            padding: 0;
        }
        .datos-carrito ul li {
            padding: 5px 0;
        }
        .datos-carrito ul li span {
            font-weight: 600;
        }
        .datos-carrito h5, .productos-carrito h5 {
            border-bottom: 1px solid #ddd;
            font-weight: 600;
            font-size: 17px;
        }
        .encabezados-carrito {
            border-bottom: 1px solid #ddd;
            background: #343A40;
            color: #fff;
        }
        .border {
            border: 1px solid #e9ecef;
        }
        .fila {
            border-top: 0;
        }
        .pr-1 {
            padding-right: 5px;
        }
        .pt-2, .py-2 {
            padding-top: .5rem !important;
        }
        .pb-2, .py-2 {
            padding-bottom: .5rem !important;
        }
        .mb-5, .my-5 {
            margin-bottom: 3rem !important;
        }
        .p-5 {
            padding: 3rem !important;
        }
        .mb-4, .my-4 {
            margin-bottom: 1.5rem !important;
        }
        .mt-4, .my-4 {
            margin-top: 1.5rem !important;
        }
        .m-0 {
            margin: 0 !important;
        }
        .mb-0 {
            margin-bottom: 0 !important;
        }
        .d-flex {
            display: flex;
        }
        .flex-wrap {
            flex-wrap: wrap;
        }
        .flex-column {
            flex-direction: column;
        }
        .align-items-center {
            align-items: center;
        }
        .justify-content-center {
            justify-content: center;
        }
        .total div:first-child {
            background: #343A40;
            color: #fff;
        }
        .total div:last-child {
            background: #fff;
            color: #333;
        }
        .productos-carrito .row > [class*="col-"]{
            margin: 0;
        }
        .color {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 1px solid #ddd;
        }
    </style>


@stop