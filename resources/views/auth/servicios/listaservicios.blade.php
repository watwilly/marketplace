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