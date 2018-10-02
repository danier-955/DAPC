@extends('layouts.app')
@section('title', 'Ver fecha extracurricular')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	<li class="breadcrumb-item"><a href="{{ route('asignaturas.index') }}">Asignaturas</a></li>
	<li class="breadcrumb-item"><a href="{{ route('asignaturas.show', $asignatura->id) }}">Ver asignatura</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.fechas.index', $asignatura->id) }}">Fechas extracurriculares</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.fechas.show', [$asignatura->id, $fecha->id]) }}">Ver</a></li>
	<li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">date_range</i> Ver fecha extracurricular
		</h1>
		<div>
			@can('asignaturas.fechas.create')
				@istrue($fechaExiste)
					@include('partials.button_create', ['route' => route('asignaturas.fechas.create', $asignatura->id)])
				@else
					@include('partials.button_create', ['disabled' => true])
				@endistrue
			@endcan
			@can('asignaturas.fechas.edit')
				@include('partials.button_edit', ['route' => route('asignaturas.fechas.edit', [$asignatura->id, $fecha->id])])
			@endcan
		</div>
	</div>
	<div class="card-body">

        @component('asignaturas.fechas.partials.subject_matter', ['asignatura' => $asignatura])
        	Información de la fecha
        @endcomponent

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">Fecha inicial</span>
						</th>
						<td colspan="2">{{ datetime_inic_show($fecha->fech_nota) }}</td>
						<th>
							<span class="font-weight-bold">Fecha final</span>
						</th>
						<td colspan="2">{{ datetime_fina_show($fecha->fech_nota) }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Periodo</span>
						</th>
						<td>{{ $fecha->getPeriodo() }}</td>
						<th>
							<span class="font-weight-bold">Tipo de nota</span>
						</th>
						<td>{{ $fecha->getTipoNota() }}</td>
						<th>
							<span class="font-weight-bold">Estado</span>
						</th>
						<td>
							<span class="chip {{ $fecha->getEstadoColor() }}">
								{{ $fecha->getEstadoNombre() }}
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Motivo de la nota</span>
						</th>
						<td colspan="5">{!! nl2br($fecha->moti_nota) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection
