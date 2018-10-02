@extends('layouts.app')
@section('title', 'Ver acudiente')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('acudientes.index') }}">Acudientes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('acudientes.show', $acudiente->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Ver acudiente
		</h1>
		<div>
			@can('acudientes.edit')
				@include('partials.button_edit', ['route' => route('acudientes.edit', $acudiente->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">No. Identificación</span>
						</th>
						<td>{{ "{$acudiente->tipo_docu} {$acudiente->docu_acud}" }}</td>
						<th>
							<span class="font-weight-bold">Nombres</span>
						</th>
						<td>
							{{ "{$acudiente->nomb_acud} {$acudiente->pape_acud} {$acudiente->sape_acud}" }}
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Sexo</span>
						</th>
						<td>{{ $acudiente->getSexo() }}</td>
						<th>
							<span class="font-weight-bold">Correo electrónico</span>
						</th>
						<td>{{ $acudiente->corr_acud }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Dirección de residencia</span>
						</th>
						<td>{{ $acudiente->dire_acud }}</td>
						<th>
							<span class="font-weight-bold">Barrio de residencia</span>
						</th>
						<td>{{ $acudiente->barr_acud }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Teléfono</span>
						</th>
						<td>{{ $acudiente->tele_acud }}</td>
						<th>
							<span class="font-weight-bold">Profesión</span>
						</th>
						<td>{{ $acudiente->prof_acud }}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection