@extends('layouts.app')
@section('title', 'Ver administrativo')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('administrativos.index') }}">Administrativos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('administrativos.show', $administrativo->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">people_outline</i> Ver administrativo
		</h1>
		<div>
			@can('administrativos.create')
				@include('partials.button_create', ['route' => route('administrativos.create')])
			@endcan
			@can('administrativos.edit')
				@include('partials.button_edit', ['route' => route('administrativos.edit', $administrativo->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<blockquote class="blockquote my-3">
		  <p class="mb-0 typography-subheading">Información del administrativo</p>
		  <hr class="w-100">
		</blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">No. Identificación</span>
						</th>
						<td>{{ $administrativo->docu_admi }}</td>
						<th>
							<span class="font-weight-bold">Nombres</span>
						</th>
						<td>
							{{ "{$administrativo->nomb_admi} {$administrativo->pape_admi} {$administrativo->sape_admi}" }}
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Sexo</span>
						</th>
						<td>{{ $administrativo->getSexo() }}</td>
						<th>
							<span class="font-weight-bold">Correo electrónico</span>
						</th>
						<td>{{ $administrativo->corr_admi }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Dirección de residencia</span>
						</th>
						<td>{{ $administrativo->dire_admi }}</td>
						<th>
							<span class="font-weight-bold">Barrio de residencia</span>
						</th>
						<td>{{ $administrativo->barr_admi }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Teléfono</span>
						</th>
						<td>{{ $administrativo->tele_admi }}</td>
						<th>
							<span class="font-weight-bold">Cargo</span>
						</th>
						<td>{{ $administrativo->getCargo() }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Jornada</span>
						</th>
						<td>{{ $administrativo->getJornada() }}</td>
						<th>
							<span class="font-weight-bold">Titulo profesional</span>
						</th>
						<td>{{ $administrativo->titu_admi }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Especializaciones</span>
						</th>
						<td colspan="3">{{ $administrativo->espe_admi }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Experiencia laboral</span>
						</th>
						<td colspan="3">{!! nl2br($administrativo->expe_admi) !!}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="3">{!! nl2br($administrativo->obse_admi) !!}</td>
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
							{{ optional($administrativo->empleado->fech_ingr)->format('l d, F Y') }}
						</td>
						<th>
							<span class="font-weight-bold">Estado</span>
						</th>
						<td>
							<span class="chip {{ optional($administrativo->user)->getEstadoColor() }}">
								{{ optional($administrativo->user)->getEstadoNombre() }}
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Tipo de empleado</span>
						</th>
						<td>{{ optional($administrativo->empleado->tipoEmpleado)->nomb_tipo }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="3">{!! nl2br(optional($administrativo->empleado)->obse_empl) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection