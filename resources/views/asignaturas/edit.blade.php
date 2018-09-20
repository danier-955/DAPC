@extends('layouts.app')
@section('title', 'Editar asignatura')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('asignaturas.index') }}">Asignatura</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('asignaturas.edit', $asignatura->id) }}">Editar</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>

	<div class="card">
		<div class="card-header">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">book</i> Editar Asignatura
			</h1>
		</div>

		<div class="card-body">
			<form method="post" action="{{ route('asignaturas.update', $asignatura->id) }}" autocomplete="off" >
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				<div class="form-row">
					<div class="form-group col-md-4">
			    		<label>Area</label>
		    			<select name="area_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('area_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
		    				@empty(old('area_id'))
		    				    <option value="{{ $asignatura->area_id }}" selected>
		    				    	{{ $asignatura->getArea() }}
		    				    </option>
		    				@endempty
		      
			      				@foreach($areas as $area)
			      					<option value="{{ $area->id }}"
			      						@if (old('area_id', $asignatura->area_id) === $area->id){{ 'selected' }}@endif>
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

					<div class="form-group col-md-4">
				    	<label>Nombre Asignatura</label>
				   		<input type="text" name="nomb_asig" class="form-control {{ $errors->has('nomb_asig') ? 'is-invalid' : '' }}" value="{{ old('nomb_asig', $asignatura->nomb_asig) }}"  autofocus>
		                @if ($errors->has('nomb_asig'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_asig') }}
		                    </div>
		               	@endif
				  	</div>

				  	<div class="form-group col-md-4">
				    	<label>Calificacion</label>
				   		<input type="number" name="peso_asig" class="form-control {{ $errors->has('peso_asig') ? 'is-invalid' : '' }}" value="{{ old('peso_asig', $asignatura->peso_asig) }}"  autofocus>
		                @if ($errors->has('peso_asig'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('peso_asig') }}
		                    </div>
		               	@endif
				  	</div>

				  	<div class="form-group col-md-6">
			    		<label>Docente</label>
		    			<select name="docente_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('docente_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
		    				@empty(old('docente_id'))
		    				    <option value="{{ $asignatura->docente_id }}" selected>
		    				    	{{ $asignatura->getDocente() }}
		    				    </option>
		    				@endempty
		      
			      				@foreach($docentes as $docente)
			      					<option value="{{ $docente->id }}"
			      						@if (old('docente_id', $asignatura->docente_id) === $docente->id){{ 'selected' }}@endif>
			      						{{ $docente->nomb_doce }}
			      					</option>
			      				@endforeach
		    			</select>
		                @if ($errors->has('docente_id'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('docente_id') }}
		                    </div>
		               	@endif
	 				</div>

	 				<div class="form-group col-md-6">
			    		<label>Grado</label>
		    			<select name="grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('grado_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
		    				@empty(old('grado_id'))
		    				    <option value="{{ $asignatura->grado_id }}" selected>
		    				    	{{ $asignatura->getGrado() }}
		    				    </option>
		    				@endempty
		      
			      				@foreach($docentes as $docente)
			      					<option value="{{ $docente->id }}"
			      						@if (old('grado_id', $asignatura->grado_id) === $docente->id){{ 'selected' }}@endif>
			      						{{ $docente->nomb_grad }}
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
			 		<div class="form-group col-md-12">
				    	<label>Logros 1er perido</label>
				    	<textarea name="log1_asig" rows="3" class="form-control {{ $errors->has('log1_asig') ? 'is-invalid' : '' }}" autofocus>{{ old('log1_asig', $asignatura->log1_asig) }}
			    		</textarea>
		                @if ($errors->has('log1_asig'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('log1_asig') }}
		                    </div>
		               	@endif
				  	</div>
				</div>
				
				<div class="form-row">
			 		<div class="form-group col-md-12">
				    	<label>Logros 2do perido</label>
				    	<textarea name="log2_asig" rows="3" class="form-control {{ $errors->has('log2_asig') ? 'is-invalid' : '' }}" autofocus>{{ old('log2_asig', $asignatura->log2_asig) }}
			    		</textarea>
		                @if ($errors->has('log2_asig'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('log2_asig') }}
		                    </div>
		               	@endif
				  	</div>
				</div>

				<div class="form-row">
			 		<div class="form-group col-md-12">
				    	<label>Logros 3er perido</label>
				    	<textarea name="log3_asig" rows="3" class="form-control {{ $errors->has('log3_asig') ? 'is-invalid' : '' }}" autofocus>{{ old('log3_asig', $asignatura->log3_asig) }}
			    		</textarea>
		                @if ($errors->has('log3_asig'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('log3_asig') }}
		                    </div>
		               	@endif
				  	</div>
				</div>

				<div class="form-row">
			 		<div class="form-group col-md-12">
				    	<label>Logros 4to perido</label>
				    	<textarea name="log4_asig" rows="3" class="form-control {{ $errors->has('log4_asig') ? 'is-invalid' : '' }}" autofocus>{{ old('log4_asig', $asignatura->log4_asig) }}
			    		</textarea>
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
				  		<button type="submit" class="btn btn-primary">Actualizar</button>
				  	</div>
				</div>	

			</form>
		</div>
	</div>
@endsection()