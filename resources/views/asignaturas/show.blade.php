@extends('layouts.app')
@section('title', 'Ver asignatura')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.index') }}">Asignaturas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asignaturas.show', $asignatura->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">book</i> Ver asignatura
		</h1>
		<div>
			@can('asignaturas.create')
				@include('partials.button_create', ['route' => route('asignaturas.create')])
			@endcan
			@can('asignaturas.fechas.index')
				@include('partials.button_date', ['route' => route('asignaturas.fechas.index', $asignatura->id)])
			@endcan
			@can('asignaturas.edit')
				@include('partials.button_edit', ['route' => route('asignaturas.edit', $asignatura->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">Nombre</span>
						</th>
						<td colspan="2">{{ $asignatura->nomb_asig }}</td>
						<th>
							<span class="font-weight-bold">Area</span>
						</th>
						<td colspan="2">{{ $asignatura->getArea() }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Grado</span>
						</th>
						<td>{{ $asignatura->getGrado() }}</td>
						<th>
							<span class="font-weight-bold">Peso</span>
						</th>
						<td>
							<span class="chip">{{ $asignatura->peso_asig }}%</span>
						</td>
						<th>
							<span class="font-weight-bold">Docente</span>
						</th>
						<td>{{ $asignatura->getDocente() }}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Logros primer periodo</span>
						</th>
						<td colspan="5">{!! nl2br($asignatura->log1_asig) !!}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Logros segundo periodo</span>
						</th>
						<td colspan="5">{!! nl2br($asignatura->log2_asig) !!}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Logros tercer periodo</span>
						</th>
						<td colspan="5">{!! nl2br($asignatura->log3_asig) !!}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Logros cuarto periodo</span>
						</th>
						<td colspan="5">{!! nl2br($asignatura->log4_asig) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection