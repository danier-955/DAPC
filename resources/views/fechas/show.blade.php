@extends('layouts.app')
@section('title', 'Ver fecha')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('fechas.index') }}">Fechas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('fechas.show', $fecha->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">date_range</i> Ver fecha
		</h1>
		<div>
			@can('fechas.create')
				@include('partials.button_create', ['route' => route('fechas.create')])
			@endcan
			@can('fechas.edit')
				@include('partials.button_edit', ['route' => route('fechas.edit', $fecha->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">Año de las fechas</span>
						</th>
						<td>
							<div class="chip">{{ $fecha->ano_fech }}</div>
						</td>
						<th>
							<span class="font-weight-bold">Registrado</span>
						</th>
						<td>{{ optional($fecha->created_at)->format('l d, F Y') }}</td>
						<th>
							<span class="font-weight-bold">Actualizado</span>
						</th>
						<td>{{ optional($fecha->updated_at)->format('l d, F Y') }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<blockquote class="blockquote my-4">
		  <p class="mb-0 typography-subheading">Registro notas regulares</p>
		  <hr class="w-100">
		</blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
	                  	<th>&nbsp;</th>
	                  	<th>
	                  		<span class="font-weight-bold">Desde</span>
	                  	</th>
	                  	<th>
	                  		<span class="font-weight-bold">Hasta</span>
	                  	</th>
	                </tr>
	                <tr>
	                  	<th>
	                  		<span class="font-weight-bold">Fechas del primer periodo</span>
	                  	</th>
	                  	<td>{{ datetime_inic_show($fecha->fech_not1) }}</td>
	                  	<td>{{ datetime_fina_show($fecha->fech_not1) }}</td>
	                </tr>
	                <tr>
	                  	<th>
	                  		<span class="font-weight-bold">Fechas del segundo periodo</span>
	                  	</th>
	                  	<td>{{ datetime_inic_show($fecha->fech_not2) }}</td>
	                  	<td>{{ datetime_fina_show($fecha->fech_not2) }}</td>
	                </tr>
	                <tr>
	                  	<th>
	                  		<span class="font-weight-bold">Fechas del tercer periodo</span>
	                  	</th>
	                  	<td>{{ datetime_inic_show($fecha->fech_not3) }}</td>
	                  	<td>{{ datetime_fina_show($fecha->fech_not3) }}</td>
	                </tr>
	                <tr>
	                  	<th>
	                  		<span class="font-weight-bold">Fechas del cuarto periodo</span>
	                  	</th>
	                  	<td>{{ datetime_inic_show($fecha->fech_not4) }}</td>
	                  	<td>{{ datetime_fina_show($fecha->fech_not4) }}</td>
	                </tr>
				</tbody>
			</table>
		</div>

		<blockquote class="blockquote my-4">
		  <p class="mb-0 typography-subheading">Registro notas de recuperación</p>
		  <hr class="w-100">
		</blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
	                  	<th>&nbsp;</th>
	                  	<th>
	                  		<span class="font-weight-bold">Desde</span>
	                  	</th>
	                  	<th>
	                  		<span class="font-weight-bold">Hasta</span>
	                  	</th>
	                </tr>
	                <tr>
	                  	<th>
	                  		<span class="font-weight-bold">Fechas del primer periodo</span>
	                  	</th>
	                  	<td>{{ datetime_inic_show($fecha->fech_rec1) }}</td>
	                  	<td>{{ datetime_fina_show($fecha->fech_rec1) }}</td>
	                </tr>
	                <tr>
	                  	<th>
	                  		<span class="font-weight-bold">Fechas del segundo periodo</span>
	                  	</th>
	                  	<td>{{ datetime_inic_show($fecha->fech_rec2) }}</td>
	                  	<td>{{ datetime_fina_show($fecha->fech_rec2) }}</td>
	                </tr>
	                <tr>
	                  	<th>
	                  		<span class="font-weight-bold">Fechas del tercer periodo</span>
	                  	</th>
	                  	<td>{{ datetime_inic_show($fecha->fech_rec3) }}</td>
	                  	<td>{{ datetime_fina_show($fecha->fech_rec3) }}</td>
	                </tr>
	                <tr>
	                  	<th>
	                  		<span class="font-weight-bold">Fechas del cuarto periodo</span>
	                  	</th>
	                  	<td>{{ datetime_inic_show($fecha->fech_rec4) }}</td>
	                  	<td>{{ datetime_fina_show($fecha->fech_rec4) }}</td>
	                </tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection
