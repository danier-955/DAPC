@extends('layouts.app')
@section('title', 'Ver roles y permisos')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles y permisos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.show', $role->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between bg-light-2">
        <h1 class="typography-headline">
            <i class="material-icons mr-1">group</i> Ver roles y permisos
        </h1>
        <div>
            @can('roles.create')
                @include('partials.button_create', ['route' => route('roles.create')])
            @endcan
            @can('roles.edit')
                @include('partials.button_edit', ['route' => route('roles.edit', $role->id)])
            @endcan
            @can('roles.destroy')
                @if ($role->noEsRolPrincipal())
                    @include('partials.button_destroy', ['route' => route('roles.destroy', $role->id)])
                @endif
            @endcan
        </div>
    </div>
    <div class="card-body">

        <blockquote class="blockquote my-3">
          <p class="mb-0 typography-subheading">Información del rol</p>
          <hr class="w-100">
        </blockquote>

        <div class="table-responsive">
            <table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
                <tbody>
                    <tr>
                        <th>
                            <span class="font-weight-bold">Nombre</span>
                        </th>
                        <td>{{ $role->name }}</td>
                        <th>
                            <span class="font-weight-bold">URL amigable</span>
                        </th>
                        <td>{{ $role->slug }}</td>
                    </tr>
                    <tr>
                        <th>
                            <span class="font-weight-bold">Acceso especial</span>
                        </th>
                        <td colspan="3">
                            <span class="chip {{ $role->getSpecialColor() }}">
                                {{ $role->getSpecialNombre() }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="font-weight-bold">Descripción</span>
                        </th>
                        <td colspan="3">{!! nl2br($role->description) !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <blockquote class="blockquote my-4">
          <p class="mb-0 typography-subheading">Permisos asociados</p>
          <hr class="w-100">
        </blockquote>

        @if ($role->permissions->isNotEmpty())
            <div class="table-responsive">
                <table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            {{-- <th>URL amigable</th> --}}
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $iteration = 1;
                        @endphp
                        @foreach($role->permissions->chunk(15) as $chunk)
                            @foreach($chunk as $permission)
                                <tr>
                                    <td>{{ $iteration++ }}</td>
                                    <td>{{ $permission->name }}</td>
                                    {{-- <td>{{ $permission->slug }}</td> --}}
                                    <td>{{ $permission->description }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($role->esAdministrador())
            @component('partials.alert_empty')
                El rol tiene todos los permisos habilitados.
            @endcomponent
        @else
            @component('partials.alert_empty')
                No hay permisos asociados.
            @endcomponent
        @endif

    </div>
</div>
@endsection
