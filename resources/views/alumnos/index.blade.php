@extends('layouts.app')
@section('title', 'Alumnos')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Alumnos</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">assignment_ind</i> Alumnos
			</h1>
			@can('planeamientos.create')
	        	@include('partials.button_create', ['route' => route('alumnos.create')])
			@endcan
		</div>
		<div class="card-body">
			@if (Auth::user()->alumno())
				<form method="GET" action="{{ route('alumnos.index') }}" autocomplete="off">
					<div class="row clearfix">
		            	<div class="col-sm-12 col-md-3 col-lg-3  offset-2">
							<div class="form-group">
								<label>No. Identificación</label>
								<input type="number" name="docu_alum"
									class="form-control {{ $errors->has('docu_alum') ? 'is-invalid' : '' }}"
									value="{{ old('docu_alum') ? old('docu_alum') : Request::get('docu_alum') }}">
				                @if ($errors->has('docu_alum'))
				                    <div class="invalid-feedback">
				                        {{ $errors->first('docu_alum') }}
				                    </div>
				               	@endif
							</div>
						</div>
		            	<div class="col-sm-12 col-md-3 col-lg-3">
							<div class="form-group">
								<label>Nombres</label>
								<input type="text" name="nomb_alum"
									class="form-control {{ $errors->has('nomb_alum') ? 'is-invalid' : '' }}"
									value="{{ old('nomb_alum') ? old('nomb_alum') : Request::get('nomb_alum') }}">
				                @if ($errors->has('nomb_alum'))
				                    <div class="invalid-feedback">
				                    	{{ $errors->first('nomb_alum') }}
				                    </div>
				               	@endif
							</div>
						</div>
		            	<div class="col-sm-12 col-md-3 col-lg-3">
							<div class="form-group">
								<label>Primer apellido</label>
								<input type="text" name="pape_alum"
									class="form-control {{ $errors->has('pape_alum') ? 'is-invalid' : '' }}"
									value="{{ old('pape_alum') ? old('pape_alum') : Request::get('pape_alum') }}">
				                @if ($errors->has('pape_alum'))
				                    <div class="invalid-feedback">
				                        {{ $errors->first('pape_alum') }}
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
	  		@endif
	  		@if ($alumnos->isNotEmpty())
				<div class="table-responsive">
					<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
						<thead>
							<tr>
								<th>#</th>
				                <th class="text-nowrap">No. Identificación</th>
				                <th>Nombres</th>
				                <th>Apellidos</th>
				                <th>Acudiente</th>
				                <th class="text-nowrap text-center">Opción</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alumnos as $alumno)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $alumno->docu_alum }}</td>
									<td>{{ $alumno->nomb_alum }}</td>
									<td>{{ "{$alumno->pape_alum} {$alumno->sape_alum}" }}</td>
									<td>{{ $alumno->nomb_acud }}</td>
									<td class="text-nowrap text-center">
										@can('alumnos.show')
											@include('partials.button_show', ['route' => route('alumnos.show', $alumno->id)])
										@endcan
										@can('alumnos.edit')
											@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('alumnos.edit', $alumno->id)])
										@endcan
										@can('alumnos.destroy')
											@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('alumnos.destroy', $alumno->id)])
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				@component('partials.alert_empty')
					No hay acudientes registrados.
				@endcomponent
			@endif
		</div>
		@if ($alumnos->hasPages())
		  	<hr class="my-0 w-100">
		  	<div class="card-actions align-items-center justify-content-center px-3">
		    	{{ $alumnos->appends(request()->query())->links() }}
		  	</div>
	  	@endif
	</div>
@endsection()