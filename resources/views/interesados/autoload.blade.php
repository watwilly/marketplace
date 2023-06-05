@foreach($consultas as $consulta)
    <div class="alert alert-gray">
        <h6 class="text-black">{{$consulta->mensaje}}</h6>
        @if($consulta->answered)
        <p class="ms-4" style="word-break: break-all;">{{$consulta->answered}}</p>
        @endif
        <span class="d-block text-end">{{$consulta->created_at->todateString()}}</span>
    </div>
@endforeach