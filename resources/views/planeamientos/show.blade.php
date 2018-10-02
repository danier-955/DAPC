@extends('layouts.app')
@section('title', 'Ver planeación')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('planeamientos.index') }}">Planeaciones</a></li>
    <li class="breadcrumb-item"><a href="{{ route('planeamientos.show', $planeamiento->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Ver planeación
		</h1>
		<div>
			@can('planeamientos.create')
				@include('partials.button_create', ['route' => route('planeamientos.create')])
			@endcan
			@can('planeamientos.edit')
				@include('partials.button_edit', ['route' => route('planeamientos.edit', $planeamiento->id)])
			@endcan
			@can('planeamientos.destroy')
				@include('partials.button_destroy', ['route' => route('planeamientos.destroy', $planeamiento->id)])
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
						<td>{{ $planeamiento->titu_plan }}</td>
						<th>
							<span class="font-weight-bold">Fecha</span>
						</th>
						<td>{{ optional($planeamiento->fech_plan)->format('l d, F Y') }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Docente</span>
						</th>
						<td>{{ $planeamiento->getDocente() }}</td>
						<th>
							<span class="font-weight-bold">Documento</span>
						</th>
						<td>
							@can('planeamientos.download')
								@include('partials.button_download', ['btnSm' => 'btn-sm', 'route' => route('planeamientos.download', $planeamiento->id)])
							@else
								··· Sin permisos ···
							@endcan
						</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Descripción</span>
						</th>
						<td colspan="3">{!! nl2br($planeamiento->desc_plan) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection
