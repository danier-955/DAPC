@extends('layouts.app')
@section('title', 'Editar administrativo')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('administrativos.index') }}">Administrativos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('administrativos.edit', $administrativo->id) }}">Editar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">people_outline</i> Editar administrativo
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('administrativos.update', $administrativo->id) }}" autocomplete="off">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Información del administrativo</p>
			  <hr class="w-100">
			</blockquote>

			<div class="form-row">
			  	<div class="form-group col-md-3">
			    	<label>No. Identificación</label>
			   		 <input type="number" name="docu_admi" class="form-control {{ $errors->has('docu_admi') ? 'is-invalid' : '' }}" value="{{ old('docu_admi', $administrativo->docu_admi) }}" required autofocus>
	                @if ($errors->has('docu_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('docu_admi') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Nombres</label>
			   		<input type="text" name="nomb_admi" class="form-control {{ $errors->has('nomb_admi') ? 'is-invalid' : '' }}" value="{{ old('nomb_admi', $administrativo->nomb_admi) }}" required autofocus>
	                @if ($errors->has('nomb_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_admi') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Primer apellido</label>
			   		<input type="text" name="pape_admi" class="form-control {{ $errors->has('pape_admi') ? 'is-invalid' : '' }}" value="{{ old('pape_admi', $administrativo->pape_admi) }}" required autofocus>
	                @if ($errors->has('pape_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('pape_admi') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Segundo apellido</label>
			   		<input type="text" name="sape_admi" class="form-control {{ $errors->has('sape_admi') ? 'is-invalid' : '' }}" value="{{ old('sape_admi', $administrativo->sape_admi) }}" autofocus>
	                @if ($errors->has('sape_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sape_admi') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-3">
				    <label>Sexo</label>
				    <select name="sexo_admi" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sexo_admi') ? 'is-invalid' : '' }}" required autofocus>
				    	@empty(old('sexo_admi'))
		                    <option value="{{ $administrativo->sexo_admi }}" selected>
		                    	{{ $administrativo->getSexo() }}
		                    </option>
		                @endempty
				    	@foreach(Sexo::asociativos() as $sexo)
				      		<option value="{{ $sexo['id'] }}"
				      		@if (old('sexo_admi') === $sexo['id']){{ 'selected' }}@endif>
				      			{{ $sexo['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('sexo_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sexo_admi') }}
	                    </div>
	               	@endif
		 		</div>
			  	<div class="form-group col-md-3">
			    	<label>Dirección de residencia</label>
			   		<input type="text" name="dire_admi" class="form-control {{ $errors->has('dire_admi') ? 'is-invalid' : '' }}" value="{{ old('dire_admi', $administrativo->dire_admi) }}" required autofocus>
	                @if ($errors->has('dire_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('dire_admi') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Barrio de residencia</label>
			   		<input type="text" name="barr_admi" class="form-control {{ $errors->has('barr_admi') ? 'is-invalid' : '' }}" value="{{ old('barr_admi', $administrativo->barr_admi) }}" autofocus>
	                @if ($errors->has('barr_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('barr_admi') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Correo electrónico</label>
			   		<input type="email" name="corr_admi" class="form-control {{ $errors->has('corr_admi') ? 'is-invalid' : '' }}" value="{{ old('corr_admi', $administrativo->corr_admi) }}" required autofocus>
	                @if ($errors->has('corr_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('corr_admi') }}
	                    </div>
	               	@endif
			 	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-2">
			    	<label>Teléfono</label>
			   		<input type="number" name="tele_admi" class="form-control {{ $errors->has('tele_admi') ? 'is-invalid' : '' }}" value="{{ old('tele_admi', $administrativo->tele_admi) }}" autofocus>
	                @if ($errors->has('tele_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tele_admi') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
					<label>Cargo</label>
					<select name="carg_admi" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('carg_admi') ? 'is-invalid' : '' }}" required autofocus>
				    	<option value="{{ $administrativo->carg_admi }}" selected>
	                    	{{ $administrativo->getCargo() }}
	                    </option>
	                    @if ($administrativo->puedeCambiarCargoJornada())
					    	@foreach(Cargo::asociativos() as $cargo)
					      		<option value="{{ $cargo['id'] }}"
					      		@if (old('carg_admi', $administrativo->carg_admi) === $cargo['id']){{ 'selected' }}@endif>
					      			{{ $cargo['texto'] }}
					      		</option>
					      	@endforeach
					    @endif
				    </select>
	                @if ($errors->has('carg_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('carg_admi') }}
	                    </div>
	               	@endif
				</div>
				<div class="form-group col-md-2">
					<label>Jornada</label>
				    <select name="jorn_admi" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('jorn_admi') ? 'is-invalid' : '' }}" required autofocus>
				    	<option value="{{ $administrativo->jorn_admi }}" selected>
	                    	{{ $administrativo->getJornada() }}
	                    </option>
		                @if ($administrativo->puedeCambiarCargoJornada())
					    	@foreach(Jornada::adminAsociativos() as $jornada)
					      		<option value="{{ $jornada['id'] }}"
					      		@if (old('jorn_admi', $administrativo->jorn_admi) === $jornada['id']){{ 'selected' }}@endif>
					      			{{ $jornada['texto'] }}
					      		</option>
					      	@endforeach
					    @endif
				    </select>
	                @if ($errors->has('jorn_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('jorn_admi') }}
	                    </div>
	               	@endif
				</div>
			  	<div class="form-group col-md-5">
			    	<label>Titulo profesional</label>
			   		<input type="text" name="titu_admi" class="form-control {{ $errors->has('titu_admi') ? 'is-invalid' : '' }}" value="{{ old('titu_admi', $administrativo->titu_admi) }}" required autofocus>
	                @if ($errors->has('titu_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('titu_admi') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-12">
			    	<label>Especializaciones</label>
			    	<input type="text" name="espe_admi" class="form-control {{ $errors->has('espe_admi') ? 'is-invalid' : '' }}" value="{{ old('espe_admi', $administrativo->espe_admi) }}" autofocus>
	                @if ($errors->has('espe_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('espe_admi') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
			    	<label>Experiencia laboral</label>
			    	<textarea name="expe_admi" rows="3" class="form-control {{ $errors->has('expe_admi') ? 'is-invalid' : '' }}" autofocus>{{ old('expe_admi', $administrativo->expe_admi) }}</textarea>
	                @if ($errors->has('expe_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('expe_admi') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Observaciones</label>
		    		<textarea name="obse_admi" rows="3" class="form-control {{ $errors->has('obse_admi') ? 'is-invalid' : '' }}" autofocus>{{ old('obse_admi', $administrativo->obse_admi) }}</textarea>
	                @if ($errors->has('obse_admi'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('obse_admi') }}
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
			    	<input type="text" name="fech_ingr" class="datepicker form-control {{ $errors->has('fech_ingr') ? 'is-invalid' : '' }}" value="{{ old('fech_ingr', optional($administrativo->empleado->fech_ingr)->format('Y-m-d')) }}" required autofocus>
	                @if ($errors->has('fech_ingr'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_ingr') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
				    <label>Tipo de empleado</label>
				    <select name="tipo_empleado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_empleado_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
				    	@empty(old('tipo_empleado_id'))
		                    <option value="{{ optional($administrativo->empleado)->tipo_empleado_id }}" selected>
		                    	{{ optional($administrativo->empleado->tipoEmpleado)->nomb_tipo }}
		                    </option>
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
		    		<textarea name="obse_empl" rows="3" class="form-control {{ $errors->has('obse_empl') ? 'is-invalid' : '' }}" autofocus>{{ old('obse_empl', optional($administrativo->empleado)->obse_empl) }}</textarea>
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
			  		<button type="submit" class="btn btn-primary">Actualizar</button>
			  	</div>
			</div>

		</form>
	</div>
</div>
@endsection