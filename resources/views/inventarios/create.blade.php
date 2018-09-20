@extends('layouts.app')
@section('title', 'Registrar útiles')

@section('content')
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('inventarios.index') }}">Inventarios</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('inventarios.create') }}">Registrar</a></li>
    	<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  	</ol>
</nav>

<div class="card">
	<div class="card-header">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">library_books</i> Registrar útiles
  		</h1>
  	</div>
	<div class="card-body">

		<form id="storeUtiles" method="post" action="{{ route('inventarios.store') }}" autocomplete="off">
			{{ csrf_field() }}

			<div class="form-row">
				<div class="form-group col-md-5">
				    <label>Estudiante</label>
				    <select name="estudiante_id" class="form-control" required autofocus>
				    	<option value="">··· Seleccione ···</option>
			            @foreach($estudiantes->chunk(15) as $chunk)
			                @foreach($chunk as $estudiante)
			                  	<option value="{{ $estudiante->id }}">
			                    	{{ "{$estudiante->nomb_estu} {$estudiante->pape_estu} {$estudiante->sape_estu}" }}
			                  	</option>
		        			@endforeach
		        		@endforeach
				    </select>
		            <div id="error_estudiante_id"></div>
				</div>
				<div class="form-group col-md-5">
				    <label>Útiles</label>
				    <select name="implemento_id" class="form-control" required autofocus>
				    	<option value="">··· Seleccione ···</option>
			            @foreach($implementos->chunk(15) as $chunk)
				            @foreach($chunk as $immplemento)
			                  	<option value="{{ $immplemento->id }}">
			                    	{{ $immplemento->nomb_util }}
			                  	</option>
			        		@endforeach
		        		@endforeach
				    </select>
		           <div id="error_implemento_id"></div>
				</div>
				<div class="form-group col-md-2">
			    	<label>Unidades</label>
			   		 <input type="number" name="cant_util" class="form-control" required autofocus>
	                <div id="error_cant_util"></div>
			  	</div>
			</div>

			<div class="row clearfix">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="form-group text-center py-2">
						<button type="reset" class="btn btn-secondary">Limpiar</button>
			  			<button type="submit" class="btn btn-primary">Registrar</button>
						<span class="loading mx-3" style="display: none;">
							<i class="fas fa-sync fa-spin fa-2x align-middle"></i>
						</span>
					</div>
				</div>
			</div>
		</form>
	  	<hr class="mt-0 w-100">

		<div class="table-responsive">
			<table cellspacing="0" cellpadding="0" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Estudiante</th>
						<th>Útil</th>
						<th>Unidades</th>
						<th>Opción</th>
					</tr>
				</thead>
				<tbody id="indexUtiles"></tbody>
			</table>
		</div>

	</div>
</div>
@endsection

@push('scripts')
	@mix('js/inventario.js')
@endpush





