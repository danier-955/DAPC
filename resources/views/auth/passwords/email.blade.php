@extends('layouts.auth')
@section('title', 'Restablecer contraseña')

@section('content')
    <div class="card-body">

        @component('auth.partials.title')
            Restablecer contraseña
        @endcomponent

        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="input-group">
                    <div class="floating-label">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" autofocus required>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <span class="input-group-icon">
                        <i class="material-icons">email</i>
                    </span>
                </div>
            </div>

            <hr class="w-100">

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block">
                    Enviar enlace de restablecimiento
                </button>
                <div class="typography-body-1 pt-3 text-center">
                    ¿Ya estás registrado?
                    <a href="{{ route('login') }}" class="btn btn-link">Iniciar sesión</a>
                </div>
            </div>
        </form>
    </div>
@endsection
