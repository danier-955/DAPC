@extends('layouts.app')
@section('title', 'Registrar Utiles')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('implementos.index') }}">Utiles</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('implementos.show',$implemento->id) }}">ver</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">library_books</i> Ver Utiles
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
			
		
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
					<tr>
						<th>
							<span class="font-weight-bold">Nombre Util</span>
						</th>
						<td>{{ $implemento->nomb_util}}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="3">{!! nl2br($implemento->desc_util) !!}</td>
					</tr>

				</table>
			</div>
		</div>
	</div>
@endsection