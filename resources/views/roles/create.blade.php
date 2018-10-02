@extends('layouts.app')
@section('title', 'Registrar roles y permisos')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles y permisos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.create') }}">Registrar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
    <div class="card-header bg-light-2">
        <h1 class="typography-headline">
            <i class="material-icons mr-1">security</i> Registrar roles y permisos
        </h1>
    </div>
    <div class="card-body">

        <form method="post" action="{{ route('roles.store') }}" autocomplete="off">
            {{ csrf_field() }}

            <blockquote class="blockquote my-3">
              <p class="mb-0 typography-subheading">Información del rol</p>
              <hr class="w-100">
            </blockquote>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Nombre</label>
                     <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label>URL Amigable (solo minúsculas y puntos)</label>
                    <input type="text" name="slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" value="{{ old('slug') }}" required autofocus>
                    @if ($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label>Acceso especial</label>
                    <div class="mt-3">
                        @foreach (SpecialRole::createAsociativos() as $special)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="special{{ $loop->index }}" name="special"
                                    class="custom-control-input {{ $errors->has('special') ? 'is-invalid' : '' }}"
                                    value="{{ $special['id'] }}"
                                    {{ old('special', SpecialRole::nullable()) === $special['id'] ? 'checked' : '' }}>
                                <label class="custom-control-label" for="special{{ $loop->index }}">
                                    {{ $special['texto'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @if ($errors->has('special'))
                        <div class="form-text text-danger">
                            {{ $errors->first('special') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Descripción</label>
                    <textarea name="description" rows="3" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" autofocus>{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
            </div>

            <blockquote class="blockquote my-3">
              <p class="mb-0 typography-subheading">Permisos asociados</p>
              <hr class="w-100">
            </blockquote>

            <div class="form-row">
                <div class="form-group col-md-12">

                    <ul class="list-group list-group-flush">
                        @foreach($permissions->chunk(15) as $chunk)
                            @foreach($chunk as $permission)
                                <li class="list-group-item list-group-item-action">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            id="customCheck{{ $permission->id }}" name="permissions[{{ $permission->id }}]"
                                            class="custom-control-input {{ $errors->has('permissions.' . $permission->id) ? 'is-invalid' : '' }}"
                                             value="{{ $permission->id }}"
                                            {{ old('permissions.' . $permission->id) === $permission->id ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customCheck{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                        <div class="text-muted">{{ $permission->description }}</div>
                                        @if ($errors->has('permissions.' . $permission->id))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('permissions.' . $permission->id) }}
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <hr class="w-100">
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>

        </form>

    </div>
</div>
@endsection