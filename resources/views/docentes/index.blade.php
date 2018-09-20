@extends('layouts.app')
@section('title', 'Docentes')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Docentes
		</h1>
		@can('docentes.create')
			@include('partials.button_create', ['route' => route('docentes.create')])
		@endcan
	</div>
	<div class="card-body">

		@if (Auth::user()->esAdministrativo())
			<form method="GET" action="{{ route('docentes.index') }}" autocomplete="off">
				<div class="row clearfix">
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>No. Identificación</label>
							<input type="number" name="docu_doce"
								class="form-control {{ $errors->has('docu_doce') ? 'is-invalid' : '' }}"
								value="{{ old('docu_doce', Request::get('docu_doce')) }}">
			                @if ($errors->has('docu_doce'))
			                    <div class="invalid-feedback">
			                        {{ $errors->first('docu_doce') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Nombres</label>
							<input type="text" name="nomb_doce"
								class="form-control {{ $errors->has('nomb_doce') ? 'is-invalid' : '' }}"
								value="{{ old('nomb_doce', Request::get('nomb_doce')) }}">
			                @if ($errors->has('nomb_doce'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('nomb_doce') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Primer apellido</label>
							<input type="text" name="pape_doce"
								class="form-control {{ $errors->has('pape_doce') ? 'is-invalid' : '' }}"
								value="{{ old('pape_doce', Request::get('pape_doce')) }}">
			                @if ($errors->has('pape_doce'))
			                    <div class="invalid-feedback">
			                        {{ $errors->first('pape_doce') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Segundo apellido</label>
							<input type="text" name="sape_doce"
								class="form-control {{ $errors->has('sape_doce') ? 'is-invalid' : '' }}"
								value="{{ old('sape_doce', Request::get('sape_doce')) }}">
			                @if ($errors->has('sape_doce'))
			                    <div class="invalid-feedback">
			                        {{ $errors->first('sape_doce') }}
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

		@if ($docentes->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th class="text-nowrap">No. Identificación</th>
			                <th>Nombres</th>
			                <th>Apellidos</th>
			                <th>Teléfono</th>
			                <th class="text-nowrap">Título profesional</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($docentes as $docente)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $docente->docu_doce }}</td>
								<td>{{ $docente->nomb_doce }}</td>
								<td>{{ "{$docente->pape_doce} {$docente->sape_doce}" }}</td>
								<td>{{ $docente->tele_doce }}</td>
								<td>{{ $docente->titu_doce }}</td>
								<td class="text-nowrap text-center">
									@can('docentes.show')
										@include('partials.button_show', ['route' => route('docentes.show', $docente->id)])
									@endcan
									@can('docentes.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('docentes.edit', $docente->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay docentes registrados.
			@endcomponent
		@endif
	</div>
	@if ($docentes->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $docentes->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection
