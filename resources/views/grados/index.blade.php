@extends('layouts.app')
@section('title', 'Grados')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">school</i> Grados
		</h1>
		@can('grados.create')
			@include('partials.button_create', ['route' => route('grados.create')])
		@endcan
	</div>
	<div class="card-body">

		@if (Auth::user()->esAdministrativo())
			<form method="GET" action="{{ route('grados.index') }}" autocomplete="off">
				<div class="row clearfix">
	            	<div class="col-sm-12 col-md-4 col-lg-4  offset-3">
						<div class="form-group">
							<label>Nombre del grado:</label>
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

		@if ($grados->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
			                <th>Nombre del grado</th>
			                <th>Abreviacion del Grado</th>
			                <th>Jornada</th>
			                <th>Acción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($grados as $grado)
							<tr>
								<td>{{$grado->nomb_grad}} </td>
								<td>{{$grado->abre_grad}} </td>
								<td>{{$grado->getJornada()}} </td>
								<td class="text-nowrap text-center">
									@can('grados.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('grados.edit', $grado->id)])
									@endcan
									@can('grados.destroy')
									@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('grados.destroy', $grado->id)])
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
