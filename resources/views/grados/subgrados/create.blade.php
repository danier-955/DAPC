@extends('layouts.app')
@section('title', 'Registrar subgrado')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
	<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	<li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
	<li class="breadcrumb-item"><a href="{{ route('grados.show', $grado->id) }}">Ver</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grados.subgrados.create', $grado->id) }}">
    	Subgrados <i class="material-icons">chevron_right</i> Registrar
    </a></li>
	<li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>
<div class="card">
	<div class="card-header bg-light-2">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">school</i> Registrar subgrado
  		</h1>
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
          <p class="mb-0 typography-subheading">Información del subgrado</p>
          <hr class="w-100">
        </blockquote>

		<form  method="post" action="{{ route('grados.subgrados.store', $grado->id) }}" autocomplete="off">
			{{ csrf_field() }}

			<div class="form-row">
				<div class="form-group col-md-3">
			    	<label>Abreviación (letra o número)</label>
			   		<input type="text" name="abre_subg" class="form-control {{ $errors->has('abre_subg') ? 'is-invalid' : '' }}" value="{{ old('abre_subg') }}" required autofocus>
	                @if ($errors->has('abre_subg'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('abre_subg') }}
	                    </div>
	               	@endif
		  		</div>
		  		<div class="form-group col-md-3">
			    	<label>Máximo número de estudiantes</label>
			   		 <input type="number" name="cant_estu" class="form-control {{ $errors->has('cant_estu') ? 'is-invalid' : '' }}" value="{{ old('cant_estu') }}" required autofocus>
	                @if ($errors->has('cant_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('cant_estu') }}
	                    </div>
	               	@endif
		  		</div>
		 		<div class="form-group col-md-6">
				    <label>Director de grupo</label>
				    <select name="docente_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('docente_id') ? 'is-invalid' : '' }}"  data-live-search="true" data-live-search-placeholder="Búscar ..."  autofocus>
				    	@empty(old('docente_id'))
                          	<option value="">··· Seleccione ···</option>
                      	@endempty
			            @foreach($docentes->chunk(15) as $chunk)
			                @foreach($chunk as $docente)
			                  	<option value="{{ $docente->id }}"
			                    	@if (old('docente_id') === $docente->id){{ 'selected' }}@endif>
			                    	{{ "{$docente->nomb_doce} {$docente->pape_doce} {$docente->sape_doce}" }}
			                  	</option>
	            			@endforeach
	            		@endforeach
				    </select>
	                @if ($errors->has('docente_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('docente_id') }}
	                    </div>
	               	@endif
		 		</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-12 text-center">
		  			<hr class="w-100">
			  		<button type="reset" class="btn btn-secondary">Limpiar</button>
			  		<button type="submit" class="btn btn-primary">Registrar</button>
			  	</div>
			</div>
		</form>

	</div>
</div>
@endsection