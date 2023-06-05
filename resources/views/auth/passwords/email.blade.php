@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="flex row jcenter">
        <div class="modal-body col-md-5 col-xs-12 recupera-clave">
            <h3>¿Perdiste tu contraseña?</h3>
            <p>Sigue los siguientes pasos para recuperarla:</p>
            <ol>
                <li>Introduce tu correo electrónico</li>
                <li>Recibirás un email con el link de recuperación</li>
                <li>Una vez en el link, introduce tu nueva contraseña</li>
            </ol>
            <form action="{{ route('password.email') }}" method="post" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        
                <div class="form-floating">
                    <input type="email" required name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                    <label for="input_email">Email</label>
                </div>
                <div class="form-group">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="col-12  mt-6">
                    <button type="submit" class="btn btn-success mx-auto">Enviar email</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
