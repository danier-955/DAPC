@extends('layouts.app')
@section('title', 'Ver docente')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('docentes.show', $docente->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Ver docente
		</h1>
		<div>
			@can('docentes.create')
				@include('partials.button_create', ['route' => route('docentes.create')])
			@endcan
			@can('docentes.edit')
				@include('partials.button_edit', ['route' => route('docentes.edit', $docente->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<blockquote class="blockquote my-3">
		  <p class="mb-0 typography-subheading">Información del docente</p>
		  <hr class="w-100">
		</blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">No. Identificación</span>
						</th>
						<td>{{ $docente->docu_doce }}</td>
						<th>
							<span class="font-weight-bold">Nombres</span>
						</th>
						<td>
							{{ "{$docente->nomb_doce} {$docente->pape_doce} {$docente->pape_doce}" }}
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Sexo</span>
						</th>
						<td>{{ $docente->getSexo() }}</td>
						<th>
							<span class="font-weight-bold">Correo electrónico</span>
						</th>
						<td>{{ $docente->corr_doce }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Dirección de residencia</span>
						</th>
						<td>{{ $docente->dire_doce }}</td>
						<th>
							<span class="font-weight-bold">Barrio de residencia</span>
						</th>
						<td>{{ $docente->barr_doce }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Teléfono</span>
						</th>
						<td>{{ $docente->tele_doce }}</td>
						<th>
							<span class="font-weight-bold">Titulo profesional</span>
						</th>
						<td>{{ $docente->titu_doce }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Especializaciones</span>
						</th>
						<td colspan="3">{{ $docente->espe_doce }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Experiencia laboral</span>
						</th>
						<td colspan="3">{!! nl2br($docente->expe_doce) !!}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="3">{!! nl2br($docente->obse_doce) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<blockquote class="blockquote my-4">
		  <p class="mb-0 typography-subheading">Información del empleado</p>
		  <hr class="w-100">
		</blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">Fecha de ingreso</span>
						</th>
						<td>
							{{ optional($docente->empleado->fech_ingr)->format('l d, F Y') }}
						</td>
						<th>
							<span class="font-weight-bold">Estado</span>
						</th>
						<td>
							<span class="chip {{ optional($docente->user)->getEstadoColor() }}">
								{{ optional($docente->user)->getEstadoNombre() }}
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Tipo de empleado</span>
						</th>
						<td>{{ optional($docente->empleado->tipoEmpleado)->nomb_tipo }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="3">{!! nl2br(optional($docente->empleado)->obse_empl) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection
