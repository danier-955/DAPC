@extends('layouts.app')
@section('title', 'Practicantes')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('practicantes.index') }}">Practicantes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Practicantes
		</h1>
		@can('practicantes.create')
			@include('partials.button_create', ['route' => route('practicantes.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('practicantes.index') }}" autocomplete="off">
			<div class="row clearfix">
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>No. Identificación</label>
						<input type="number" name="docu_prac"
							class="form-control {{ $errors->has('docu_prac') ? 'is-invalid' : '' }}"
							value="{{ old('docu_prac', Request::get('docu_prac')) }}">
		                @if ($errors->has('docu_prac'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('docu_prac') }}
		                    </div>
		               	@endif
					</div>
				</div>
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" name="nomb_prac"
							class="form-control {{ $errors->has('nomb_prac') ? 'is-invalid' : '' }}"
							value="{{ old('nomb_prac', Request::get('nomb_prac')) }}">
		                @if ($errors->has('nomb_prac'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_prac') }}
		                    </div>
		               	@endif
					</div>
				</div>
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Primer apellido</label>
						<input type="text" name="pape_prac"
							class="form-control {{ $errors->has('pape_prac') ? 'is-invalid' : '' }}"
							value="{{ old('pape_prac', Request::get('pape_prac')) }}">
		                @if ($errors->has('pape_prac'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('pape_prac') }}
		                    </div>
		               	@endif
					</div>
				</div>
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Segundo apellido</label>
						<input type="text" name="sape_prac"
							class="form-control {{ $errors->has('sape_prac') ? 'is-invalid' : '' }}"
							value="{{ old('sape_prac', Request::get('sape_prac')) }}">
		                @if ($errors->has('sape_prac'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('sape_prac') }}
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

		@if ($practicantes->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
			        <thead>
			            <tr>
			            	<th>#</th>
			                <th class="text-nowrap">No. Identificación</th>
			                <th>Nombres</th>
			                <th>Apellidos</th>
			                <th>Teléfono</th>
			                <th>Instituto de procedencia</th>
			                <th class="text-nowrap text-center">Opción</th>
			            </tr>
			        </thead>
			        <tbody>
			           	@foreach($practicantes as $practicante)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $practicante->docu_prac }}</td>
								<td>{{ $practicante->nomb_prac }}</td>
								<td>{{ "{$practicante->pape_prac} {$practicante->sape_prac}" }}</td>
								<td>{{ $practicante->tele_prac }}</td>
								<td>{{ $practicante->cole_prov }}</td>
								<td class="text-nowrap text-center">
									@can('practicantes.show')
										@include('partials.button_show', ['route' => route('practicantes.show', $practicante->id)])
									@endcan
									@can('practicantes.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('practicantes.edit', $practicante->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
		        </table>
		    </div>
		@else
			@component('partials.alert_empty')
				No hay practicantes registrados.
			@endcomponent
		@endif
	</div>
	@if ($practicantes->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $practicantes->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection
