@extends('layouts.app')

@section('content')
<section class="min-height">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0 d-none d-lg-block">
              @include('auth.colder')
            </div>
            <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="grid rows-2 rows-lg-1 cols-1 cols-lg-2 justify-content-stretch align-items-center">
                    <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                        <h2 class="m-0">Atributos: {{$post->title}}</h2>
                    </div>
                    <div class="grid-item p-0 justify-self-center justify-self-lg-end">
                        <a href="/ventas"  class="section__link section__link--secondary">Volver</a>
                    </div>
                </div>

                <div class="row g-3 mt-6">
                @if($talle->count() > 0)
                  <div class="col-md-6">
                    <h4>Talles</h4>
                    <div class="col-md-12 talles">
                      <ul class="list-group">
                        @foreach($talle as $publicacionTalles)
                          <?php 
                            $talles = $publicacionTalles->talles()->first();
                          ?>    
                        <li class="list-group-item" id="talle{{$publicacionTalles->id}}">{{$talles->talle}}  
                          <a href="#{{$talles->talle}}" onclick="deleteAtribute({{$post->id}}, {{$publicacionTalles->id}}, 'talle')"><i class="fa fa-trash"></i></a></li>
                        @endforeach
                      </ul>
                    </div>        
                  </div>
                @endif

                @if($colores->count() > 0)
                  <div class="col-md-6">
                    <h4>Colores</h4>
                    <div class="col-md-12 talles">
                      <ul class="list-group">
                        @foreach($colores as $publicacionColores)
                          <?php 
                            $color = $publicacionColores->Colores()->first();
                          ?>    

                        <li class="list-group-item" id="color{{$publicacionColores->id}}"> <span style="background-color: {{$color->color}}; width: 80%;height: 11px;display: inline-table;"></span>  
                          <a href="#{{$color->color}}" onclick="deleteAtribute({{$post->id}}, {{$publicacionColores->id}}, 'color')"><i class="fa fa-trash"></i></a></li>

                        @endforeach
                      </ul>
                    </div>          
                  </div>
                @endif
                
                </div>

            </div>
        </div>
    </div>
</section>

@append

@section('jsfooter')

<script>

  
 

</script>
@append
