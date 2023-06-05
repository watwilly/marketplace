@extends('layouts.app')

@section('meta')
    <title>{{$status}}</title>
@stop

@section('content')
 
<section class="min-height">
    <div class="container payment text-center mt-5">
        <h2>@lang("web.$status")</h2>
        @if($status == "approved")
            <i class="fa success mb-3 fa-check-square"></i>
        @elseif($status == "pending")
            <i class="fa pending  mb-3 fa-clock"></i>
        @elseif($status == "cancelled")
            <i class="fa cancelled  mb-3 fa-window-close"></i>
        @endif

        <div class="row">
            <div class="col-md-5 m-auto">
                <a href="/" class="btn btn-success">Seguir comprando</a>
            </div>
        </div>
    </div>
</section>
@endsection

