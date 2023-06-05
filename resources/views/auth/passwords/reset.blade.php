@extends('layouts.app')

@section('content')

<section class="min-height">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-9 py-5">
                <div class="grid rows-2 rows-lg-1 cols-1 cols-lg-2 justify-content-stretch align-items-center">
                    <div class="grid-item p-0 justify-self-center justify-self-lg-start">
                        <h2 class="m-0">Restablecer contraseña</h2>
                    </div>
                </div>

                <div class="row g-3 mt-6">
                    <div class="col-12">
                        <h4 class="lead mt-6 text-center text-lg-start">Por favor ingrese la nueva contraseña
                        </h4>
                    </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="col-12 col-md-6 ">
                        <div class="form-floating">
                            <input type="text" name="email" value="{{ $email ?? old('email') }}" required class="form-control" id="input_password" placeholder="Ejemplo">
                            <label for="input_password">Email</label>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 ">
                        <div class="form-floating">
                            <input type="password" name="password" required class="form-control" id="input_password" placeholder="Ejemplo">
                            <label for="input_password">Nueva contraseña</label>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12"></div>
                    <div class="col-12 col-md-6 ">
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" required class="form-control" id="input_confirm" placeholder="Ejemplo">
                            <label for="input_confirm">Confirmar contraseña</label>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-center justify-content-lg-start mt-6">
                        <button class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection

