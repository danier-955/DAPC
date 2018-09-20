@extends('layouts.app')
@section('title', 'Sub grados')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
		<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
		<li class="breadcrumb-item"><a href="{{ route('subgrados.index') }}">Sub grados</a></li>
		<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header">
	  		<h1 class="typography-headline">
	  			<i class="material-icons mr-1">school</i> Registrar sub grado
	  		</h1>
	  	</div>
		<div class="card-body">

			<form  method="post" action="{{ route('subgrados.store') }}" autocomplete="off">
				{{ csrf_field() }}

				<div class="form-row">
					<div class="form-group col-md-3">
				    	<label>letra del sub grado</label>
				   		<input type="text" name="abre_subg" class="form-control {{ $errors->has('abre_subg') ? 'is-invalid' : '' }}" value="" required autofocus>
		                @if ($errors->has('abre_subg'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('abre_subg') }}
		                    </div>
		               	@endif
			  		</div>
			  		<div class="form-group col-md-3">
				    	<label>cantidad de estudiantes</label>
				   		 <input type="number" name="cant_estu" class="form-control {{ $errors->has('cant_estu') ? 'is-invalid' : '' }}" value="{{ old('cant_estu') }}" required autofocus>
		                @if ($errors->has('cant_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('cant_estu') }}
		                    </div>
		               	@endif
			  		</div>
		 			<div class="form-group col-md-3">
					    <label>Grado de origen:</label>
					    <select name="grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('grado_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..."  required autofocus>
					    	@empty(old('grado_id'))
		                        <option value="">··· Seleccione ···</option>
		                    @endempty
					      	@foreach($grados as $grado)
								<option value="{{ $grado->id }}">
				      				{{ $grado->abre_grad }} &middot; Jornada {{ $grado->getJornada() }}
				      			</option>
					      	@endforeach
					    </select>
		                @if ($errors->has('grado_id'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('grado_id') }}
		                    </div>
		               	@endif
			 		</div>
			 		<div class="form-group col-md-3">
					    <label>Docente</label>
					    <select name="docente_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('docente_id') ? 'is-invalid' : '' }}"  data-live-search="true" data-live-search-placeholder="Búscar ..."  autofocus>
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