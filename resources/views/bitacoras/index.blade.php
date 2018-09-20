@extends('layouts.app')
@section('title', 'Bitácoras')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bitacoras.index') }}">Bitácoras</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">library_books</i> Bitácoras
		</h1>
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('bitacoras.index') }}" autocomplete="off">
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
					<div class="form-group">
						<label>Operación</label>
						<div class="mt-3">
							@foreach (Operacion::asociativos() as $operacion)
								<div class="custom-control custom-radio custom-control-inline">
								  	<input type="radio"
								  		id="oper_bita_{{ $operacion['id'] }}" name="oper_bita"
								  		class="custom-control-input {{ $errors->has('oper_bita') ? 'is-invalid' : '' }}"
								  		value="{{ $operacion['id'] }}"
								  		{{ Request::get('oper_bita', Operacion::todo()) === $operacion['id'] ? 'checked' : '' }}>
								  	<label class="custom-control-label"
								  		for="oper_bita_{{ $operacion['id'] }}">
								  		{{ $operacion['texto'] }}
								  	</label>
								</div>
							@endforeach
						</div>
		                @if ($errors->has('oper_bita'))
		                    <div class="form-text text-danger">
		                        {{ $errors->first('oper_bita') }}
		                    </div>
		               	@endif
					</div>
				</div>
			</div>
			<div class="row clearfix">
            	{{-- <div class="col-sm-12 col-md-10 col-lg-10">
					<div class="form-group">
						<label>Nombre usuario</label>
						<input type="text" name="usua_bita"
							class="form-control {{ $errors->has('usua_bita') ? 'is-invalid' : '' }}"
							value="{{ old('usua_bita', Request::get('usua_bita')) }}">
		                @if ($errors->has('usua_bita'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('usua_bita') }}
		                    </div>
		               	@endif
					</div>
				</div> --}}
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group text-center py-2">
						<button type="submit" class="btn btn-secondary">Búscar</button>
					</div>
				</div>
        	</div>
        </form>
	  	<hr class="mt-0 w-100">

		@if ($bitacoras->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
							<th>Fecha &middot; Hora</th>
							<th>Operación</th>
							<th>Modulo</th>
							<th>Responsable</th>
						</tr>
					</thead>
					<tbody>
						@foreach($bitacoras as $bitacora)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="text-nowrap">
									{{ $bitacora->created_at->format('d/m/Y h:i:s a') }}
								</td>
								<td>{{ $bitacora->getOperacion() }}</td>
								<td>{{ $bitacora->tabl_bita }}</td>
								<td>{{ $bitacora->getUsuario() }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay registros en la bitácora.
			@endcomponent
		@endif
	</div>
	@if ($bitacoras->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $bitacoras->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection
