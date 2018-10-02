@extends('layouts.app')
@section('title', 'Ver estudiante')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
     <li class="breadcrumb-item"><a href="{{ route('estudiantes.show', $estudiante->id) }}">Ver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">wc</i> Ver estudiante
		</h1>
		<div>
			@can('estudiantes.edit')
				@include('partials.button_edit', ['route' => route('estudiantes.edit', $estudiante->id)])
			@endcan
		</div>
	</div>
	<div class="card-body">

		<blockquote class="blockquote my-3">
		  <p class="mb-0 typography-subheading">Información del estudiante</p>
		  <hr class="w-100">
		</blockquote>

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped mb-0">
				<tbody>
					<tr>
						<th>
							<span class="font-weight-bold">No. Identificación</span>
						</th>
						<td colspan="2">{{ "{$estudiante->tipo_docu} {$estudiante->docu_estu}" }}</td>
						<th class="text-center">
							<span class="font-weight-bold">Fotografia</span>
						</th>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Nombres</span>
						</th>
						<td colspan="2">
							{{ "{$estudiante->nomb_estu} {$estudiante->pape_estu} {$estudiante->sape_estu}" }}
						</td>
						<td class="text-center align-middle border-left p-1" rowspan="5">
							@if (Storage::disk('estudiante.foto')->exists($estudiante->foto_estu))
								<img class="img-fluid img-thumbnail img-estudiante"
									src="{{ Storage::disk('estudiante.foto')->url($estudiante->foto_estu) }}"
									alt="{{ $estudiante->nomb_estu }}">
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
							<span class="font-weight-bold">Sexo</span>
						</th>
						<td colspan="2">{{ $estudiante->getSexo() }}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Fecha de nacimiento</span>
						</th>
						<td colspan="2">{{ optional($estudiante->fech_naci)->format('d/m/Y') }}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Dirección de residencia</span>
						</th>
						<td colspan="2">{{ $estudiante->dire_estu }}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Barrio de residencia</span>
						</th>
						<td colspan="2">{{ $estudiante->barr_estu }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Correo electrónico</span>
						</th>
						<td>{{ $estudiante->corr_estu }}</td>
						<th>
							<span class="font-weight-bold">Teléfono</span>
						</th>
						<td>{{ $estudiante->tele_estu }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Nombre del padre</span>
						</th>
						<td>{{ $estudiante->padr_estu }}</td>
						<th>
							<span class="font-weight-bold">Nombre de la madre</span>
						</th>
						<td>{{ $estudiante->madr_estu }}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Colegio de procedencia</span>
						</th>
						<td>{{ $estudiante->cole_prov }}</td>
						<th>
							<span class="font-weight-bold">Nombre E.P.S.</span>
						</th>
						<td>{{ $estudiante->eps_estu }}</td>
					</tr>
					<tr>
						<th class="text-nowrap">
							<span class="font-weight-bold">Tipo de estudiante</span>
						</th>
						<td>{{ $estudiante->getTipoEstudiante()}}</td>
						<th>
							<span class="font-weight-bold">Grado</span>
						</th>
						<td>{{ $estudiante->getSubGradoNombre() }}</td>
					</tr>
					<tr>
						<th>
							<span class="font-weight-bold">Nombre acudiente</span>
						</th>
						<td>{{ $estudiante->getAcudiente() }}</td>
						<th class="text-nowrap">
							<span class="font-weight-bold">Parentesco acudiente</span>
						</th>
						<td>{{ $estudiante->getParentesco() }}</td>
					</tr>
					@can('estudiantes.download')
						<tr>
							<th class="text-nowrap">
								<span class="font-weight-bold">Descargar documentos</span>
							</th>
							<td colspan="3">
								<div class="dropdown">
								  	<button aria-expanded="false" aria-haspopup="true" class="btn dropdown-toggle" data-toggle="dropdown" id="download" type="button">
								  		··· Seleccione un documento ···
								  	</button>
								  	<div aria-labelledby="download" class="dropdown-menu menu">
									    <a class="dropdown-item" href="{{ route('estudiantes.download', [$estudiante->id, encrypt('copi_grad')]) }}">
									    	<i class="material-icons mr-1">cloud_download</i> Certificado de grado
									    </a>
									    <a class="dropdown-item" href="{{ route('estudiantes.download', [$estudiante->id, encrypt('carn_vacu')]) }}">
									    	<i class="material-icons mr-1">cloud_download</i> Carnet de vacunación
									    </a>
									    <a class="dropdown-item" href="{{ route('estudiantes.download', [$estudiante->id, encrypt('copi_docu')]) }}">
									    	<i class="material-icons mr-1">cloud_download</i> Documento de identidad
									    </a>
									    <a class="dropdown-item" href="{{ route('estudiantes.download', [$estudiante->id, encrypt('foto_estu')]) }}">
									    	<i class="material-icons mr-1">cloud_download</i> Fotografia
									    </a>
								  	</div>
								</div>
							</td>
						</tr>
					@endcan
					<tr>
						<th>
							<span class="font-weight-bold">Observaciones</span>
						</th>
						<td colspan="3">{!! nl2br($estudiante->obse_estu) !!}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<blockquote class="blockquote my-4">
		  <p class="mb-0 typography-subheading">Útiles escolares asignados</p>
		  <hr class="w-100">
		</blockquote>

        @if ($implementos->isNotEmpty())
			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
			        <thead>
			            <tr>
			            	<th>#</th>
			                <th>Utiles</th>
			                <th>Unidades</th>
			                <th>Actualizado</th>
			            </tr>
			        </thead>
			        <tbody>
			           	@foreach($implementos as $implemento)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td class="text-nowrap">{{ $implemento->nomb_util }}</td>
								<td class="text-nowrap">{{ $implemento->pivot->cant_util }}</td>
								<td>
									{{ optional($implemento->pivot->updated_at)->format('l d, F Y') }}
								</td>
							</tr>
						@endforeach
					</tbody>
		        </table>
		    </div>
		@else
			@component('partials.alert_empty')
				No hay útiles escolares registrados.
			@endcomponent
		@endif
	</div>

	@if ($implementos->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $implementos->appends(request()->query())->links() }}
	  	</div>
  	@endif

</div>
@endsection