@extends('layouts.auth')
@section('title', 'Restablecer contraseña')

@section('content')
    <div class="card-body">

        @component('auth.partials.title')
            Restablecer contraseña
        @endcomponent

        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

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

            <div class="form-group">
                <div class="input-group">
                    <div class="floating-label">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autofocus required>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <span class="input-group-icon">
                        <i class="material-icons">lock</i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="floating-label">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" autofocus required>
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>
                    <span class="input-group-icon">
                        <i class="material-icons">lock</i>
                    </span>
                </div>
            </div>

            <hr class="w-100">

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block">
                    Restablecer contraseña
                </button>
            </div>
        </form>
    </div>
@endsection
