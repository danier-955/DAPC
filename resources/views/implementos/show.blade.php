@extends('layouts.app')
@section('title', 'Ver útil escolar')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('implementos.index') }}">Útiles escolares</a></li>
    <li class="breadcrumb-item"><a href="{{ route('implementos.show',$implemento->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">brush</i> Ver útil escolar
		</h1>
		<div>
			@can('implementos.create')
				@include('partials.button_create', ['route' => route('implementos.create')])
			@endcan
			@can('implementos.edit')
				@include('partials.button_edit', ['route' => route('implementos.edit', $implemento->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<blockquote class="blockquote my-3">
          <p class="mb-0 typography-subheading">Información del útil escolar</p>
          <hr class="w-100">
        </blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tr>
					<th>
						<span class="font-weight-bold">Nombre</span>
					</th>
					<td>{{ $implemento->nomb_util }}</td>
				</tr>
				<tr>
					<th>
						<span class="font-weight-bold">Descripción</span>
					</th>
					<td>{!! nl2br($implemento->desc_util) !!}</td>
				</tr>
			</table>
		</div>

		<blockquote class="blockquote my-4">
          <p class="mb-0 typography-subheading">Subgrados asociados</p>
          <hr class="w-100">
        </blockquote>

		@if ($implemento->subGrados->isNotEmpty())
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
			           	@foreach($implemento->subGrados as $subgrado)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									{{ optional($subgrado->grado)->abre_grad . ' &middot; ' . $subgrado->abre_subg . ' &middot; Jornada '. optional($subgrado->grado)->getJornada() }}
								</td>
								<td>
									{{ optional($subgrado->pivot->created_at)->format('d/m/Y \· h:m a') }}
								</td>
							</tr>
						@endforeach
					</tbody>
		        </table>
		    </div>
		@else
			@component('partials.alert_empty')
				No hay subgrados registrados.
			@endcomponent
		@endif

	</div>
</div>
@endsection