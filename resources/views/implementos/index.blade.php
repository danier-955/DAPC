@extends('layouts.app')
@section('title', 'Útiles escolares')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('implementos.index') }}">Útiles escolares</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">brush</i> Útiles escolares
		</h1>
		@can('implementos.create')
			@include('partials.button_create', ['route' => route('implementos.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('implementos.index') }}" autocomplete="off">
			<div class="row clearfix">
            	<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nomb_util"
							class="form-control {{ $errors->has('nomb_util') ? 'is-invalid' : '' }}"
							value="{{ old('nomb_util', Request::get('nomb_util')) }}">
		                @if ($errors->has('nomb_util'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_util') }}
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

		@if ($implementos->isNotEmpty())
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
						@foreach($implementos as $implemento)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									<span class="typography-subheading fonr-weight-bold">
										{{ $implemento->nomb_util }}
									</span>
									<p class="text-justify">{!! nl2br($implemento->desc_util) !!}</p>
								</td>
								<td class="text-nowrap text-center">
									@can('implementos.show')
										@include('partials.button_show', ['btnSm' => 'btn-sm', 'route' => route('implementos.show', $implemento->id)])
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
				No hay útiles escolares registrados.
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
