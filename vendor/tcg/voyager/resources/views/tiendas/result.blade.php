@foreach($userMovimientos as $data)
    <?php 
        $usuario = $data->user()->first();
        $pago = $data->pagos()->first(); 
    ?>
<tr>
    <td>
        {{$usuario->name}} {{$usuario->apellido}}
    </td>

    <td>
        {{\App\Models\Post::returnDescuento($pago->precio_neto, $pago->porcentaje_descuento)}}
    </td>
    <td>
        @php

        if($pago->MP_collection_status == 'approved'){
            
            @endphp<div class="alert alert-success">{{$pago->MP_collection_status}}</div>@php

        }elseif($pago->MP_collection_status == 'pending'){
            
            @endphp<div class="alert alert-warning">{{$pago->MP_collection_status}}</div>@php
        
        }elseif($pago->MP_collection_status == 'refunded'){
           
            @endphp<div class="alert alert-danger">{{$pago->MP_collection_status}}</div>@php

        }
        @endphp
    </td>

    <td>
        {{$pago->MP_comprobante}}
    </td>

    <td>
        {{$data->title}}
    </td>
    <td>
        <a href="/admin/pagos/{{$pago->id}}">Ver</a>
    </td>
</tr>
@endforeach