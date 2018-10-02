@extends('layouts.app')
@section('title', 'Programas')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('programas.index') }}">Programas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">local_parking</i> Programas
		</h1>
		@can('programas.create')
			@include('partials.button_create', ['route' => route('programas.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('programas.index') }}" autocomplete="off">
			<div class="row clearfix">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nomb_prog"
							class="form-control {{ $errors->has('nomb_prog') ? 'is-invalid' : '' }}"
							value="{{ old('nomb_prog', Request::get('nomb_prog')) }}">
		                @if ($errors->has('nomb_prog'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_prog') }}
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

		@if ($programas->isNotEmpty())
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
						@foreach($programas as $programa)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									<span class="typography-subheading fonr-weight-bold">
										{{ $programa->nomb_prog }}
									</span>
									<p class="text-justify">{!! nl2br($programa->desc_prog) !!}</p>
								</td>
								<td class="text-nowrap text-center">
									@can('programas.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('programas.edit', $programa->id)])
									@endcan
									@can('programas.destroy')
										@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('programas.destroy', $programa->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay programas registrados.
			@endcomponent
		@endif
	</div>
	@if ($programas->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $programas->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection