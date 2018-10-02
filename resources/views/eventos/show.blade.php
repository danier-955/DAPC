@extends('layouts.app')
@section('title', 'Ver evento')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('eventos.index') }}">Eventos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('eventos.show', $evento->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">event_note</i> Ver evento
		</h1>
		<div>
			@can('eventos.create')
				@include('partials.button_create', ['route' => route('eventos.create')])
			@endcan
			@can('eventos.edit')
				@include('partials.button_edit', ['route' => route('eventos.edit', $evento->id)])
			@endcan
			@can('eventos.destroy')
				@include('partials.button_destroy', ['route' => route('eventos.destroy', $evento->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">Titulo</span>
						</th>
						<td>{{ $evento->titu_even }}</td>
						<th class="text-center">
							<span class="font-weight-bold">Fotografía</span>
						</th>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Fecha inicio</span>
						</th>
						<td class="text-nowrap">
							{{ optional($evento->inic_even)->format('l d, F Y \· h:i a') }}
						</td>
						<td class="text-center align-middle border-left p-1" rowspan="5">
							@if (Storage::disk('evento')->exists($evento->foto_even))
								<img class="img-fluid img-thumbnail img-evento"
									src="{{ Storage::disk('evento')->url($evento->foto_even) }}"
									alt="{{ $evento->titu_even }}">
							@else
								<div class="card-body text-center">
									<p class="typography-display-3 text-black-secondary py-4">
										<i class="material-icons">broken_image</i>
									</p>
									<p class="card-text text-muted">
							      		Sin fotografia para mostrar.
							      	</p>
								</div>
							@endif
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Fecha clausura</span>
						</th>
						<td class="text-nowrap">
							{{ optional($evento->fina_even)->format('l d, F Y \· h:i a') }}
						</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">No. cupos &middot; Jornada</span>
						</th>
						<td>
							<span class="chip">
								{{ $evento->cupo_even }} alumnos
								&middot; {{ $evento->getJornada() }}
							</span>
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Página principal</span>
						</th>
						<td>
							<div class="chip {{ $evento->getVisibleColor() }}">
					    		{{ $evento->getVisibleTitulo() }}
					    	</div>
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Responsable</span>
						</th>
						<td>{{ $evento->getAdministrativo() }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Descripción</span>
						</th>
						<td colspan="2">{!! nl2br($evento->desc_even) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection
