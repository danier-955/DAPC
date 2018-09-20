@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">supervised_user_circle</i> Usuarios
		</h1>
	</div>
	<div class="card-body">

		@role(SpecialRole::administrador())
			<form method="GET" action="{{ route('usuarios.index') }}" autocomplete="off">
				<div class="row clearfix">
	            	<div class="col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre"
								class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
								value="{{ old('nombre', Request::get('nombre')) }}">
			                @if ($errors->has('nombre'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('nombre') }}
			                    </div>
			               	@endif
						</div>
					</div>
					<div class="form-group col-md-3 col-lg-3">
					    <label>Rol &middot; Cargo</label>
					    <select name="rol" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('rol') ? 'is-invalid' : '' }}" autofocus>
					    	<option value="">··· Seleccione ···</option>
					    	@foreach($roles->chunk(15) as $chunk)
					    		@foreach($chunk as $rol)
						      		<option value="{{ $rol->id }}"
						      		@if (old('rol', Request::get('rol')) === $rol->id){{ 'selected' }}@endif>
						      			{{ $rol->name }}
						      		</option>
						      	@endforeach
					      	@endforeach
					    </select>
		                @if ($errors->has('rol'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('rol') }}
		                    </div>
		               	@endif
			 		</div>
	            	<div class="col-sm-12 col-md-5 col-lg-5">
						<div class="form-group">
							<label>Estado</label>
							<div class="mt-3">
								@foreach (Estado::busquedaAsociativos() as $estado)
									<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="estado_{{ $estado['id'] }}" name="estado"
									  		class="custom-control-input {{ $errors->has('estado') ? 'is-invalid' : '' }}"
									  		value="{{ $estado['id'] }}"
									  		{{ Request::get('estado', Estado::todo()) === $estado['id'] ? 'checked' : '' }}>
									  	<label class="custom-control-label"
									  		for="estado_{{ $estado['id'] }}">
									  		{{ $estado['texto'] }}
									  	</label>
									</div>
								@endforeach
							</div>
			                @if ($errors->has('estado'))
			                    <div class="form-text text-danger">
			                        {{ $errors->first('estado') }}
			                    </div>
			               	@endif
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="form-group text-center py-2">
							<button type="submit" class="btn btn-secondary">Búscar</button>
						</div>
					</div>
	        	</div>
	        </form>
		  	<hr class="mt-0 w-100">
		@endrole

		@if ($usuarios->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th>Nombre</th>
			                <th>Correo electrónico</th>
			                <th>Rol &middot; Cargo</th>
			                <th>Estado</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($usuarios as $usuario)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $usuario->nombre }}</td>
								<td>{{ $usuario->email }}</td>
								<td>
									<span class="chip">{{ $usuario->getRolNombre() }}</span>
								</td>
								<td>
									<span class="chip {{ $usuario->getEstadoColor() }}">
										{{ $usuario->getEstadoNombre() }}
									</span>
								</td>
								<td class="text-nowrap text-center">
									{{-- @include('partials.component_info', ['usuario' => $usuario, 'btnSm' => 'btn-sm']) --}}
									@can('usuarios.show')
										@include('partials.button_show', ['btnSm' => 'btn-sm', 'route' => route('usuarios.show', $usuario->id)])
									@endcan
									@can('usuarios.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('usuarios.edit', $usuario->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay usuarios registrados.
			@endcomponent
		@endif
	</div>
	@if ($usuarios->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $usuarios->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection
