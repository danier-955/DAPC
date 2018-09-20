@extends('layouts.auth')
@section('title', 'Ingresar')

@section('content')
    <div class="card">
        @include('auth.partials.logo')
        <div class="card-body">

            @component('auth.partials.title')
                Iniciar sesión
            @endcomponent

            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group">
                        <div class="floating-label">
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" autofocus required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <span class="input-group-icon">
                            <i class="material-icons">email</i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="floating-label">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autofocus required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                        <span class="input-group-icon">
                            <i class="material-icons">lock</i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox my-4">
                        <input type="checkbox" id="remember" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Recuerdáme</label>
                        <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                            ¿Olvidasté tu contraseña?
                        </a>
                    </div>
                </div>

                <hr class="w-100">

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
