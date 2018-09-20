@extends('layouts.app')
@section('title', 'Administrativos')

@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-white shadow-1">
		<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
		<li class="breadcrumb-item"><a href="{{ route('administrativos.index') }}">Administrativos</a></li>
		<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	</ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">people_outline</i> Administrativos
		</h1>
		@can('administrativos.create')
		    @include('partials.button_create', ['route' => route('administrativos.create')])
		@endcan
	</div>
	<div class="card-body">

		@if (Shinobi::isRole(SpecialRole::administrador()))
			<form method="GET" action="{{ route('administrativos.index') }}" autocomplete="off">
				<div class="row clearfix">
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>No. Identificación</label>
							<input type="number" name="docu_admi"
								class="form-control {{ $errors->has('docu_admi') ? 'is-invalid' : '' }}"
								value="{{ old('docu_admi', Request::get('docu_admi')) }}">
			                @if ($errors->has('docu_admi'))
			                    <div class="invalid-feedback">
			                        {{ $errors->first('docu_admi') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Nombres</label>
							<input type="text" name="nomb_admi"
								class="form-control {{ $errors->has('nomb_admi') ? 'is-invalid' : '' }}"
								value="{{ old('nomb_admi', Request::get('nomb_admi')) }}">
			                @if ($errors->has('nomb_admi'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('nomb_admi') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Primer apellido</label>
							<input type="text" name="pape_admi"
								class="form-control {{ $errors->has('pape_admi') ? 'is-invalid' : '' }}"
								value="{{ old('pape_admi', Request::get('pape_admi')) }}">
			                @if ($errors->has('pape_admi'))
			                    <div class="invalid-feedback">
			                        {{ $errors->first('pape_admi') }}
			                    </div>
			               	@endif
						</div>
					</div>
	            	<div class="col-sm-12 col-md-3 col-lg-3 mb-3">
						<div class="form-group">
							<label>Cargo</label>
							<select name="carg_admi" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('cargo_admin') ? 'is-invalid' : '' }}"  autofocus>
						    	<option value="">··· Seleccione ···</option>
						    	@foreach(Cargo::asociativos() as $cargo)
						      		<option value="{{ $cargo['id'] }}"
						      		@if (old('cargo_admin', Request::get('cargo_admin')) === $cargo['id']){{ 'selected' }}@endif>
						      			{{ $cargo['texto'] }}
						      		</option>
						      	@endforeach
						    </select>
			                @if ($errors->has('cargo_admin'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('cargo_admin') }}
			                    </div>
			               	@endif
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
	    @endif

	    @if ($administrativos->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th class="text-nowrap">No. Identificación</th>
			                <th>Nombres</th>
			                <th>Apellidos</th>
			                <th>Teléfono</th>
			                <th class="text-nowrap">Título profesional</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($administrativos as $administrativo)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $administrativo->docu_admi }}</td>
								<td>{{ $administrativo->nomb_admi }}</td>
								<td>{{ "{$administrativo->pape_admi} {$administrativo->sape_admi}" }}</td>
								<td>{{ $administrativo->tele_admi }}</td>
								<td>{{ $administrativo->titu_admi }}</td>
								<td class="text-nowrap text-center">
									@can('administrativos.show')
										@include('partials.button_show', ['route' => route('administrativos.show', $administrativo->id)])
									@endcan
									@can('administrativos.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('administrativos.edit', $administrativo->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay administrativos registrados.
			@endcomponent
		@endif
	</div>
	@if ($administrativos->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $administrativos->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection
