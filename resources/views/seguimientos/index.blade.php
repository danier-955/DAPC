@extends('layouts.app')
@section('title', 'Seguimientos')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('seguimientos.index') }}">Seguimientos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">class</i> Seguimientos
		</h1>
		@can('seguimientos.create')
			@include('partials.button_create', ['route' => route('seguimientos.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('seguimientos.index') }}" autocomplete="off">
			<div class="row clearfix">
				<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Fecha inicial</label>
						<input type="text"
							class="start-datepicker form-control {{ $errors->has('fech_inic') ? 'is-invalid' : '' }}" name="fech_inic"
							value="{{ old('fech_inic', Request::get('fech_inic')) }}">
		                @if ($errors->has('fech_inic'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('fech_inic') }}
		                    </div>
		               	@endif
					</div>
				</div>
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Fecha final</label>
						<input type="text"
							class="end-datepicker form-control {{ $errors->has('fech_fina') ? 'is-invalid' : '' }}" name="fech_fina"
							value="{{ old('fech_fina', Request::get('fech_fina')) }}">
		                @if ($errors->has('fech_fina'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('fech_fina') }}
		                    </div>
		               	@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						<button type="submit" class="btn btn-secondary">Búscar</button>
					</div>
				</div>
        	</div>
        </form>
	  	<hr class="mt-0 w-100">

		@if ($seguimientos->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
			        <thead>
			            <tr>
			            	<th>#</th>
			                <th class="text-nowrap">Fecha</th>
			                <th>Llegada</th>
			                <th>Salida</th>
			                <th>Horas</th>
			                <th>Practicante</th>
			                <th>Docente</th>
			                <th class="text-nowrap text-center">Opción</th>
			            </tr>
			        </thead>
			        <tbody>
			           	@foreach($seguimientos as $seguimiento)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ optional($seguimiento->fech_segu)->format('l d, F Y') }}</td>
								<td class="text-nowrap">{{ $seguimiento->hora_lleg }}</td>
								<td class="text-nowrap">{{ $seguimiento->hora_sali }}</td>
								<td>{{ $seguimiento->hora_cump }}</td>
								<td>{{ $seguimiento->getPracticante() }}</td>
								<td>{{ $seguimiento->getDocente() }}</td>
								<td class="text-nowrap text-center">
									@can('seguimientos.show')
										@include('partials.button_show', ['route' => route('seguimientos.show', $seguimiento->id)])
									@endcan
									@can('seguimientos.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('seguimientos.edit', $seguimiento->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
		        </table>
		    </div>
		@else
			@component('partials.alert_empty')
				No hay seguimientos registrados.
			@endcomponent
		@endif
	</div>

	@if ($seguimientos->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $seguimientos->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection