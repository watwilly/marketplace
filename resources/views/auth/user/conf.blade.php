@extends('layouts.app')
@section('meta')
    <title>Configuracion</title>
@stop
@section('content')
 <section class="min-height">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-3 p-0 d-none d-lg-block">
              @include('auth.colder')
            </div>
            <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="grid rows-2 rows-lg-1 cols-1 cols-lg-1 justify-content-stretch align-items-center">
                    <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                        <h2 class="m-0">Configuracion del Perfil Comercial</h2>
                    </div>
                </div>

                <div class="row gx-3 gy-5 mt-3">
                    @if(is_null($comercial))
                        <div class="col-12">
                            <h4 class="lead alert alert-info text-center text-lg-start">Para recibir pagos con Mercado Pago y poder ser un vendedor oficial en nuestro sitio web, tienes que completar estos datos y te enviaremos un correo cuando los validemos.</h4>
                        </div>
                        <form action="/user/conf-store" method="post" class="row gx-3 gy-5 mt-2" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 col-lg-8">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="rsocial" id="input_email" placeholder="Ejemplo"  >
                                    <label for="input_email">Razon Social</label>
                                </div>
                                @error('rsocial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-4 d-none d-lg-block"></div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-floating">
                                    <input type="text" name="cuit" class="form-control" id="input_name"  placeholder="Ejemplo">
                                    <label for="input_name">Cuit</label>
                                </div>
                                @error('cuit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-floating">
                                    <input type="file" name="ingbruto" class="form-control" id="input_lastname"  placeholder="Ejemplo">
                                    <label for="input_lastname">Ingresos brutos</label>
                                </div>
                                @error('ingbruto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12"></div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-floating">
                                    <input name="telefono" type="tel"  class="form-control" id="input_phone" placeholder="Ejemplo">
                                    <label for="input_phone">Teléfono Comercial</label>
                                </div>
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-floating">
                                    <input type="text" name="horario" class="form-control" id="input_address" placeholder="Ejemplo">
                                    <label for="input_address">Horario Laboral</label>
                                </div>
                                @error('horario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12"></div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="input_code" placeholder="Ejemplo">
                                    <label for="input_code">Email</label>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-floating">
                                    <input type="text" name="direccion" class="form-control" id="input_code" placeholder="Ejemplo">
                                    <label for="input_code">Direccion</label>
                                </div>
                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 d-flex mt-6">
                                <button class="btn btn-success mx-auto">Guardar cambios</button>
                            </div>
                        </form>
                    @else
                        <div class="col-12 text-center">
                                @if(is_null($comercial->estado_solicitud))
                                    <div class="alert-warning alert">
                                        <p><strong>Su solicitus ha siddo enviada y esta en espera de validacion.</strong></p>
                                        <i class="fa fa-clock" style="font-size: 33px;"></i>
                                    </div>
                                @elseif($comercial->estado_solicitud=="APROBADO")
                                    <div class="alert-success alert">
                                        @if($meli)
                                            <p><strong>Su perfil comercial ha sido aprobado y su cuenta se encuentra conectada con Mercado Pago esta listo para vender</p>
                                        @else
                                            <p><strong>Su solicitus ha sido validada ahora haga click <a href="/ml/auth">Aqui</a> para conectar su cuenta con Mercado Pago</strong></p>
                                        @endif
                                        <i class="fa fa-check" style="font-size: 33px;"></i>
                                    </div>
                                @elseif($comercial->estado_solicitud=="NEGADO")
                                    <div class="alert-danger alert">
                                        <p><strong>Su solicitud ha sido negada por {{$comercial->motivo}} puedes enviarla nuevamente haciendo click <a href="/user/renew/comercial">Aqui</a></strong></p>
                                        <i class="fa fa-window-close" style="font-size: 33px;"></i>
                                    </div>
                                @endif
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

