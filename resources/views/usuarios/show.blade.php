@extends('layouts.app')
@section('title', 'Ver usuario')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item"><a href="{{ route('usuarios.show', $usuario->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">supervised_user_circle</i> Ver usuario
		</h1>
		<div>
			{{-- @include('partials.component_info', ['usuario' => $usuario]) --}}
			@can('usuarios.edit')
				@include('partials.button_edit', ['route' => route('usuarios.edit', $usuario->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">Nombre</span>
						</th>
						<td>{{ $usuario->nombre }}</td>
						<th>
							<span class="font-weight-bold">Correo electrónico</span>
						</th>
						<td>{{ $usuario->email }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Rol &middot; Cargo</span>
						</th>
						<td>
							<span class="chip">{{ $usuario->getRolNombre() }}</span>
						</td>
						<th>
							<span class="font-weight-bold">Estado</span>
						</th>
						<td>
							<span class="chip {{ $usuario->getEstadoColor() }}">
								{{ $usuario->getEstadoNombre() }}
							</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

        <blockquote class="blockquote my-4">
          <p class="mb-0 typography-subheading">Permisos asociados</p>
          <hr class="w-100">
        </blockquote>

		@foreach ($usuario->roles as $role)
	        @if ($role->permissions->isNotEmpty())
	            <div class="table-responsive">
	                <table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Nombre</th>
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
	                                    <td>{{ $iteration }}</td>
	                                    <td>{{ $permission->name }}</td>
	                                    <td>{{ $permission->description }}</td>
	                                </tr>
	                                @if ($loop->iteration === $loop->count)
								        @php
								        	$iteration = $loop->count
								        @endphp
								    @endif
								    @php
								    	$iteration++
								    @endphp
	                            @endforeach
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        @elseif ($usuario->isRole(SpecialRole::administrador()))
	            @component('partials.alert_empty')
	                El usuario tiene todos los permisos habilitados.
	            @endcomponent
	        @else
	            @component('partials.alert_empty')
	                No hay permisos asociados.
	            @endcomponent
	        @endif
	    @endforeach

	</div>
</div>
@endsection
