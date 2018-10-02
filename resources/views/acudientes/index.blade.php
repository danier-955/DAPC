@extends('layouts.app')
@section('title', 'Acudientes')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('acudientes.index') }}">Acudientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>
<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Acudientes
		</h1>
	</div>
	<div class="card-body">

		@if (Auth::user()->esAdministrativo())
			<form method="GET" action="{{ route('acudientes.index') }}" autocomplete="off">
				<div class="row clearfix">
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>No. Identificación</label>
							<input type="number" name="docu_acud"
								class="form-control {{ $errors->has('docu_acud') ? 'is-invalid' : '' }}"
								value="{{ old('docu_acud') ? old('docu_acud') : Request::get('docu_acud') }}">
			                @if ($errors->has('docu_acud'))
			                    <div class="invalid-feedback">
			                        {{ $errors->first('docu_acud') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Nombres</label>
							<input type="text" name="nomb_acud"
								class="form-control {{ $errors->has('nomb_acud') ? 'is-invalid' : '' }}"
								value="{{ old('nomb_acud') ? old('nomb_acud') : Request::get('nomb_acud') }}">
			                @if ($errors->has('nomb_acud'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('nomb_acud') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Primer apellido</label>
							<input type="text" name="pape_acud"
								class="form-control {{ $errors->has('pape_acud') ? 'is-invalid' : '' }}"
								value="{{ old('pape_acud') ? old('pape_acud') : Request::get('pape_acud') }}">
			                @if ($errors->has('pape_acud'))
			                    <div class="invalid-feedback">
			                        {{ $errors->first('pape_acud') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Segundo apellido</label>
							<input type="text" name="sape_acud"
								class="form-control {{ $errors->has('sape_acud') ? 'is-invalid' : '' }}"
								value="{{ old('sape_acud') ? old('sape_acud') : Request::get('sape_acud') }}">
			                @if ($errors->has('sape_acud'))
			                    <div class="invalid-feedback">
			                        {{ $errors->first('sape_acud') }}
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

		@if ($acudientes->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th class="text-nowrap">No. Identificación</th>
			                <th>Nombres</th>
			                <th>Apellidos</th>
			                <th>Teléfono</th>
			                <th>Profesión</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($acudientes as $acudiente)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $acudiente->docu_acud }}</td>
								<td>{{ $acudiente->nomb_acud }}</td>
								<td>{{ "{$acudiente->pape_acud} {$acudiente->sape_acud}" }}</td>
								<td>{{ $acudiente->tele_acud }}</td>
								<td>{{ $acudiente->prof_acud }}</td>
								<td class="text-nowrap text-center">
									@can('acudientes.show')
										@include('partials.button_show', ['route' => route('acudientes.show', $acudiente->id)])
									@endcan
									@can('acudientes.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('acudientes.edit', $acudiente->id)])
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

	@if ($acudientes->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $acudientes->appends(request()->query())->links() }}
	  	</div>
  	@endif

</div>
@endsection