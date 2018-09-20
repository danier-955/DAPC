@extends('layouts.app')
@section('title', 'Utiles')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('implementos.index') }}">Utiles</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">library_books</i> Utiles
		</h1>
		@can('implementos.create')
			@include('partials.button_create', ['route' => route('implementos.create')])
		@endcan
	</div>
	<div class="card-body">
		<form method="GET" action="{{ route('implementos.index') }}" autocomplete="off">
			<div class="row clearfix">
				<div class="col-sm-12 col-md-3 col-lg-3 offset-4">
					<div class="form-group">
						<label>Util Escolar</label>
						<input type="text" name="nomb_util"
							class="form-control {{ $errors->has('nomb_util') ? 'is-invalid' : '' }}"
							value="{{ old('nomb_util') ? old('nomb_util') : Request::get('nomb_util') }}">
		                @if ($errors->has('nomb_util'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_util') }}
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

		@if ($implementos->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th class="text-nowrap">Util</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($implementos as $implemento)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $implemento->nomb_util }}</td>
								
								<td class="text-nowrap text-center">
									@can('implementos.show')
										@include('partials.button_show', ['route' => route('implementos.show', $implemento->id)])
									@endcan
									@can('implementos.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('implementos.edit', $implemento->id)])
									@endcan
									@can('implementos.destroy')
										@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('implementos.destroy', $implemento->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay implemento registrados.
			@endcomponent
		@endif
	</div>
	@if ($implementos->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $implementos->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection
