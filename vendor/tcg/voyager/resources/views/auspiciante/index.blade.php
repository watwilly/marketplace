@extends('voyager::master')

@section('page_title','View Auspiciante')

@section('page_header')
    <h1 class="page-title">
        <a href="{{ route('voyager.auspiciante.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver al listado
        </a>        
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered col-md-12" style="padding-bottom:5px;">
                    <div class="col-md-12">
                        <h3>Datos del Auspiciante</h3>
                        <div class="col-md-6">
                            <ul>
                                <li>Nombre: {{$auspiciante->nombre}}</li>
                                <li>Apellido: {{$auspiciante->apellido}}</li>
                                <li>Teléfono: {{$auspiciante->telefono}}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Email: {{$auspiciante->email}}</li>
                                <li>Razon social: {{$auspiciante->razon_social}}</li>
                                <li>Dni: {{$auspiciante->dni}}</li>
                                <li>Cuit/Cuil: {{$auspiciante->cuil_cuit}}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel panel-bordered col-md-12" style="padding-bottom:5px;">
                    <div class="col-md-6">
                        <h3>Pautas del Auspiciante</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button data-toggle="modal" data-target="#myModal" class="btn btn-success">Crear nueva pauta</button>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <table id="dataTable" class="row table table-hover">
                                <thead>
                                    <tr>
                                        <th>Posicion</th>
                                        <th>Desde</th>
                                        <th>hasta</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($pautas as $pauta)
                                            <tr>
                                                <?php 
                                                    $p_position = $pauta->posicioneId()->first(); 
                                                    if ($pauta->status == 1) {
                                                        $status ="HABILITADO";
                                                    }else{
                                                        $status = "DESHABILITADO";
                                                    }
                                                ?>
                                                <td>{{$p_position->name}}</td>
                                                <td>{{$pauta->desde}}</td>
                                                <td>{{$pauta->hasta}}</td>
                                                <td>{{$status}}</td>
                                                <td>
                                                <a href="/admin/pauta/{{$pauta->id}}/auspiciante/{{$auspiciante->id}}/{{$status}}"  class="btn btn-sm btn-success pull-right delete" >
                                                    <i class="voyager-eyes"></i> <span class="hidden-xs hidden-sm">@if($pauta->status == 1) Habilitado @else Deshabilitado @endif </span>
                                                </a>
                                                <a href="/admin/pauta/{{$pauta->id}}/{{$auspiciante->id}}/edit" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                                    <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                                </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva pauta</h4>
      </div>
      <div class="modal-body">
        <form action="/admin/auspiciante/{{$auspiciante->id}}/nuevaPauta" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Posicion</label>
                <select name="posicion_id" class="form-control">
                    @foreach($posiciones as $posicion)
                        <option value="{{$posicion->id}}">{{$posicion->name}}</option>
                    @endforeach
                </select>
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
                    <input type="date" name="desde" class="form-control">
                </div>
                <div class="form-group">
                    <label>Hasta</label>
                    <input type="date" name="hasta" class="form-control">
                </div>
                <div class="form-group">
                    <label>Url/Link</label>
                    <input type="text" name="link" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>

@stop

@section('javascript')
    <script>


    </script>
@stop
