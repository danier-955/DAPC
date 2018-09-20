@extends('layouts.app')
@section('title', 'Registrar practicante')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('practicantes.index') }}">Practicantes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('practicantes.create') }}">Registrar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Registrar practicante
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('practicantes.store') }}" autocomplete="off">
			{{ csrf_field() }}

			<div class="form-row">
				<div class="form-group col-md-3">
		    		<label >Tipo de documento</label>
	    			<select name="tipo_docu" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_docu') ? 'is-invalid' : '' }}" required autofocus>
	    				@empty(old('tipo_docu'))
	    				    <option value="">··· Seleccione ···</option>
	    				@endempty
	      				@foreach(Documento::tipos() as $tipo)
	      					<option value="{{ $tipo }}">{{ $tipo }}</option>
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
			   		 <input type="number" name="docu_prac" class="form-control {{ $errors->has('docu_prac') ? 'is-invalid' : '' }}" value="{{ old('docu_prac') }}" required autofocus>
			   		@if ($errors->has('docu_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('docu_prac') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Nombres</label>
			   		<input type="text" name="nomb_prac" class="form-control {{ $errors->has('nomb_prac') ? 'is-invalid' : '' }}" value="{{ old('nomb_prac') }}" required autofocus>
			   		@if ($errors->has('nomb_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_prac') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Primer apellido</label>
			   		 <input type="text" name="pape_prac" class="form-control {{ $errors->has('pape_prac') ? 'is-invalid' : '' }}" value="{{ old('pape_prac') }}" required autofocus>
			   		@if ($errors->has('pape_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('pape_prac') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-3">
			    	<label>Segundo apellido</label>
			   		 <input type="text" name="sape_prac" class="form-control {{ $errors->has('sape_prac') ? 'is-invalid' : '' }}" value="{{ old('sape_prac') }}"  autofocus>
			   		 @if ($errors->has('sape_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sape_prac') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
				    <label>Sexo</label>
				    <select name="sexo_prac" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sexo_prac') ? 'is-invalid' : '' }}" required autofocus>
				    	@empty(old('sexo_prac'))
		                    <option value="">··· Seleccione ···</option>
		                @endempty
				    	@foreach(Sexo::asociativos() as $sexo)
				      		<option value="{{ $sexo['id'] }}"
				      			@if (old('sexo_prac') === $sexo['id']){{ 'selected' }}@endif>
				      			{{ $sexo['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('sexo_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sexo_prac') }}
	                    </div>
	               	@endif
		 		</div>
			  	<div class="form-group col-md-3">
			    	<label>Dirección de residencia</label>
			   		<input type="text" name="dire_prac" class="form-control {{ $errors->has('dire_prac') ? 'is-invalid' : '' }}" value="{{ old('dire_prac') }}" required autofocus>
	                @if ($errors->has('dire_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('dire_prac') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Barrio de residencia</label>
			   		<input type="text" name="barr_prac" class="form-control {{ $errors->has('barr_prac') ? 'is-invalid' : '' }}" value="{{ old('barr_prac') }}" autofocus>
	                @if ($errors->has('barr_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('barr_prac') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-3">
			    	<label>Correo electrónico</label>
			   		<input type="email" name="corr_prac" class="form-control {{ $errors->has('corr_prac') ? 'is-invalid' : '' }}" value="{{ old('corr_prac') }}" required autofocus>
	                @if ($errors->has('corr_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('corr_prac') }}
	                    </div>
	               	@endif
			 	</div>
			 	<div class="form-group col-md-3">
			    	<label>Teléfono</label>
			   		<input type="number" name="tele_prac" class="form-control {{ $errors->has('tele_prac') ? 'is-invalid' : '' }}" value="{{ old('tele_prac') }}" autofocus>
	                @if ($errors->has('tele_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tele_prac') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Nombre del padre</label>
			   		<input type="text" name="padr_prac" class="form-control {{ $errors->has('padr_prac') ? 'is-invalid' : '' }}" value="{{ old('padr_prac') }}" autofocus>
	                @if ($errors->has('padr_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('padr_prac') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Nombre de la madre</label>
			   		<input type="text" name="madr_prac" class="form-control {{ $errors->has('madr_prac') ? 'is-invalid' : '' }}" value="{{ old('madr_prac') }}" autofocus>
	                @if ($errors->has('madr_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('madr_prac') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-4">
			    	<label>Instituto de procedencia</label>
			   		<input type="text" name="cole_prov" class="form-control {{ $errors->has('cole_prov') ? 'is-invalid' : '' }}" value="{{ old('cole_prov') }}" required autofocus>
	                @if ($errors->has('cole_prov'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('cole_prov') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-4">
			    	<label>Semestre cursante</label>
			   		<input type="text" name="seme_curs" class="form-control {{ $errors->has('seme_curs') ? 'is-invalid' : '' }}" value="{{ old('seme_curs') }}" required autofocus>
	                @if ($errors->has('seme_curs'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('seme_curs') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-4">
			    	<label>Número de horas</label>
			   		<input type="number" name="hora_paga" class="form-control {{ $errors->has('hora_paga') ? 'is-invalid' : '' }}" value="{{ old('hora_paga') }}" required autofocus>
	                @if ($errors->has('hora_paga'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('hora_paga') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-4">
			    	<label>Fecha de inicio practicas</label>
			    	<input type="text" name="inic_prac" class="datepicker form-control {{ $errors->has('inic_prac') ? 'is-invalid' : '' }}" value="{{ old('inic_prac') }}" required autofocus>
	                @if ($errors->has('inic_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('inic_prac') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
			    	<label>Fecha final practicas</label>
			    	<input type="text" name="fina_prac" class="datepicker form-control {{ $errors->has('fina_prac') ? 'is-invalid' : '' }}" value="{{ old('fina_prac') }}" required autofocus>
	                @if ($errors->has('fina_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fina_prac') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-4">
				    <label>Grado asignado</label>
				    <select name="sub_grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sub_grado_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
				    	@empty(old('sub_grado_id'))
	                        <option value="">··· Seleccione ···</option>
	                    @endempty
				      	@foreach($grados as $grado)
							@foreach($grado->subGrados as $subGrado)
							 	<option value="{{ $subGrado->id }}"
				      				@if (old('sub_grado_id') === $subGrado->id){{ 'selected' }}@endif>
				      					{{ $grado->abre_grad }} &middot; {{ $subGrado->abre_subg }} &middot; Jornada {{ $grado->getJornada() }}
				      			</option>
				      		@endforeach
				      	@endforeach
				    </select>
	                @if ($errors->has('sub_grado_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sub_grado_id') }}
	                    </div>
	               	@endif
		 		</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Observaciones</label>
		    		<textarea name="obse_prac" rows="3" class="form-control {{ $errors->has('obse_prac') ? 'is-invalid' : '' }}" autofocus>{{ old('obse_prac') }}</textarea>
	                @if ($errors->has('obse_prac'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('obse_prac') }}
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



