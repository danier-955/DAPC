@extends('layouts.app')
@section('title', 'Registrar areas')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('areas.index') }}">Areas</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">font_download</i> Areas
			</h1>
			@can('estudiantes.create')
				@include('partials.button_create', ['route' => route('areas.create')])
			@endcan
		</div>
		<div class="card-body">
			@if (Auth::user()->areas())
				<form method="GET" action="{{ route('areas.index') }}" autocomplete="off">
					<div class="row clearfix">
						<div class="col-sm-12 col-md-3 col-lg-3 offset-4">
							<div class="form-group">
								<label>Nombre del Area</label>
								<input type="text" name="nomb_area"
									class="form-control {{ $errors->has('nomb_area') ? 'is-invalid' : '' }}"
									value="{{ old('nomb_area') ? old('nomb_area') : Request::get('nomb_area') }}">
				                @if ($errors->has('nomb_area'))
				                    <div class="invalid-feedback">
				                    	{{ $errors->first('nomb_area') }}
				                    </div>
				               	@endif
							</div>
						</div>
		            	<div class="row clearfix">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<div class="form-group text-center py-2">
									<button type="submit" class="btn btn-secondary">Búscar</button>
								</div>
							</div>
			        	</div>
		        	</div>
		        </form>
	  			<hr class="mt-0 w-100">
	  		@endif

			@if ($areas->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th>Nombres</th>
			                <th>Descripcion</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($areas as $area)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $area->nomb_area }}</td>
								<td>{{ $area->desc_area }}</td>
								<td class="text-nowrap text-center">
									@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('areas.edit', $area->id)])
									@can('implementos.destroy')
										@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('areas.destroy', $area->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@else
				@component('partials.alert_empty')
					No hay areas registrados.
				@endcomponent
			@endif
		</div>
		@if ($areas->hasPages())
		  	<hr class="my-0 w-100">
		  	<div class="card-actions align-items-center justify-content-center px-3">
		    	{{ $areas->appends(request()->query())->links() }}
		  	</div>
	  	@endif
	</div>
@endsection()