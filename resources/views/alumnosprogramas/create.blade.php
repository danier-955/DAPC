@extends('layouts.app')
@section('title', 'Registrar Programas')

@section('content')
	<nav aria-label="breadcrumb">
	  	<ol class="breadcrumb bg-white shadow-1">
		    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
		    <li class="breadcrumb-item"><a href="">Programa de Formacion</a></li>
		    <li class="breadcrumb-item"><a href="{{ route('alumnosprogramas.create') }}">Registrar</a></li>
	    	<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  	</ol>
	</nav>

	<div class="card">
		<div class="card-header">
	  		<h1 class="typography-headline">
	  			<i class="material-icons mr-1">rate_review</i> Registrar Programas
	  		</h1>
	  	</div>
		<div class="card-body">

			<form id="storeProgramas" autocomplete="off">
				{{ csrf_field() }}
				
				<div class="form-row">
					<div class="form-group col-md-6">
					    <label>Alumno</label>
					    <select name="alumno_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('alumno_id') ? 'is-invalid' : '' }}"  data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
					    	<option value="">··· Seleccione ···</option>
				                @foreach($alumnos as $alumno)
				                  	<option value="{{ $alumno->id }}">
				                    	{{ $alumno->nomb_alum }}
				                  	</option>
			        			@endforeach
					    </select>
			            <div id="error_alumno_id"></div>
					</div>

					<div class="form-group col-md-6">
					    <label>Programas de Formacion</label>
					    <select name="programa_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('programa_id') ? 'is-invalid' : '' }}"  data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
					    	<option value="">··· Seleccione ···</option>
				                @foreach($programas as $programa)
				                  	<option value="{{ $programa->id }}">
				                    	{{ $programa->nomb_prog }}
				                  	</option>
			        			@endforeach
					    </select>
			            <div id="error_programa_id"></div>
					</div>
				</div>

				<div class="row clearfix">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="form-group text-center py-2">
							<button type="reset" class="btn btn-secondary">Limpiar</button>
				  			<button type="submit" class="btn btn-primary">Registrar</button>
							<span class="loading mx-3" style="display: none;">
								<i class="fas fa-sync fa-spin fa-2x align-middle"></i>
							</span>
						</div>
					</div>
				</div>
			</form>

			<hr class="mt-0 w-100">

			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Estudiante</th>
							<th>Programa</th>
							<th>Opción</th>
						</tr>
					</thead>
					<tbody id="indexProgramas"></tbody>
				</table>
			</div>
		</div>
	</div>
@endsection()

@push('scripts')
	@mix('js/alumnoprograma.js')
@endpush
