@extends('layouts.app')
@section('title', 'Eventos')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('eventos.index') }}">Eventos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">event_note</i> Eventos
		</h1>
		@can('eventos.create')
			@include('partials.button_create', ['route' => route('eventos.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('eventos.index') }}" autocomplete="off">
			<div class="row clearfix">
            	<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Titulo</label>
						<input type="text" name="titu_even"
							class="form-control {{ $errors->has('titu_even') ? 'is-invalid' : '' }}"
							value="{{ old('titu_even', Request::get('titu_even')) }}">
		                @if ($errors->has('titu_even'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('titu_even') }}
		                    </div>
		               	@endif
					</div>
				</div>
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
				<div class="col-sm-12 col-md-3 col-lg-3">
					<div class="form-group">
						<label>Página principal</label>
				   		<div class="custom-control custom-checkbox mt-3">
		                    <input type="checkbox" id="most_even" name="most_even" class="custom-control-input" {{ old('most_even', Request::get('most_even')) ? 'checked' : '' }}>
		                    <label class="custom-control-label" for="most_even">
		                    	Visible en página principal
		                    </label>
		                </div>
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

		@if ($eventos->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th>Título</th>
			                <th>Inicio &middot; Clausura</th>
			                <th class="text-nowrap">Cupos &middot; Jornada</th>
			                <th>Portada</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($eventos as $evento)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $evento->titu_even }}</td>
								<td class="text-nowrap">
									{{ optional($evento->inic_even)->format('d F Y h:i a') }} &middot;<br>
									{{ optional($evento->fina_even)->format('d F Y h:i a') }}
								</td>
								<td class="text-nowrap">
									{{ $evento->cupo_even }} &middot; {{ $evento->getJornada() }}
								</td>
								<td>
									<div class="chip {{ $evento->getVisibleColor() }}">
							    		{{ $evento->getVisibleTitulo() }}
							    	</div>
								</td>
								<td class="text-nowrap text-center">
									@can('eventos.show')
										@include('partials.button_show', ['btnSm' => 'btn-sm', 'route' => route('eventos.show', $evento->id)])
									@endcan
									@can('eventos.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('eventos.edit', $evento->id)])
									@endcan
									@can('eventos.destroy')
										@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('eventos.destroy', $evento->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay eventos registradas.
			@endcomponent
		@endif
	</div>
	@if ($eventos->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $eventos->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection