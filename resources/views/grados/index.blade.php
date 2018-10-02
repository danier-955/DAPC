@extends('layouts.app')
@section('title', 'Grados')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">school</i> Grados
		</h1>
		@can('grados.create')
			@include('partials.button_create', ['route' => route('grados.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('grados.index') }}" autocomplete="off">
			<div class="row clearfix">
            	<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nomb_grad"
							class="form-control {{ $errors->has('nomb_grad') ? 'is-invalid' : '' }}"
							value="{{ old('nomb_grad', Request::get('nomb_grad')) }}">
		                @if ($errors->has('nomb_grad'))
		                    <div class="invalid-feedback">
		                        {{ $errors->first('nomb_grad') }}
		                    </div>
		               	@endif
					</div>
				</div>
				<div class="form-group col-md-3 col-lg-3">
				    <label>Jornada</label>
				    <select name="jorn_grad" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('jorn_grad') ? 'is-invalid' : '' }}" autofocus>
				    	<option value="">··· Seleccione ···</option>
				    	@foreach($jornadas as $jornada)
				      		<option value="{{ $jornada['id'] }}"
				      		@if (old('jorn_grad', Request::get('jorn_grad')) === $jornada['id']){{ 'selected' }}@endif>
				      			{{ $jornada['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('jorn_grad'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('jorn_grad') }}
	                    </div>
	               	@endif
		 		</div>
				<div class="col-sm-12 col-md-5 col-lg-5">
					<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						<button type="submit" class="btn btn-secondary">Búscar</button>
					</div>
				</div>
			</div>
        </form>
	  	<hr class="mt-0 w-100">

		@if ($grados->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th>Nombre</th>
			                <th>Abreviación &middot; Jornada</th>
			                <th class="text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($grados as $grado)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $grado->nomb_grad }} </td>
								<td>{{ "{$grado->abre_grad} &middot; Jornada {$grado->getJornada()}" }} </td>
								<td class="text-nowrap text-center">
									@can('grados.subgrados.create')
										@include('partials.button_subgrado', ['btnSm' => 'btn-sm', 'route' => route('grados.subgrados.create', $grado->id)])
									@endcan
									@can('grados.show')
										@include('partials.button_show', ['btnSm' => 'btn-sm', 'route' => route('grados.show', $grado->id)])
									@endcan
									@can('grados.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('grados.edit', $grado->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay grados registrados.
			@endcomponent
		@endif
	</div>
	@if ($grados->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $grados->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection
