@extends('voyager::master')

@section('page_title','View '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> Ver {{ ucfirst($dataType->display_name_singular) }} &nbsp;

        <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;
            Editar
        </a>
        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver al listado
        </a>     

    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px; ">

                    <div class="panel-heading col-md-12" style="border-bottom:0;">
                        <div class="col-md-12">
                            <h4>Administrador de la tienda</h4>
                            <div class="col-md-6">
                                <p>Nombre : {{$adm_tienda->name}} {{$adm_tienda->apellido}}</p>
                                <p>Email: {{$adm_tienda->email}}</p>                                
                            </div>
                            <div class="col-md-6">
                               <p>Cuit: {{$adm_tienda->cuit}}</p>
                                <p><a href="">Administrar Este Usuario</a></p> 
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                            <div class="col-md-12">
                                <h4>Publicaciones creadas</h4>
                                <div class="panel-body table-responsive">
                                    <table id="dataTable" class="row table table-hover">
                                        <thead>
                                            <tr>
                                               
                                                <th>Id</th>
                                                <th>Titulo</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($publicaciones as $post)

                                            <tr>
                                                <td>
                                                    {{$post->id}}
                                                </td>

                                                <td>
                                                    {{$post->title}}

                                                </td>

                                                <td>
                                                  
                                                    {{$post->status}}
                                                </td>

                                                <td>
                                                    <a href="/admin/posts/{{$post->id}}/edit">Editar</a>
                                                </td>

                                    
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                        <div class="pull-left">
                                           <div role="status" class="show-res" aria-live="polite">
                                               {{$publicaciones->render()}}
                                           </div>
                                        </div>
                                </div> 
                            </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script>
$(document).ready(function() {
    $('#form, #fat, #fofiltropayment').submit(function(event) {
      var formData = new FormData($("#fofiltropayment")[0]);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {

                $("#resultSearch").html(data);
                
  
            }
       })
        
        return false;
    }); 
});

</script>
@stop
