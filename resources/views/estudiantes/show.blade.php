@extends('layouts.app')
@section('title', 'Ver estudiante')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
	     <li class="breadcrumb-item"><a href="{{ route('estudiantes.show',$estudiante->id) }}">ver</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">wc</i> Ver Estudiantes
			</h1>
			<div>
			
				@can('estudiantes.edit')
					@include('partials.button_edit', ['route' => route('estudiantes.edit', $estudiante->id)])
				@endcan
				
			</div>
		</div>
		<div class="card-body">
			
		
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
					<tbody>
						<tr>
							<th>
								<span class="font-weight-bold">No. documento</span>
							</th>
							<td>{{ "{$estudiante->tipo_docu} {$estudiante->docu_estu}" }}</td>
							<th>
								<span class="font-weight-bold">Nombres</span>
							</th>
							<td>{{ "{$estudiante->nomb_estu} {$estudiante->pape_estu} {$estudiante->sape_estu}" }}</td>
							<th class="text-center" colspan="2">
								<span class="font-weight-bold">Fotografia</span>
							</th>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Sexo</span>
							</th>
							<td>{{ $estudiante->getSexo() }}</td>
							<th>
								<span class="font-weight-bold">Fecha Nacimiento</span>
							</th>						
							<td>{{ optional($estudiante->fech_naci)->format(' d/m/Y') }}</td>
							<td colspan="2" rowspan="4">
								<img class="img-fluid img-thumbnail" src="{{ Storage::disk('estudiante.foto')->url($estudiante->foto_estu) }}" alt="Foto" style="height: 200px; width: 200px">
							</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Direccion</span>
							</th>
							<td>{{ $estudiante->dire_estu }}</td>
							<th>
								<span class="font-weight-bold">Barrio</span>
							</th>
							<td>{{ $estudiante->barr_estu }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Correo</span>
							</th>
							<td>{{ $estudiante->corr_estu }}</td>
							<th>
								<span class="font-weight-bold">Telefono</span>
							</th>
							<td>{{ $estudiante->tele_estu }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Nombre del Padre</span>
							</th>
							<td>{{ $estudiante->padr_estu }}</td>
							<th>
								<span class="font-weight-bold">Nombre de la Madre</span>
							</th>
							<td>{{ $estudiante->madr_estu }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Parentesco</span>
							</th>
							<td colspan="2">{{ $estudiante->getParentesco() }}</td>
							<th>
								<span class="font-weight-bold">Colegio Anterior</span>
							</th>
							<td colspan="2">{{ $estudiante->cole_prov }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Eps</span>
							</th>
							<td colspan="2">{{ $estudiante->eps_estu }}</td>
							<th>
								<span class="font-weight-bold">Tipo de Estudiante</span>
							</th>
							<td colspan="2">{{ $estudiante->getTipoEstudiante()}}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Grado</span>
							</th>
							<td colspan="2">{{ $estudiante->getSubGradoNombre() }}</td>
							<th>
								<span class="font-weight-bold">Acudiente</span>
							</th>
							<td colspan="2">{{ $estudiante->getAcudiente() }}</td>
						</tr>
						<tr>
							<th>
								<span class="font-weight-bold">Descargar documento</span>
							</th>
							<td>
								<div class="dropdown">
								  <button aria-expanded="false" aria-haspopup="true" class="btn dropdown-toggle" data-toggle="dropdown" id="download" type="button">
								  	··· Seleccione ···
								  </button>
								  <div aria-labelledby="download" class="dropdown-menu menu">
								    <a class="dropdown-item" href="{{ route('estudiante.download', [$estudiante->id, encrypt('copi_grad')]) }}">
								    	<i class="material-icons">cloud_download</i> Certificado de grado
								    </a>
								    <a class="dropdown-item" href="{{ route('estudiante.download', [$estudiante->id, encrypt('carn_vacu')]) }}">
								    	<i class="material-icons">cloud_download</i> Carnet de vacunación
								    </a>
								    <a class="dropdown-item" href="{{ route('estudiante.download', [$estudiante->id, encrypt('copi_docu')]) }}">
								    	<i class="material-icons">cloud_download</i> Documento de identidad
								    </a>
								    <a class="dropdown-item" href="{{ route('estudiante.download', [$estudiante->id, encrypt('foto_estu')]) }}">
								    	<i class="material-icons">cloud_download</i> Fotografia
								    </a>
								  </div>
								</div>
							</td>
						</tr>	
						<tr>
							<th>
								<span class="font-weight-bold">Observacion</span>
							</th>
							<td colspan="5">{{ $estudiante->obse_estu }}</td>					
						</tr>
					</tbody>
				</table>
			</div>
			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Utiles Escolares</p>
			  <hr class="w-100">
			</blockquote>


	        @if ($utiles->isNotEmpty())
				<div class="table-responsive">
					<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
				        <thead>
				            <tr>
				            	<th>#</th>
				                <th>Utiles</th>
				                <th>Unidades</th>
				            </tr>
				        </thead>
				        <tbody>
				           	@foreach($utiles as $util)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td class="text-nowrap">{{ $util->getImplemento() }}</td>
									<td class="text-nowrap">{{ $util->cant_util }}</td>
									
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
		@if ($utiles->hasPages())
		  	<hr class="my-0 w-100">
		  	<div class="card-actions align-items-center justify-content-center px-3">
		    	{{ $utiles->appends(request()->query())->links() }}
		  	</div>
	  	@endif
		</div>
	</div>
@endsection