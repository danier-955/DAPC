@extends('layouts.app')
@section('title', 'Registrar docente')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('docentes.create') }}">Registrar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Registrar docente
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('docentes.store') }}" autocomplete="off">
			{{ csrf_field() }}

			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Información del docente</p>
			  <hr class="w-100">
			</blockquote>

			<div class="form-row">
			  	<div class="form-group col-md-3">
			    	<label>No. Identificación</label>
			   		 <input type="number" name="docu_doce" class="form-control {{ $errors->has('docu_doce') ? 'is-invalid' : '' }}" value="{{ old('docu_doce') }}" required autofocus>
	                @if ($errors->has('docu_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('docu_doce') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Nombres</label>
			   		<input type="text" name="nomb_doce" class="form-control {{ $errors->has('nomb_doce') ? 'is-invalid' : '' }}" value="{{ old('nomb_doce') }}" required autofocus>
	                @if ($errors->has('nomb_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_doce') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Primer apellido</label>
			   		<input type="text" name="pape_doce" class="form-control {{ $errors->has('pape_doce') ? 'is-invalid' : '' }}" value="{{ old('pape_doce') }}" required autofocus>
	                @if ($errors->has('pape_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('pape_doce') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Segundo apellido</label>
			   		<input type="text" name="sape_doce" class="form-control {{ $errors->has('sape_doce') ? 'is-invalid' : '' }}" value="{{ old('sape_doce') }}" autofocus>
	                @if ($errors->has('sape_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sape_doce') }}
	                    </div>
	               	@endif
			  	</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-3">
				    <label>Sexo</label>
				    <select name="sexo_doce" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sexo_doce') ? 'is-invalid' : '' }}" required autofocus>
				    	@empty(old('sexo_doce'))
		                    <option value="">··· Seleccione ···</option>
		                @endempty
				    	@foreach(Sexo::asociativos() as $sexo)
				      		<option value="{{ $sexo['id'] }}"
				      		@if (old('sexo_doce') === $sexo['id']){{ 'selected' }}@endif>
				      			{{ $sexo['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('sexo_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sexo_doce') }}
	                    </div>
	               	@endif
		 		</div>
			  	<div class="form-group col-md-3">
			    	<label>Dirección de residencia</label>
			   		<input type="text" name="dire_doce" class="form-control {{ $errors->has('dire_doce') ? 'is-invalid' : '' }}" value="{{ old('dire_doce') }}" required autofocus>
	                @if ($errors->has('dire_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('dire_doce') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Barrio de residencia</label>
			   		<input type="text" name="barr_doce" class="form-control {{ $errors->has('barr_doce') ? 'is-invalid' : '' }}" value="{{ old('barr_doce') }}" autofocus>
	                @if ($errors->has('barr_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('barr_doce') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Correo electrónico</label>
			   		<input type="email" name="corr_doce" class="form-control {{ $errors->has('corr_doce') ? 'is-invalid' : '' }}" value="{{ old('corr_doce') }}" required autofocus>
	                @if ($errors->has('corr_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('corr_doce') }}
	                    </div>
	               	@endif
			 	</div>
			</div>
			<div class="form-row">
			  	<div class="form-group col-md-2">
			    	<label>Teléfono</label>
			   		<input type="number" name="tele_doce" class="form-control {{ $errors->has('tele_doce') ? 'is-invalid' : '' }}" value="{{ old('tele_doce') }}" autofocus>
	                @if ($errors->has('tele_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tele_doce') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Titulo profesional</label>
			   		<input type="text" name="titu_doce" class="form-control {{ $errors->has('titu_doce') ? 'is-invalid' : '' }}" value="{{ old('titu_doce') }}" required autofocus>
	                @if ($errors->has('titu_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('titu_doce') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-7">
			    	<label>Especializaciones</label>
			    	<input type="text" name="espe_doce" class="form-control {{ $errors->has('espe_doce') ? 'is-invalid' : '' }}" value="{{ old('espe_doce') }}" autofocus>
	                @if ($errors->has('espe_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('espe_doce') }}
	                    </div>
	               	@endif
			  	</div>
			</div>
			<div class="form-row">
			  	<div class="form-group col-md-12">
			    	<label>Experiencia laboral</label>
			    	<textarea name="expe_doce" rows="3" class="form-control {{ $errors->has('expe_doce') ? 'is-invalid' : '' }}" autofocus>{{ old('expe_doce') }}</textarea>
	                @if ($errors->has('expe_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('expe_doce') }}
	                    </div>
	               	@endif
			  	</div>
			</div>
			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Observaciones</label>
		    		<textarea name="obse_doce" rows="3" class="form-control {{ $errors->has('obse_doce') ? 'is-invalid' : '' }}" autofocus>{{ old('obse_doce') }}</textarea>
	                @if ($errors->has('obse_doce'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('obse_doce') }}
	                    </div>
	               	@endif
		  		</div>
			</div>

			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Información del empleado</p>
			  <hr class="w-100">
			</blockquote>

			<div class="form-row">
				<div class="form-group col-md-2">
			    	<label>Fecha de ingreso</label>
			    	<input type="text" name="fech_ingr" class="datepicker form-control {{ $errors->has('fech_ingr') ? 'is-invalid' : '' }}" value="{{ old('fech_ingr') }}" required autofocus>
	                @if ($errors->has('fech_ingr'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_ingr') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
				    <label>Tipo de empleado</label>
				    <select name="tipo_empleado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_empleado_id') ? 'is-invalid' : '' }}"  data-live-search="true" data-live-search-placeholder="Búscar ..."required autofocus>
				    	@empty(old('tipo_empleado_id'))
	                        <option value="">··· Seleccione ···</option>
	                    @endempty
				      	@foreach($tipoEmpleados as $tipo)
				      		<option value="{{ $tipo->id }}"
				      			@if (old('tipo_empleado_id') === $tipo->id){{ 'selected' }}@endif>
				      			{{ $tipo->nomb_tipo }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('tipo_empleado_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tipo_empleado_id') }}
	                    </div>
	               	@endif
		 		</div>
			  	<div class="form-group col-md-6">
		    		<label>Observaciones</label>
		    		<textarea name="obse_empl" rows="3" class="form-control {{ $errors->has('obse_empl') ? 'is-invalid' : '' }}" autofocus>{{ old('obse_empl') }}</textarea>
	                @if ($errors->has('obse_empl'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('obse_empl') }}
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



