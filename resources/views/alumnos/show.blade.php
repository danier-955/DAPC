@extends('layouts.app')
@section('title', 'Ver alumno')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Aumnos</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('alumnos.show', $alumno->id) }}">Ver</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>

	<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">assignment_ind</i> Ver alumno
			</h1>
			<div>
				@can('alumnos.create')
					@include('partials.button_create', ['route' => route('alumnos.create')])
				@endcan
				@can('alumnos.edit')
					@include('partials.button_edit', ['route' => route('alumnos.edit', $alumno->id)])
				@endcan
				@can('alumnos.edit')
					@include('partials.button_programas', ['route' => route('alumnosprogramas.create')])
				@endcan
			</div>
		</div>
		<div class="card-body">

			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
					<tbody>
						<tr>
							<th>
								<span class="font-weight-bold">tipo de documento</span>
							</th>
							<td>{{ "{$alumno->tipo_docu} {$alumno->docu_alum}" }}</td>
							<th>
								<span class="font-weight-bold">Nombre</span>
							</th>
							<td>{{ "{$alumno->nomb_alum} {$alumno->pape_alum} {$alumno->sape_alum}" }}</td>
						</tr>

						<tr>
							<th>
								<span class="font-weight-bold">Sexo</span>
							</th>
							<td>{{ $alumno->getSexo() }}</td>
							<th>
								<span class="font-weight-bold">Fecha Nacimiento</span>
							</th>						
							<td>{{ optional($alumno->fech_naci)->format(' d/m/Y') }}</td>
						</tr>

						<tr>
							<th>
								<span class="font-weight-bold">Direccion</span>
							</th>
							<td>{{ $alumno->dire_alum }}</td>
							<th>
								<span class="font-weight-bold">Barrio</span>
							</th>
							<td>{{ $alumno->barr_alum }}</td>
						</tr>

						<tr>
							<th>
								<span class="font-weight-bold">Correo</span>
							</th>
							<td>{{ $alumno->corr_alum }}</td>
							<th>
								<span class="font-weight-bold">Telefono</span>
							</th>
							<td>{{ $alumno->tele_alum }}</td>
						</tr>

						<tr>
							<th>
								<span class="font-weight-bold">Nombre del Acudiente</span>
							</th>
							<td>{{ $alumno->nomb_acud }}</td>
							<th>
								<span class="font-weight-bold">Parentesco</span>
							</th>
							<td>{{ $alumno->getParentesco() }}</td>
						</tr>

						<tr>
							<th>
								<span class="font-weight-bold">Observacion</span>
							</th>
							<td colspan="5">{{ $alumno->obse_alum }}</td>					
						</tr>

					</tbody>
				</table>
			</div>
			
			<blockquote class="blockquote my-4">
	          <p class="mb-0 typography-subheading">Programas de Formacion</p>
	          <hr class="w-100">
	        </blockquote>

			@if ($alumnoprogramas->isNotEmpty())
				<div class="table-responsive">
					<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
				        <thead>
				            <tr>
				            	<th>#</th>
				                <th class="text-nowrap">Programa</th>
				                <th class="text-nowrap text-center">Opción</th>
				            </tr>
				        </thead>
				        <tbody>
				           	@foreach($alumnoprogramas as $alumnoprograma)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td class="text-nowrap">{{ $alumnoprograma->getPrograma() }}</td>

									<td class="text-nowrap text-center">

										@can('alumnosprogramas.edit')
											@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('alumnosprogramas.edit', $alumnoprograma->id)])
										@endcan

										@can('alumnoprogramas.destroy')
											@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('alumnosprogramas.destroy', $alumnoprograma->id)])
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
			        </table>
			    </div>
			@else
				@component('partials.alert_empty')
					No hay programas registrados.
				@endcomponent
			@endif
		</div>
		@if ($alumnoprogramas->hasPages())
		  	<hr class="my-0 w-100">
		  	<div class="card-actions align-items-center justify-content-center px-3">
		    	{{ $alumnoprogramas->appends(request()->query())->links() }}
		  	</div>
	  	@endif
		</div>
	</div>
@endsection()