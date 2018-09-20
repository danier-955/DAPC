@extends('layouts.app')
@section('title', 'Roles y permisos')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles y permisos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h1 class="typography-headline">
            <i class="material-icons mr-1">security</i> Roles y permisos
        </h1>
        @can('roles.create')
            @include('partials.button_create', ['route' => route('roles.create')])
        @endcan
    </div>
    <div class="card-body">

        @if ($roles->isNotEmpty())
            <div class="table-responsive">
                <table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acceso especial</th>
                            <th class="text-nowrap text-center">Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->getDescription() }}</td>
                                <td>
                                    <span class="chip {{ $role->getSpecialColor() }}">
                                        {{ $role->getSpecialNombre() }}
                                    </span>
                                </td>
                                <td class="text-nowrap text-center">
                                    @can('roles.show')
                                        @include('partials.button_show', ['route' => route('roles.show', $role->id)])
                                    @endcan
                                    @can('roles.edit')
                                        @include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('roles.edit', $role->id)])
                                    @endcan
                                    @can('roles.destroy')
                                        @if ($role->noEsRolPrincipal())
                                            @include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('roles.destroy', $role->id)])
                                        @else
                                            @include('partials.button_destroy', ['btnSm' => 'btn-sm', 'disabled' => true])
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            @component('partials.alert_empty')
                No hay roles registrados.
            @endcomponent
        @endif
    </div>
    @if ($roles->hasPages())
        <hr class="my-0 w-100">
        <div class="card-actions align-items-center justify-content-center px-3">
            {{ $roles->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
