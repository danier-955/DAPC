@extends('layouts.app')
@section('title', 'Sub Grados')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('subgrados.index') }}">Sub grados</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">group</i> Sub grados
		</h1>
		@can('subgrados.create')
			@include('partials.button_create', ['route' => route('subgrados.create')])
		@endcan
	</div>
	<div class="card-body">
		@if ($subGrados->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
			                <th>Abreviacion del sub grado</th>
			                <th>Cantidad de estudiantes</th>
			                <th>Grado</th>
			                <th>Director de Grupo</th>
			                <th>Acción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($subGrados as $subGrado)
							<tr>
								<td>{{$subGrado->abre_subg}} </td>
								<td>{{$subGrado->cant_estu}} </td>
								<td>{{$subGrado->getGrado()}}</td>
								<td>{{ $subGrado->getDirectorNombre()}}</td>
								<td class="text-nowrap text-center">
									@can('subgrados.show')
										@include('partials.button_show', ['route' => route('subgrados.show', $subGrado->id)])
									@endcan
									@can('subgrados.edit')
										@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('subgrados.edit', $subGrado->id)])
									@endcan
									@can('subgrados.destroy')
									@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('subgrados.destroy', $subGrado->id)])
									@endcan
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay Sub grados registrados.
			@endcomponent
		@endif
	</div>
	@if ($subGrados->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $subGrados->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection
