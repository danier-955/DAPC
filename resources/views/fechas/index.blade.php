@extends('layouts.app')
@section('title', 'Fechas')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('fechas.index') }}">Fechas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">date_range</i> Fechas
		</h1>
		@can('fechas.create')
			@include('partials.button_create', ['route' => route('fechas.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('fechas.index') }}" autocomplete="off">
			<div class="row clearfix">
				<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Año de las fechas</label>
						<input type="number" name="ano_fech"
							class="form-control {{ $errors->has('ano_fech') ? 'is-invalid' : '' }}"
							value="{{ old('ano_fech', Request::get('ano_fech')) }}">
		                @if ($errors->has('ano_fech'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('ano_fech') }}
		                    </div>
		               	@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-9 col-lg-9">
					<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						<button type="submit" class="btn btn-secondary">Búscar</button>
					</div>
				</div>
        	</div>
        </form>
	  	<hr class="mt-0 w-100">

		@if ($fechas->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
			        <thead>
			            <tr>
			            	<th>#</th>
			                <th>Año</th>
			                <th>Registrado</th>
			                <th>Actualizado</th>
			                <th class="text-nowrap text-center">Opción</th>
			            </tr>
			        </thead>
			        <tbody>
			           	@foreach($fechas as $fecha)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $fecha->ano_fech }}</td>
								<td>{{ optional($fecha->created_at)->format('l d, F Y') }}</td>
								<td>{{ optional($fecha->updated_at)->format('l d, F Y') }}</td>
								<td class="text-nowrap text-center">
									@can('fechas.show')
										@include('partials.button_show', ['route' => route('fechas.show', $fecha->id)])
									@endcan
									@can('fechas.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('fechas.edit', $fecha->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
		        </table>
		    </div>
		@else
			@component('partials.alert_empty')
				No hay fechas registradas.
			@endcomponent
		@endif
	</div>

	@if ($fechas->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $fechas->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection