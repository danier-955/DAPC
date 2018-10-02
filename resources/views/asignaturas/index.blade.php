@extends('layouts.app')
@section('title', 'Asignaturas')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('asignaturas.index') }}">Asignaturas</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">book</i> Asignaturas
			</h1>
			@can('asignaturas.create')
				@include('partials.button_create', ['route' => route('asignaturas.create')])
			@endcan
		</div>
		<div class="card-body">

			<form method="GET" action="{{ route('asignaturas.index') }}" autocomplete="off">
				<div class="row clearfix">
					<div class="col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nomb_asig"
								class="form-control {{ $errors->has('nomb_asig') ? 'is-invalid' : '' }}"
								value="{{ old('nomb_asig') ? old('nomb_asig') : Request::get('nomb_asig') }}">
			                @if ($errors->has('nomb_asig'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('nomb_asig') }}
			                    </div>
			               	@endif
						</div>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
				    		<label>Area</label>
			    			<select name="area_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('area_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..."  autofocus>
			    				<option value="">··· Seleccione ···</option>
			      				@foreach($areas as $area)
			      					<option value="{{ $area->id }}"
			      						@if (old('area_id', Request::get('area_id')) === $area->id){{ 'selected' }}@endif>
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
	 				</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
				    		<label>Grado</label>
			    			<select name="grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('grado_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..."  autofocus>
			    				<option value="">··· Seleccione ···</option>
			      				@foreach($grados as $grado)
			      					<option value="{{ $grado->id }}"
			      						@if (old('grado_id', Request::get('grado_id')) === $grado->id){{ 'selected' }}@endif>
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
				</div>
				<div class="row clearfix">
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="form-group text-center py-2">
							<button type="submit" class="btn btn-secondary">Búscar</button>
						</div>
					</div>
	        	</div>
	        </form>
  			<hr class="mt-0 w-100">

	  		@if ($asignaturas->isNotEmpty())
				<div class="table-responsive">
					<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
						<thead>
							<tr>
								<th>#</th>
				                <th>Nombre</th>
								<th>Grado</th>
				                <th>Docente</th>
				                <th class="text-nowrap text-center">Opción</th>
							</tr>
						</thead>
						<tbody>
							@foreach($asignaturas as $asignatura)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $asignatura->nomb_asig }}</td>
									<td>{{ $asignatura->getGrado() }}</td>
									<td>{{ $asignatura->getDocente() }}</td>
									<td class="text-nowrap text-center">
										@can('asignaturas.fechas.index')
											@include('partials.button_date', ['btnSm' => 'btn-sm', 'route' => route('asignaturas.fechas.index', $asignatura->id)])
										@endcan
										@can('asignaturas.show')
											@include('partials.button_show', ['route' => route('asignaturas.show', $asignatura->id)])
										@endcan
										@can('asignaturas.edit')
											@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('asignaturas.edit', $asignatura->id)])
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				@component('partials.alert_empty')
					No hay asignaturas registradas.
				@endcomponent
			@endif
		</div>
		@if ($asignaturas->hasPages())
		  	<hr class="my-0 w-100">
		  	<div class="card-actions align-items-center justify-content-center px-3">
		    	{{ $asignaturas->appends(request()->query())->links() }}
		  	</div>
	  	@endif
	</div>
@endsection()