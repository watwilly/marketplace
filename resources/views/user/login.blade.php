@extends('layouts.app')
@section('meta')
      <meta  name="title" content="Ingresa con tus redes sociales para vender en tucuman" >
      <meta  name="description" content="Compras Tucuman - la experiencia de tener una tienda digital">
      <meta  property=og:locale content="es_ar" >
      <meta  property=og:description content="Compras Tucuman - la experiencia de tener una tienda digital" >
      <meta  property=og:site_name content="Ventas Tucumán" >
      <meta property="og:title" content="Registrate con tus redes sociales para vender en tucuman"/>
      <title>Ingresar parar vender en linea en Tucumán</title>
  @stop
@section('content')

<section class="py-6" style="min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">Iniciar Sesión</h2>
            </div>
            <div class="col-12 col-lg-4">
                <div class="row g-3">
                    <div class="col-12">
                        <h3 class="lead">Ingresar con tu cuenta de:</h3>
                    </div>
                    <div class="col-6">
                        <a href="{{url('/auth/facebook')}}" class="d-block btn btn-blue"><i class="fab fa-facebook-square"></i> Facebook</a>
                    </div>
                    <div class="col-6">
                        <a href="{{url('/auth/google')}}" class="d-block btn btn-red text-white"><i class="fab fa-google-plus-g"></i> Google+</a>
                    </div>

                    <div class="col-12">
                        <hr class="my-6">
                    </div>
                    <div class="col-12">
                        <h3 class="lead">Ingresar con tu email y contraseña</h3>
                    </div>
                    <form action="/auth/login" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                      <div class="col-12">
                          <div class="form-floating">
                              <input type="email" name="email" class="form-control" id="input_email" placeholder="Ejemplo" value="{{old("email")}}">
                              <label for="input_email">E-mail</label>
                          </div>
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="col-12">
                          <div class="form-floating">
                              <input type="password" name="password" class="form-control" id="input_pass" placeholder="Ejemplo">
                              <label for="input_pass">Contraseña</label>
                          </div>
                          @error('password')
                              <span class="invalid-feedback " role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="col-12">
                          <div class="d-flex g-2 justify-content-center">
                              <button class="btn btn-primary w-50">Ingresar</button>
                          </div>
                      </div>
                    </form>
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center">
                            <a href="{{ route('password.request') }}" class="section__link section__link--secondary">Olvidé mi Contraseña</a>
                            <a href="/auth/user/register" class="section__link section__link--secondary">Registrarme</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="d-none d-lg-flex h-100 flex-column justify-content-start align-items-center">
                    <img src="https://www.saldeello.com/storage/settings/October2021/xcQCvpXbvp4cRVboM2Q9.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
 

@endsection