@extends('voyager::master')

@section('page_title', 'Mailen')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class=" "></i> Mailen
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                            <form method="get" class="form-search">
                                <div id="search-input">
                                    <div class="col-md-5">
                                        <select class="form-control"  name="trueStore" required>
                                            <option value="">Seleccione Tipo de usuario</option>
                                            <option value="with-store">Usuarios con Tiendas</option>
                                            <option value="with-out-store">Usuarios  sin tiendas</option>
                                            <option value="all">Todos</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <select class="form-control"   name="plantilla_id" required>
                                            <option value="">Seleccione Plantilla a enviar</option>
                                            @foreach($plantillas as $plantilla)
                                                <option value="{{$plantilla->id}}" @if(isset($_GET["plantilla_id"]) && $_GET["plantilla_id"]==$plantilla->id) selected @endif>{{$plantilla->titulo}}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>
                                    <div class=" col-md-2">
                                        <span class="input-group-btn text-right">
                                            <button class="btn btn-info btn-lg" type="submit">
                                                <i class="voyager-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                
                            </form>
                        <div class="table-responsive">
                            <form action="/admin/send-mailen" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="plantilla_id" value="@if(isset($_GET["plantilla_id"])){{$_GET["plantilla_id"]}}@endif" >
                                <table id="dataTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Notificar</th>
                                            <th>Id</th>
                                            <th>Enviado</th>
                                            <th>Email</th>
                                            <th>Tienda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($user as $data)

                                                <?php
                                                    $up=null;
                                                    if (isset($_GET["plantilla_id"])) {
                                                        $up=$data->mailenId()->where("plantilla_id",$_GET["plantilla_id"])->first();
                                                    }
                                                ?>
                                                @if(is_null($up))
                                                    <tr>
                                                      <?php 
                                                        $tienda = $data->tienda()->first();
                                                        
                                                        $tname = "No creada";
                                                        if ($tienda) {
                                                            $tname = $tienda->titulo;
                                                        }

                                                        $withoutstore=null;
                                                        if (isset($_GET["trueStore"])&&$_GET["trueStore"]=="with-out-store") {
                                                            $withoutstore=$tienda;
                                                        }
                                                      ?>
                                                      @if(is_null($withoutstore))
                                                          <td><input type="checkbox" name="selected[]" value="{{$data->email}}:{{$data->id}}:@if(isset($_GET["plantilla_id"])){{$_GET["plantilla_id"]}}@endif:{{$data->name}}:{{$data->apellido}}"></td>
                                                          <td>{{$data->id}}</td>
                                                          <td>true-demo</td>
                                                          <td>{{$data->email}}</td>
                                                          <td>{{$tname}}</td>
                                                      @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-success">Enviar email </button>
                            </form>
                        </div>
                            <div class="pull-left">
                                <div role="status" class="show-res" aria-live="polite">{{ trans_choice(
                                    'voyager::generic.showing_entries', $user->total(), [
                                        'from' => $user->firstItem(),
                                        'to' => $user->lastItem(),
                                        'all' => $user->total()
                                    ]) }}</div>
                            </div>
                            <div class="pull-right">
                                {{$user->render()}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
@stop

@section('javascript')
   
@stop
