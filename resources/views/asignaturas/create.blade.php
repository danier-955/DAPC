@extends('layouts.app')
@section('title', 'Registrar asignatura')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.index') }}">Asignaturas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.create') }}">Registrar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">book</i> Registrar asignatura
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('asignaturas.store') }}" autocomplete="off">
			{{ csrf_field() }}

			<div class="form-row">
				<div class="form-group col-md-6">
			    	<label>Nombre</label>
			   		 <input type="text" name="nomb_asig" class="form-control {{ $errors->has('nomb_asig') ? 'is-invalid' : '' }}" value="{{ old('nomb_asig') }}" required autofocus>
	                @if ($errors->has('nomb_asig'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_asig') }}
	                    </div>
	               	@endif
		  		</div>
		  		<div class="form-group col-md-2">
			    	<label>Peso (%)</label>
			   		 <input type="number" name="peso_asig" class="form-control {{ $errors->has('peso_asig') ? 'is-invalid' : '' }}" value="{{ old('peso_asig') }}" required autofocus>
	                @if ($errors->has('peso_asig'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('peso_asig') }}
	                    </div>
	               	@endif
		  		</div>
		  		<div class="form-group col-md-4">
				    <label>Grado</label>
				    <select name="grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('grado_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
				    	@empty(old('grado_id'))
	                        <option value="">··· Seleccione ···</option>
	                    @endempty
				      	@foreach($grados as $grado)
						 	<option value="{{ $grado->id }}"
			      				@if (old('grado_id') === $grado->id){{ 'selected' }}@endif>
			      				{{ "{$grado->abre_grad} &middot; Jornada {$grado->getJornada()}" }}
			      			</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('grado_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('grado_id') }}
	                    </div>
	               	@endif
		 		</div>
		  	</div>

			<div class="form-row">
				<div class="form-group col-md-6">
		    		<label>Area</label>
	    			<select name="area_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('area_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
	    				@empty(old('area_id'))
	    				    <option value="">··· Seleccione ···</option>
	    				@endempty
	      				@foreach($areas as $area)
	      					<option value="{{ $area->id }}"
	      						@if (old('area_id') === $area->id){{ 'selected' }}@endif>
	      						{{ $area->nomb_area }}
	      					</option>
	      				@endforeach
	    			</select>
	                @if ($errors->has('area_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('area_id') }}
	                    </div>
	               	@endif
 				</div>
		  		<div class="form-group col-md-6">
		    		<label>Docente</label>
	    			<select name="docente_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('docente_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
	    				@empty(old('docente_id'))
	    				    <option value="">··· Seleccione ···</option>
	    				@endempty
	      				@foreach($docentes->chunk(15) as $chunk)
		      				@foreach($chunk as $docente)
		      					<option value="{{ $docente->id }}"
		      						@if (old('docente_id') === $docente->id){{ 'selected' }}@endif>
		      						{{ "{$docente->nomb_doce} {$docente->pape_doce} {$docente->sape_doce}" }}
		      					</option>
		      				@endforeach
	      				@endforeach
	    			</select>
	                @if ($errors->has('docente_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('docente_id') }}
	                    </div>
	               	@endif
				</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Logros primer periodo</label>
		    		<textarea name="log1_asig" rows="5" class="form-control {{ $errors->has('log1_asig') ? 'is-invalid' : '' }}" autofocus>{{ old('log1_asig') }}</textarea>
	                @if ($errors->has('log1_asig'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('log1_asig') }}
	                    </div>
	               	@endif
		  		</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Logros segundo periodo</label>
		    		<textarea name="log2_asig" rows="5" class="form-control {{ $errors->has('log2_asig') ? 'is-invalid' : '' }}" autofocus>{{ old('log2_asig') }}</textarea>
	                @if ($errors->has('log2_asig'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('log1_asig') }}
	                    </div>
	               	@endif
		  		</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Logros tercer periodo</label>
		    		<textarea name="log3_asig" rows="5" class="form-control {{ $errors->has('log3_asig') ? 'is-invalid' : '' }}" autofocus>{{ old('log3_asig') }}</textarea>
	                @if ($errors->has('log3_asig'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('log3_asig') }}
	                    </div>
	               	@endif
		  		</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Logros cuarto periodo</label>
		    		<textarea name="log4_asig" rows="5" class="form-control {{ $errors->has('log4_asig') ? 'is-invalid' : '' }}" autofocus>{{ old('log4_asig') }}</textarea>
	                @if ($errors->has('log4_asig'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('log4_asig') }}
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