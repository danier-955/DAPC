@extends('layouts.app')
@section('title', 'Ver seguimiento')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('seguimientos.index') }}">Seguimientos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('seguimientos.show', $seguimiento->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">file_copy</i> Ver seguimiento
		</h1>
		<div>
			@can('seguimientos.create')
				@include('partials.button_create', ['route' => route('seguimientos.create')])
			@endcan
			@can('seguimientos.edit')
				@include('partials.button_edit', ['route' => route('seguimientos.edit', $seguimiento->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">Practicante</span>
						</th>
						<td>{{ $seguimiento->getPracticante() }}</td>
						<th>
							<span class="font-weight-bold">Docente</span>
						</th>
						<td>{{ $seguimiento->getDocente() }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Fecha</span>
						</th>
						<td>{{ optional($seguimiento->fech_segu)->format('l d, F Y') }}</td>
						<th>
							<span class="font-weight-bold">Horas cumplidas</span>
						</th>
						<td>{{ $seguimiento->hora_cump }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Hora llegada</span>
						</th>
						<td>{{ $seguimiento->hora_lleg }}</td>
						<th>
							<span class="font-weight-bold">Hora salida</span>
						</th>
						<td>{{ $seguimiento->hora_sali }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Actividades realizadas</span>
						</th>
						<td colspan="3">{!! nl2br($seguimiento->acti_real) !!}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="3">{!! nl2br($seguimiento->obse_segu) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection
