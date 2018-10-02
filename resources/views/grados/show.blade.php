@extends('layouts.app')
@section('title', 'Ver grado')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
	<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	<li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
	<li class="breadcrumb-item"><a href="{{ route('grados.show', $grado->id) }}">Ver</a></li>
	<li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">school</i> Ver grado
  		</h1>
		<div>
			@can('grados.subgrados.create')
				@include('partials.button_subgrado', ['route' => route('grados.subgrados.create', $grado->id)])
			@endcan
			@can('grados.create')
				@include('partials.button_create', ['route' => route('grados.create')])
			@endcan
			@can('grados.edit')
				@include('partials.button_edit', ['route' => route('grados.edit', $grado->id)])
			@endcan
		</div>
  	</div>
	<div class="card-body">

        <blockquote class="blockquote my-3">
          <p class="mb-0 typography-subheading">Información del grado</p>
          <hr class="w-100">
        </blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">Nombre</span>
						</th>
						<td>{{ $grado->nomb_grad }}</td>
						<th>
							<span class="font-weight-bold">Abreviación &middot; Jornada</span>
						</th>
						<td>
							{{ "{$grado->abre_grad} &middot; Jornada {$grado->getJornada()}" }}
						</td>
					</tr>
				</tbody>
			</table>
		</div>

        <blockquote class="blockquote my-4">
          <p class="mb-0 typography-subheading">Subgrados asociados</p>
          <hr class="w-100">
        </blockquote>

        @if ($grado->subGrados->isNotEmpty())
            <div class="table-responsive">
                <table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Abreviación</th>
                            <th>Capacidad estudiantes</th>
                            <th>Director de grupo</th>
                            <th class="text-center">Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $iteration = 1;
                        @endphp
                        @foreach($grado->subGrados->chunk(15) as $chunk)
                            @foreach($chunk as $subgrado)
                                <tr>
                                    <td>{{ $iteration++ }}</td>
                                    <td>{{ $subgrado->abre_subg }}</td>
                                    <td>{{ $subgrado->cant_estu }}</td>
                                    <td>{{ $subgrado->getDirectorNombre() }}</td>
                                    <td class="text-center">
                                        @can('grados.subgrados.edit')
                                            @include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('grados.subgrados.edit', [$grado->id, $subgrado->id])])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            @component('partials.alert_empty')
                No hay subgrados asociados.
            @endcomponent
        @endif

	</div>
</div>
@endsection