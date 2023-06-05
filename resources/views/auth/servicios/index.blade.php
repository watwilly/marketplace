@extends('layouts.app')

@section('content')

<div class="container-fluid py-5">

  <div class="col-md-12 col-xs-12">
      <div class="configuracion-user flex row">
        @include('auth.colder')
        <div class="col-md-7 col-xs-12 col-sm-12">
          <div class="col-md-12 col-sm-12 col-xs-12 b-white">
            <div class="col-md-12 col-xs-12" style="margin-bottom: 30px;">
              <div class="text-center titulo-cuenta">
                <h2 class="titulos-lista">Mis servicios</h2>
              </div>
            </div>

            <div class="col-md-12 col-xs-12" style="padding: 13px;">
              <div class="buscador-conf input-group">
                <input  type="text" class="form-control" @if($buscar) value="{{$buscar}}" @endif name="buscar" id="campo" placeholder="Buscar..." autocomplete="off">
                 <span class="input-group-addon" style="background: white;">
                   <a href="#buscar" onclick="myservices();" class="glyphicon glyphicon-search" style="color: #ccda52;"></a>
                </span>
              </div> 
              <button class="boton"  data-toggle="modal" data-target="#nuevoservicio" style="margin-bottom: 5px;">Nuevo</button>

            </div>
            <div class="col-md-12 col-xs-12">
                <div class="lista-evento-user" id="lisTeventSearch">

                    @foreach($servicios as $servicio)
                        <div class="col-md-12 col-xs-12  evento-user " id="{{$servicio->titulo}}">
                          <div class="col-md-2 col-sm-4 col-xs-4 nopaddinresponsive">
                            <div class="img">
                              <img src="{{Voyager::get_image($servicio->foto, 'cropped', 'storage')}}" class="img-responsive">
                            </div>
                          </div>
                          <div class="col-md-10 col-sm-8 col-xs-8">
                            <div class="info" style="    padding: 15px 0 0;">
                              <div class="col-md-12 sinpadding">
                                <h4>{{$servicio->titulo}}</h4>
                              </div>
                            </div>    
                          </div>
                          <div class="dropdown">
                            <a class="btn delete btn-default dropdown-toggle" type="button" id="{{$servicio->id}}" data-toggle="dropdown"><i class=" fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu" style="top: 0%!important;" role="menu" aria-labelledby="{{$servicio->id}}">
                              @if($servicio->status == "PUBLISHED")
                                <li><a href="#{{$servicio->title}}" onclick="change_servicio_status('{{$servicio->id}}', 'PENDING')" title="Finalizar"><i class="fa fa-clock-o"></i> Finalizar</a></li>
                              @elseif($servicio->status == "PENDING")
                                <li><a href="#{{$servicio->title}}" onclick="change_servicio_status('{{$servicio->id}}', 'PUBLISHED')" title="Publicar"><i class="fa fa-clock-o"></i>Publicar</a></li>
                              @endif
                              <li><a href="/servicios/{{$servicio->id}}/editar"><i class="fa fa-pencil"></i> Editar</a></li>
                              <li><a href="#{{$servicio->slug}}" onclick="change_servicio_status('{{$servicio->id}}', 'TRASH')"  title="Eliminar"><i class="fa fa-trash"></i>Eliminar</a></li>

                            </ul>
                          </div>
                        </div>
                    @endforeach

                    {{$servicios->render()}}
                    @if(empty($servicio))
                      <div class="alert alert-info"><strong><i class="fa fa-coffee"></i> INFO!</strong> no as publicado ningun servicio </div>
                    @endif    
                </div> 
            </div>
          </div>
        </div>
      </div>   
  </div>
<div class="modal fade" id="nuevoservicio" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Nuevo</h4>
      </div>
      <div class="modal-body">
        <!--Start Form-->
        <form action="/addservice" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class=" form-group cargar-foto mb-3">
              <span><i class="fa fa-camera"></i> Agregar fotos</span>
              <input type="file" class="form-control" id="files" name="image" onchange="readURLevent(this);" >
            </div>
            <div class="file-foto">             
              <output id="result" />
            </div>

            <div class="form-group">
              <label>Categoria</label>
              <select name="category_id" class="form-control">
                @foreach($categorias as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" name="titulo" maxlength="110" >
            </div>
            <div class="form-group">
                <label>Descripcion</label>
                <textarea class="form-control" name="descripcion" maxlength="300"></textarea>
            </div>  
      </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Publicar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
      <!--End the form-->
    </div>
    
  </div>
</div>
</div>  


@endsection
