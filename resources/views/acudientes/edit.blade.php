@extends('layouts.app')
@section('title', 'Editar acudiente')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('acudientes.index') }}">Acudientes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('acudientes.edit',$acudiente->id ) }}">Editar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Editar acudiente
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('acudientes.update', $acudiente->id) }}" autocomplete="off">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-row">
			  	<div class="form-group col-md-3">
				    <label>Tipo de documento</label>
				    <select name="tipo_docu" class="selectpicker dropdown-dense show-tick selectbox form-control  {{ $errors->has('tipo_docu') ? 'is-invalid' : '' }}" required autofocus>
				    	<option value="{{ $acudiente->tipo_docu }}" selected>
	                    	{{ $acudiente->tipo_docu }}
	                    </option>
		                @foreach(Documento::acudiente() as $tipo)
				      		<option value="{{ $tipo }}"
				      		@if (old('tipo_doce') === $tipo){{ 'selected' }}@endif>
				      			{{ $tipo }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('tipo_docu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tipo_docu') }}
	                    </div>
	               	@endif
		 		</div>
				<div class="form-group col-md-3">
			    	<label>No. Identificación</label>
			   		 <input type="number" name="docu_acud" class="form-control {{ $errors->has('docu_acud') ? 'is-invalid' : '' }}" value="{{ old('docu_acud', $acudiente->docu_acud) }}" required autofocus>
	                @if ($errors->has('docu_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('docu_acud') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Nombres</label>
			   		 <input type="text" name="nomb_acud" class="form-control {{ $errors->has('nomb_acud') ? 'is-invalid' : '' }}" value="{{ old('nomb_acud', $acudiente->nomb_acud) }}" required autofocus>
	                @if ($errors->has('nomb_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_acud') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Primer apellido</label>
			   		 <input type="text" name="pape_acud" class="form-control {{ $errors->has('pape_acud') ? 'is-invalid' : '' }}" value="{{ old('pape_acud', $acudiente->pape_acud) }}" required autofocus>
	                @if ($errors->has('pape_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('pape_acud') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-3">
			    	<label>Segundo apellido</label>
			   		 <input type="text" name="sape_acud" class="form-control {{ $errors->has('sape_acud') ? 'is-invalid' : '' }}" value="{{ old('sape_acud', $acudiente->sape_acud) }}" autofocus>
	                @if ($errors->has('sape_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sape_acud') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
				    <label>Sexo</label>
				    <select name="sexo_acud" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sexo_acud') ? 'is-invalid' : '' }}" required autofocus>
	                    <option value="{{ $acudiente->sexo_acud }}" selected>
	                    	{{ $acudiente->getSexo() }}
	                    </option>
				    	@foreach(Sexo::asociativos() as $sexo)
				      		<option value="{{ $sexo['id'] }}"
				      		@if (old('sexo_acud') === $sexo['id']){{ 'selected' }}@endif>
				      			{{ $sexo['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('sexo_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sexo_acud') }}
	                    </div>
	               	@endif
		 		</div>
		 		<div class="form-group col-md-3">
			    	<label>Dirección de residencia</label>
			   		 <input type="text" name="dire_acud" class="form-control {{ $errors->has('dire_acud') ? 'is-invalid' : '' }}" value="{{ old('dire_acud', $acudiente->dire_acud) }}" required autofocus>
	                @if ($errors->has('dire_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('dire_acud') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Barrio de residencia</label>
			   		 <input type="text" name="barr_acud" class="form-control {{ $errors->has('barr_acud') ? 'is-invalid' : '' }}" value="{{ old('barr_acud', $acudiente->barr_acud) }}" required autofocus>
	                @if ($errors->has('barr_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('barr_acud') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-3">
			    	<label>Correo electrónico</label>
			   		 <input type="text" name="corr_acud" class="form-control {{ $errors->has('corr_acud') ? 'is-invalid' : '' }}" value="{{ old('corr_acud', $acudiente->corr_acud) }}" required autofocus>
	                @if ($errors->has('corr_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('corr_acud') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Teléfono</label>
			   		 <input type="number" name="tele_acud" class="form-control {{ $errors->has('tele_acud') ? 'is-invalid' : '' }}" value="{{ old('tele_acud', $acudiente->tele_acud) }}" required autofocus>
	                @if ($errors->has('tele_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tele_acud') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-6">
			    	<label>Profesión</label>
			   		 <input type="text" name="prof_acud" class="form-control {{ $errors->has('prof_acud') ? 'is-invalid' : '' }}" value="{{ old('prof_acud', $acudiente->prof_acud) }}" required autofocus>
	                @if ($errors->has('prof_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('prof_acud') }}
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