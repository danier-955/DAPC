@extends('layouts.app')
@section('title', 'Areas')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('areas.index') }}">Areas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">font_download</i> Areas
		</h1>
		@can('areas.create')
			@include('partials.button_create', ['route' => route('areas.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('areas.index') }}" autocomplete="off">
			<div class="row clearfix">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nomb_area"
							class="form-control {{ $errors->has('nomb_area') ? 'is-invalid' : '' }}"
							value="{{ old('nomb_area', Request::get('nomb_area')) }}">
		                @if ($errors->has('nomb_area'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_area') }}
		                    </div>
		               	@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-8 col-lg-8">
					<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						<button type="submit" class="btn btn-secondary">Búscar</button>
					</div>
				</div>
        	</div>
        </form>
		<hr class="mt-0 w-100">

		@if ($areas->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th>Nombre &middot; Descripción</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($areas as $area)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									<span class="typography-subheading fonr-weight-bold">{{ $area->nomb_area }}</span>
									<p class="text-justify">{!! nl2br($area->desc_area) !!}</p>
								</td>
								<td class="text-nowrap text-center">
									@can('areas.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('areas.edit', $area->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay areas registradas.
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
@endsection