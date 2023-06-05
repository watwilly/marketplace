@extends('voyager::master')

@section('page_title','View Auspiciante')

@section('page_header')
    <h1 class="page-title">
        <a href="/admin/auspiciante/{{$pauta->auspiciante_id}}/pautas" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Regresar al auspiciante
        </a>        
    </h1>
@stop

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered col-md-12" style="padding-bottom:5px;">
                <div class="col-md-12">
                    <h3>Edicion de pauta</h3>
                </div>
                <div class="col-md-6">
                    <form action="/admin/pauta/{{$pauta->id}}/update" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Posicion</label>
                            <select name="posicion_id" class="form-control">
                                @foreach($posiciones as $posicion)
                                    <option value="{{$posicion->id}}" @if($pauta->posicion_id == $posicion->id) selected @endif>{{$posicion->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Banner</label>
                            <input type="file" name="banner" class="form-control">                
                        </div>
                        <div class="form-group">
                            <label>Banner Responsive (400X400)</label>
                            <input type="file" name="banner_responsive" class="form-control">                
                        </div>
                        <div class="form-group">
                            <label>Desde</label>
                        </div><input type="date" class="form-control" name="desde">
                        <div class="form-group">
                            <label>Hasta</label>
                            <input type="date" name="hasta"  class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Url/Link</label>
                            <input type="text" name="link" @if($pauta->link) value="{{$pauta->link}}" @endif  class="form-control" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                       <h4>Fechas de la pauta</h4> 
                       <ul>
                           <li>Desde : {{$pauta->desde}}</li>
                           <li>Hasta : {{$pauta->hasta}}</li>
                           <span>(*) Esta pauta finalizara a primera hora del día HASTA</span>
                       </ul>
                    </div>
                    <div class="col-md-12">
                        <h4>Banner</h4>
                        <img src="/storage/{{$pauta->banner}}" class="img-responsive">
                    </div>
                    <div class="col-md-12" style="margin-bottom: 15px;">
                        <h4>Banner Responsivo</h4>
                        <img src="/storage/{{$pauta->banner_responsive}}" class="img-responsive">
                    </div>
                    <div class="col-md-12 alert alert-info" >
                        <span >(*) Como los banner son obligatorios no esta permitido eliminar y dejar un campo vació, si quieres modificarlo seleccione uno nuevo, y se actualizara.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
