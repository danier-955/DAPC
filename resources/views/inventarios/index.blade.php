@extends('layouts.app')
@section('title', 'Utiles')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('inventarios.create') }}">Inventario</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">library_books</i> Inventario
		</h1>
		@can('inventarios.create')
			@include('partials.button_create', ['route' => route('inventarios.create')])
		@endcan
	</div>
	<div class="card-body">

		@if ($inventarios->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
			                <th class="text-nowrap">Administrativo</th>
			                <th>Util Escolar</th>
			                <th>Unidades</th>
			               
						</tr>
					</thead>
					<tbody>
						@foreach($inventarios as $inventario)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $inventario->getAdministrativo() }}</td>
								<td>{{ $inventario->getImplemento()}}</td>
								<td>{{ $inventario->stoc_inve }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			@component('partials.alert_empty')
				No hay Utiles registrados.
			@endcomponent
		@endif
	</div>
	@if ($inventarios->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $inventarios->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection