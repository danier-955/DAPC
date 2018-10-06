@extends('layouts.app')
@section('title', 'Notas')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('notas.index') }}">Notas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>
<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">note</i> Notas
		</h1>
		@can('notas.create')
		    @include('partials.button_create', ['route' => route('notas.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('notas.index') }}" autocomplete="off">
			<div class="row clearfix">
            	<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
			    		<label>Grado</label>
		    			<select id="sub_grado_id" name="sub_grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control cargar-asignaturas {{ $errors->has('sub_grado_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
		    				<option value="">··· Seleccione ···</option>
		      				@foreach($grados as $grado)
								@foreach($grado->subGrados as $subGrado)
									 <option value="{{ $subGrado->id }}"
						      			@if (old('sub_grado_id', Request::get('sub_grado_id')) === $subGrado->id){{ 'selected' }}@endif>
						      			{{ $grado->abre_grad }} &middot; {{ $subGrado->abre_subg }} &middot; Jornada {{$grado->getJornada() }}
						      		</option>
					      		@endforeach
					      	@endforeach
		    			</select>
		                @if ($errors->has('sub_grado_id'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('sub_grado_id') }}
		                    </div>
		               	@endif
		            </div>
				</div>
            	<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
			    		<label>Asignatura</label>
		    			<select id="asignatura_id" name="asignatura_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('asignatura_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
		    				@isset ($asignaturas)
		    				    @foreach($asignaturas as $asignatura)
									<option value="{{ $asignatura->id }}"
						      			@if (old('asignatura_id', Request::get('asignatura_id')) === $asignatura->id){{ 'selected' }}@endif>
						      			{{ $asignatura->nomb_asig }}
						      		</option>
					      		@endforeach
					      	@else
		    					<option value="">··· Seleccione ···</option>
		    				@endisset
		    			</select>
		                @if ($errors->has('asignatura_id'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('asignatura_id') }}
		                    </div>
		               	@endif
		            </div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						<button type="submit" class="btn btn-secondary">Búscar</button>
					</div>
				</div>
			</div>
        </form>
  		<hr class="mt-0 w-100">

		@if (isset($notas) && $notas->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th colspan="2"></th>
							<th class="text-center">1/4</th>
							<th class="text-center">2/4</th>
							<th class="text-center">3/4</th>
							<th class="text-center">4/4</th>
							<th colspan="3"></th>
						</tr>
						<tr>
							<th>#</th>
			                <th class="text-nowrap">Estudiante</th>
			                {{-- <th>Asignatura</th> --}}
			                <th class="text-center">Cal</th>
			                <th class="text-center">Cal</th>
			                <th class="text-center">Cal</th>
			                <th class="text-center">Cal</th>
			                <th class="text-center">Def</th>
			                <th class="text-center">Des</th>
			                <th class="text-nowrap text-center">Opción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($notas as $nota)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="text-nowrap">{{ $nota->getEstudiante() }}</td>
								{{-- <td>{{ $nota->getAsignatura() }}</td> --}}
								<td class="text-center">
									<abbr class="chip {{ $nota->getNotaColor('nota_per1') }}" {!! $nota->getNotaRecuperacion('nota_rec1') !!}>
										{{ $nota->nota_per1 }}
									</abbr>
								</td>
								<td class="text-center">
									<abbr class="chip {{ $nota->getNotaColor('nota_per2') }}" {!! $nota->getNotaRecuperacion('nota_rec2') !!}>
										{{ $nota->nota_per2 }}
									</abbr>
								</td>
								<td class="text-center">
									<abbr class="chip {{ $nota->getNotaColor('nota_per3') }}" {!! $nota->getNotaRecuperacion('nota_rec3') !!}>
										{{ $nota->nota_per3 }}
									</abbr>
								</td>
								<td class="text-center">
									<abbr class="chip {{ $nota->getNotaColor('nota_per4') }}" {!! $nota->getNotaRecuperacion('nota_rec4') !!}>
										{{ $nota->nota_per4 }}
									</abbr>
								</td>
								<td class="text-center">
									<span class="chip {{ $nota->getNotaColor('nota_defi') }}">
										{{ $nota->nota_defi }}
									</span>
								</td>
								<td class="text-center">
									<span class="chip">
										{{ $nota->getEscalaCompleta() }}
									</span>
								</td>
								<td class="text-nowrap text-center">
									@can('notas.show')
										@include('partials.button_show', ['route' => route('notas.show', $nota->id)])
									@endcan
									@can('notas.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('notas.edit', $nota->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay notas registradas.
			@endcomponent
		@endif
	</div>

	@if (isset($notas) && $notas->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $notas->appends(request()->query())->links() }}
	  	</div>
  	@endif

</div>
@endsection