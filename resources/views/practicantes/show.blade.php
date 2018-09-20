@extends('layouts.app')
@section('title', 'Ver practicante')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('practicantes.index') }}">Practicantes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('practicantes.show', $practicante->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Ver Practicante
		</h1>
		<div>
			@can('practicantes.create')
				@include('partials.button_create', ['route' => route('practicantes.create')])
			@endcan
			@can('practicantes.edit')
				@include('partials.button_edit', ['route' => route('practicantes.edit', $practicante->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<blockquote class="blockquote my-3">
		  <p class="mb-0 typography-subheading">Información del practicante</p>
		  <hr class="w-100">
		</blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">No. Identificación</span>
						</th>
						<td>
							{{ $practicante->tipo_docu }} {{ $practicante->docu_prac }}
						</td>
						<th>
							<span class="font-weight-bold">Nombres</span>
						</th>
						<td>
							{{ "{$practicante->nomb_prac} {$practicante->pape_prac} {$practicante->sape_prac}" }}
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Sexo</span>
						</th>
						<td>{{ $practicante->getSexo() }}</td>
						<th>
							<span class="font-weight-bold">Correo electrónico</span>
						</th>
						<td>{{ $practicante->corr_prac }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Dirección de residencia</span>
						</th>
						<td>{{ $practicante->dire_prac }}</td>
						<th>
							<span class="font-weight-bold">Barrio de residencia</span>
						</th>
						<td>{{ $practicante->barr_prac }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Teléfono</span>
						</th>
						<td>{{ $practicante->tele_prac }}</td>
						<th>
							<span class="font-weight-bold">Nombre del padre</span>
						</th>
						<td>{{ $practicante->padr_prac }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Nombre de la madre</span>
						</th>
						<td>{{ $practicante->madr_prac }}</td>
						<th>
							<span class="font-weight-bold">Grado asignado</span>
						</th>
						<td>{{ $practicante->getSubGradoNombre() }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Instituto de procedencia</span>
						</th>
						<td colspan="3">{{ $practicante->cole_prov }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Semestre cursante</span>
						</th>
						<td>{{ $practicante->seme_curs }}</td>
						<th>
							<span class="font-weight-bold">Número de horas</span>
						</th>
						<td>{{ $practicante->hora_paga }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Fecha de inicio practicas</span>
						</th>
						<td>{{ optional($practicante->inic_prac)->format('l d, F Y')}}</td>
						<th>
							<span class="font-weight-bold">Fecha final practicas</span>
						</th>
						<td >{{ optional($practicante->fina_prac)->format('l d, F Y')}}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="3">{!! nl2br($practicante->obse_prac) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

        <blockquote class="blockquote my-4">
          <p class="mb-0 typography-subheading">Seguimientos del practicante</p>
          <hr class="w-100">
        </blockquote>

		@if ($seguimientos->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
			        <thead>
			            <tr>
			            	<th>#</th>
			                <th class="text-nowrap">Fecha</th>
			                <th>Llegada</th>
			                <th>Salida</th>
			                <th>Horas</th>
			                <th>Docente</th>
			                <th class="text-nowrap text-center">Opción</th>
			            </tr>
			        </thead>
			        <tbody>
			           	@foreach($seguimientos as $seguimiento)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ optional($seguimiento->fech_segu)->format('l d, F Y') }}</td>
								<td class="text-nowrap">{{ $seguimiento->hora_lleg }}</td>
								<td class="text-nowrap">{{ $seguimiento->hora_sali }}</td>
								<td>{{ $seguimiento->hora_cump }}</td>
								<td>{{ $seguimiento->getDocente() }}</td>
								<td class="text-nowrap text-center">
									@can('seguimientos.show')
										@include('partials.button_show', ['route' => route('seguimientos.show', $seguimiento->id)])
									@endcan
									@can('seguimientos.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('seguimientos.edit', $seguimiento->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
		        </table>
		    </div>
		@else
			@component('partials.alert_empty')
				No hay seguimientos registrados.
			@endcomponent
		@endif
	</div>
	@if ($seguimientos->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $seguimientos->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection