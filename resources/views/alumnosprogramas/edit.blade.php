@extends('layouts.app')
@section('title', 'Editar Programa')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('alumnosprogramas.create') }}">Programa</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('alumnosprogramas.edit', $alumnosprograma->id) }}">Editar</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>

	<div class="card">
		<div class="card-header">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">rate_review</i> Editar Programa
			</h1>
		</div>

		<div class="card-body">
			<form method="post" action="{{ route('alumnosprogramas.update', $alumnosprograma->id) }}" autocomplete="off" >
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				
				<div class="form-row">
					<div class="form-group col-md-4">
			    		<label>Programa</label>
		    			<select name="programa_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('programa_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
		    				@empty(old('programa_id'))
		    				    <option value="{{ $alumnosprograma->programa_id }}" selected>
		    				    	{{ $alumnosprograma->getPrograma() }}
		    				    </option>
		    				@endempty
		      
			      				@foreach($programas as $programa)
			      					<option value="{{ $programa->id }}"
			      						@if (old('programa_id', $alumnosprograma->programa_id) === $programa->id){{ 'selected' }}@endif>
			      						{{ $programa->nomb_prog }}
			      					</option>
			      				@endforeach
		    			</select>
		                @if ($errors->has('programa_id'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('programa_id') }}
		                    </div>
		               	@endif
	 				</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12 text-center">
			  			<hr class="w-100">
				  		<button type="reset" class="btn btn-secondary">Limpiar</button>
				  		<button type="submit" class="btn btn-primary">Actualizar</button>
				  	</div>
				</div>
			</form>
		</div>
	</div>
@endsection