@extends('layouts.app')
@section('title', 'Estudiantes')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>
<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">wc</i> Estudiantes
		</h1>
		@can('estudiantes.create')
        	@include('partials.button_create', ['route' => route('estudiantes.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('estudiantes.index') }}" autocomplete="off">
			<div class="row clearfix">
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>No. Identificación</label>
						<input type="number" name="docu_estu"
							class="form-control {{ $errors->has('docu_estu') ? 'is-invalid' : '' }}"
							value="{{ old('docu_estu') ? old('docu_estu') : Request::get('docu_estu') }}">
		                @if ($errors->has('docu_estu'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('docu_estu') }}
		                    </div>
		               	@endif
					</div>
				</div>
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" name="nomb_estu"
							class="form-control {{ $errors->has('nomb_estu') ? 'is-invalid' : '' }}"
							value="{{ old('nomb_estu') ? old('nomb_estu') : Request::get('nomb_estu') }}">
		                @if ($errors->has('nomb_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_estu') }}
		                    </div>
		               	@endif
					</div>
				</div>
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Primer apellido</label>
						<input type="text" name="pape_estu"
							class="form-control {{ $errors->has('pape_estu') ? 'is-invalid' : '' }}"
							value="{{ old('pape_estu') ? old('pape_estu') : Request::get('pape_estu') }}">
		                @if ($errors->has('pape_estu'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('pape_estu') }}
		                    </div>
		               	@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
			    		<label>Grado</label>
		    			<select name="sub_grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sub_grado_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..."  autofocus>
		    				<option value="">··· Seleccione ···</option>
		      				@foreach($grados as $grado)
								@foreach($grado->subGrados as $subGrado)
									 <option value="{{ $subGrado->id }}"
						      			@if (old('sub_grado_id', Request::get('sub_grado_id')) === $subGrado->id){{ 'selected' }}@endif>
						      			{{ $grado->abre_grad }} &middot; {{ $subGrado->abre_subg }} &middot; Jornada {{$grado->getJornada() }}
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

		@if ($estudiantes->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th class="text-nowrap">No. Identificación</th>
			                <th>Nombres</th>
			                <th>Acudiente</th>
			                <th>Grado</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($estudiantes as $estudiante)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ "{$estudiante->tipo_docu} {$estudiante->docu_estu}" }}</td>
								<td>{{ "{$estudiante->nomb_estu} {$estudiante->pape_estu} {$estudiante->sape_estu}" }}</td>
								<td>{{ $estudiante->getAcudiente() }}</td>
								<td>{{ $estudiante->getSubGradoNombre() }}</td>
								<td class="text-nowrap text-center">
									@can('estudiantes.show')
							        	@include('partials.button_show', ['route' => route('estudiantes.show', $estudiante->id)])
									@endcan

									@can('estudiantes.edit')
							        	@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('estudiantes.edit', $estudiante->id)])
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
	@if ($estudiantes->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $estudiantes->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection