@extends('layouts.app')
@section('title', 'Fechas extracurriculares')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.index') }}">Asignaturas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.show', $asignatura->id) }}">Ver</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.fechas.index', $asignatura->id) }}">Fechas extracurriculares</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">date_range</i> Fechas extracurriculares
		</h1>
		@can('asignaturas.fechas.create')
			@istrue($fechaExiste)
				@include('partials.button_create', ['route' => route('asignaturas.fechas.create', $asignatura->id)])
			@else
				@include('partials.button_create', ['disabled' => true])
			@endistrue
		@endcan
	</div>
	<div class="card-body">

        @component('asignaturas.fechas.partials.subject_matter', ['asignatura' => $asignatura])
        	Fechas asignadas
        @endcomponent

		<form method="GET" action="{{ route('asignaturas.fechas.index', $asignatura->id) }}" autocomplete="off">
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
            	<div class="col-sm-12 col-md-3 col-lg-3 mb-3">
					<div class="form-group">
						<label>Periodo</label>
						<select name="peri_nota" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('peri_nota') ? 'is-invalid' : '' }}"  autofocus>
					    	<option value="">··· Seleccione ···</option>
					    	@foreach(Periodo::asociativos() as $periodo)
					      		<option value="{{ $periodo['id'] }}"
					      		@if (old('peri_nota', Request::get('peri_nota')) === $periodo['id']){{ 'selected' }}@endif>
					      			{{ $periodo['texto'] }}
					      		</option>
					      	@endforeach
					    </select>
		                @if ($errors->has('peri_nota'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('peri_nota') }}
		                    </div>
		               	@endif
	               </div>
				</div>
            	<div class="col-sm-12 col-md-3 col-lg-3 mb-3">
					<div class="form-group">
						<label>Tipo de nota</label>
						<select name="tipo_nota" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_nota') ? 'is-invalid' : '' }}"  autofocus>
					    	<option value="">··· Seleccione ···</option>
					    	@foreach(TipoNota::asociativos() as $tipoNota)
					      		<option value="{{ $tipoNota['id'] }}"
					      		@if (old('tipo_nota', Request::get('tipo_nota')) === $tipoNota['id']){{ 'selected' }}@endif>
					      			{{ $tipoNota['texto'] }}
					      		</option>
					      	@endforeach
					    </select>
		                @if ($errors->has('tipo_nota'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('tipo_nota') }}
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

		@if ($fechas->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
			        <thead>
			            <tr>
			            	<th>#</th>
			                <th class="text-nowrap">Fecha inicio</th>
			                <th class="text-nowrap">Fecha final</th>
			                <th class="text-nowrap">Periodo &middot; Tipo nota</th>
			                <th>Estado</th>
			                <th class="text-nowrap text-center">Opción</th>
			            </tr>
			        </thead>
			        <tbody>
			           	@foreach($fechas as $fecha)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="text-nowrap">
									{{ datetime_inic_show($fecha->pivot->fech_nota) }}
								</td>
								<td class="text-nowrap">
									{{ datetime_fina_show($fecha->pivot->fech_nota) }}
								</td>
								<td class="text-nowrap">
									{{ $fecha->pivot->getPeriodo() }} &middot;
									{{ $fecha->pivot->getTipoNota() }}
								</td>
								<td>
									<span class="chip {{ $fecha->pivot->getEstadoColor() }}">
										{{ $fecha->pivot->getEstadoNombre() }}
									</span>
								</td>
								<td class="text-nowrap text-center">
									@can('asignaturas.fechas.show')
										@include('partials.button_show', ['route' => route('asignaturas.fechas.show', [$asignatura->id, $fecha->pivot->id])])
									@endcan
									@can('asignaturas.fechas.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('asignaturas.fechas.edit', [$asignatura->id, $fecha->pivot->id])])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
		        </table>
		    </div>
		@else
			@component('partials.alert_empty')
				No hay fechas registradas.
			@endcomponent
		@endif
	</div>

	@if ($fechas->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $fechas->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection