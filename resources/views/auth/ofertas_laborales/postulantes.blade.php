@extends('layouts.app')

@section('content')

<div class="container-fluid py-5 ">
  <div class="col-md-12">
      <div class="configuracion-user flex row">
        @include('auth.colder')
        <div class="col-md-7 col-xs-12 col-sm-12 ">
          <div class="col-md-12 col-sm-12 col-xs-12 b-white">
            <div class="col-md-12" style="margin-bottom: 20px;">
              <div class="text-center titulo-cuenta">
                <h2 class="titulos-lista">Personas postuladas a tu aviso {{$oferta->titulo}}</h2>
              </div>
            </div>
            <div class="col-md-12">
              @if($postulantes->count() > 0)
              @foreach($postulantes as $postulante)
                  <?php 
                      $user = $postulante->userId()->first();
                      $provincia = $user->provincias()->first();
                      $localidad = $user->localidades()->first();

                  ?>
                  <div class="col-md-12 c-interesados">
                      <div class="col-md-4">
                          <p>{{$user->name}}</p>
                      </div>
                      <div class="col-md-3">
                          <p>{{$user->apellido}}</p>
                      </div>
                      <div class="col-md-3">
                          <p>{{$postulante->created_at->todateString()}}</p>
                      </div>
                      <div class="col-md-1">
                        @if($postulante->estado == 'DESCARTADO')
                          <a href="#DESCARTADO" class="btn btn-warning">Descartado</a>
                          @else
                          <a href="#" class="btn btn-success" data-toggle="modal" data-target="#{{$postulante->id}}">Ver mas</a>
                        @endif
                      </div>
                  </div>
                  @if($postulante->estado != 'DESCARTADO')
                  <div class="modal fade" id="{{$postulante->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <ul>
                            <li>Nombre: {{$user->name}}</li>
                            @if($user->apellido)<li>Apellido: {{$user->apellido}}</li>@endif
                            <li>E-mail: {{$user->email}}</li>
                            @if($user->provincia_id)<li>Provincia:{{$provincia->name}}</li>@endif
                            @if($user->localidad_id)<li>Localidad:{{$localidad->municipio}}</li>@endif
                            <li>Teléfono celular: {{$user->telefono}}</li>
                            <hr>
                            <li>Se postulo a: {{$oferta->titulo}}</li>
                            <li>Puesto: {{$oferta->puesto}}</li>
                            <li>Vacantes: {{$oferta->vacantes}}</li>
                          </ul>
                          <br>
                          <small>(*) Si te interesa este perfil comunícate con el usuario arriba, esta su correo y Teléfono, de lo contrario descártalo para simplificar tu búsqueda.</small>
                        </div>
                        <div class="modal-footer">
                          <a href="/adm/postulante/{{$postulante->id}}/oferta/{{$postulante->oferta_id}}"  class="btn btn-danger">Descartar</a>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
              @endforeach
              @else
                <div class="alert alert-success">Nadie se ha postulado a tu oferta laboral</div>
              @endif
            </div> 
          </div>
        </div>
      </div>
  </div>
</div>   



@endsection