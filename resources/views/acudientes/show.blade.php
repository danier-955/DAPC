@extends('layouts.app')
@section('title', 'Ver acudiente')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('acudientes.index') }}">Acudientes</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('acudientes.show', $acudiente->id) }}">Ver</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>

	<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">group</i> Ver Acudientes
			</h1>
			<div>
				
				@can('acudientes.edit')
					@include('partials.button_edit', ['route' => route('acudientes.edit', $acudiente->id)])
				@endcan
				
				
			</div>
		</div>
		<div class="card-body">
			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Información del Acudientes</p>
			  <hr class="w-100">
			</blockquote>

			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
					<tbody>
						<tr>
							<th>
								<span class="font-weight-bold">Tipo de Documento</span>
							</th>
							<td>{{ $acudiente->tipo_docu }}</td>
							<th>
								<span class="font-weight-bold">Tipo de Documento</span>
							</th>
							<td>{{ $acudiente->docu_acud }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Tipo de Documento</span>
							</th>
							<td>{{ "{$acudiente->nomb_acud} {$acudiente->pape_acud} {$acudiente->sape_acud}" }}</td>
							<th>
								<span class="font-weight-bold">Sexo</span>
							</th>
							<td>{{ $acudiente->getSexo() }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Direcion</span>
							</th>
							<td>{{ $acudiente->dire_acud }}</td>
							<th>
								<span class="font-weight-bold">Barrio</span>
							</th>
							<td>{{ $acudiente->barr_acud }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Correo</span>
							</th>
							<td>{{ $acudiente->corr_acud }}</td>
							<th>
								<span class="font-weight-bold">Telefono</span>
							</th>
							<td>{{ $acudiente->tele_acud }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Profesion del Acudiente</span>
							</th>
							<td>{{ $acudiente->prof_acud }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection