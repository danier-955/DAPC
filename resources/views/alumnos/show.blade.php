@extends('layouts.app')
@section('title', 'Ver alumno')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Aumnos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('alumnos.show', $alumno->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">people</i> Ver alumno
		</h1>
		<div>
			@can('alumnos.create')
				@include('partials.button_create', ['route' => route('alumnos.create')])
			@endcan
			@can('alumnos.edit')
				@include('partials.button_edit', ['route' => route('alumnos.edit', $alumno->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<blockquote class="blockquote my-3">
          <p class="mb-0 typography-subheading">Información del alumno</p>
          <hr class="w-100">
        </blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">No. Identificación</span>
						</th>
						<td>{{ "{$alumno->tipo_docu} {$alumno->docu_alum}" }}</td>
						<th>
							<span class="font-weight-bold">Nombre</span>
						</th>
						<td>
							{{ "{$alumno->nomb_alum} {$alumno->pape_alum} {$alumno->sape_alum}" }}
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Sexo</span>
						</th>
						<td>{{ $alumno->getSexo() }}</td>
						<th>
							<span class="font-weight-bold">Fecha de nacimiento</span>
						</th>
						<td>{{ optional($alumno->fech_naci)->format('l d, F Y') }}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Dirección de residencia</span>
						</th>
						<td>{{ $alumno->dire_alum }}</td>
						<th>
							<span class="font-weight-bold">Barrio de residencia</span>
						</th>
						<td>{{ $alumno->barr_alum }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Correo electrónico</span>
						</th>
						<td>{{ $alumno->corr_alum }}</td>
						<th>
							<span class="font-weight-bold">Teléfono</span>
						</th>
						<td>{{ $alumno->tele_alum }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Nombre acudiente</span>
						</th>
						<td>{{ $alumno->nomb_acud }}</td>
						<th>
							<span class="font-weight-bold">Parentesco acudiente</span>
						</th>
						<td>{{ $alumno->getParentesco() }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="5">{!! nl2br($alumno->obse_alum) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<blockquote class="blockquote my-4">
          <p class="mb-0 typography-subheading">Programas de formación asociados</p>
          <hr class="w-100">
        </blockquote>

		@if ($alumno->programas->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
			        <thead>
			            <tr>
			            	<th>#</th>
			                <th>Nombre</th>
			                <th>Registrado</th>
			            </tr>
			        </thead>
			        <tbody>
			           	@foreach($alumno->programas as $programa)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $programa->nomb_prog }}</td>
								<td>
									{{ optional($programa->pivot->created_at)->format('d/m/Y \· h:m a') }}
								</td>
							</tr>
						@endforeach
					</tbody>
		        </table>
		    </div>
		@else
			@component('partials.alert_empty')
				No hay programas registrados.
			@endcomponent
		@endif

	</div>
</div>
@endsection