@extends('layouts.app')
@section('title', 'Editar usuario')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item"><a href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">supervised_user_circle</i> Editar usuario
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('usuarios.update', $usuario->id) }}" autocomplete="off">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-row">
			  	<div class="form-group col-md-4">
			    	<label>Nombre</label>
			   		<input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" value="{{ old('nombre', $usuario->nombre) }}" required autofocus readonly>
	                @if ($errors->has('nombre'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nombre') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-4">
			    	<label>Correo electrónico</label>
			   		<input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $usuario->email) }}" required autofocus readonly>
	                @if ($errors->has('email'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('email') }}
	                    </div>
	               	@endif
			 	</div>
				<div class="form-group col-md-4">
			    	<label>Estado</label>
			   		<div class="mt-3">
						@foreach (Estado::asociativos() as $estado)
							<div class="custom-control custom-radio custom-control-inline">
							  	<input type="radio"
							  		id="estado_{{ $estado['id'] }}" name="estado"
							  		class="custom-control-input {{ $errors->has('estado') ? 'is-invalid' : '' }}"
							  		value="{{ $estado['id'] }}"
							  		{{ old('estado', $usuario->estado) === $estado['id'] ? 'checked' : '' }} required autofocus
							  		@if ($usuario->puedeCambiarEstado($estado['id'])){{ 'disabled' }}@endif>
							  	<label class="custom-control-label"
							  		for="estado_{{ $estado['id'] }}">
							  		{{ $estado['texto'] }}
							  	</label>
							</div>
						@endforeach
					</div>
	                @if ($errors->has('estado'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('estado') }}
	                    </div>
	               	@endif
			  	</div>
			</div>
			<div class="form-row">
			  	<div class="form-group col-md-4">
			    	<label>Rol &middot; Cargo</label>
			   		<select name="role" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" required autofocus>
				    	<option value="{{ $usuario->getRolId() }}" selected>
	                    	{{ $usuario->getRolNombre() }}
	                    </option>
		                @if ($usuario->puedeCambiarRol())
					    	@foreach($roles as $role)
					      		<option value="{{ $role->id }}"
					      		@if (old('role') === $role->id){{ 'selected' }}@endif>
					      			{{ $role->name }}
					      		</option>
					      	@endforeach
					    @endif
				    </select>
	                @if ($errors->has('role'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('role') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-4">
			    	<label>Contraseña</label>
			   		<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autofocus>
	                @if ($errors->has('password'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('password') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Confirmar contraseña</label>
			   		<input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" autofocus>
	                @if ($errors->has('password_confirmation'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('password_confirmation') }}
	                    </div>
	               	@endif
			 	</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-12 text-center">
		  			<hr class="w-100">
			  		<button type="reset" class="btn btn-secondary">Limpiar</button>
			  		<button type="submit" class="btn btn-primary">Actualizar</button>
			  	</div>
			</div>

		</form>
	</div>
</div>
@endsection



