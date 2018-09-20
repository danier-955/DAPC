@extends('layouts.app')
@section('title', 'Grados')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
		<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
		<li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
		<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header">
	  		<h1 class="typography-headline">
	  			<i class="material-icons mr-1">school</i> Registrar grado
	  		</h1>
	  	</div>
		<div class="card-body">

			<form  method="post" action="{{ route('grados.store') }}" autocomplete="off">
				{{ csrf_field() }}

				<div class="form-row">
					<div class="form-group col-md-4">
				    	<label>Nombre del Grado</label>
				   		<input type="text" name="nomb_grad" class="form-control {{ $errors->has('nomb_grad') ? 'is-invalid' : '' }}" value="{{ old('nomb_grad') }}" required autofocus>
		                @if ($errors->has('nomb_grad'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_grad') }}
		                    </div>
		               	@endif
			  		</div>
			  		<div class="form-group col-md-4">
				    	<label>Abreviacion del grado</label>
				   		 <input type="number" name="abre_grad" class="form-control {{ $errors->has('abre_grad') ? 'is-invalid' : '' }}" value="{{ old('abre_grad') }}" required autofocus>
		                @if ($errors->has('abre_grad'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('abre_grad') }}
		                    </div>
		               	@endif
			  		</div>
			  		<div class="form-group col-md-4">
				    	<label>Jornada</label>
					    <select name="jorn_grad" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('jorn_grad') ? 'is-invalid' : '' }}" required autofocus>
					    	@empty(old('jorn_grad'))
			                    <option value="">··· Seleccione ···</option>
			                @endempty
					    	@foreach(Jornada::adminAsociativos() as $jornada)
					      		<option value="{{ $jornada['id'] }}"
					      		@if (old('jorn_grad') === $jornada['id']){{ 'selected' }}@endif>
					      			{{ $jornada['texto'] }}
					      		</option>
					      	@endforeach
					    </select>
		                @if ($errors->has('jorn_grad'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('jorn_grad') }}
		                    </div>
		               	@endif
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