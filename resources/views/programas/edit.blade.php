@extends('layouts.app')
@section('title', 'Editar Programas')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('programas.index') }}">Programas</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('programas.edit', $programa->id) }}">Editar</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>

	<div class="card">
		<div class="card-header">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">rate_review</i> Editar Programa de Formación
			</h1>
		</div>

		<div class="card-body">
			<form method="post" action="{{ route('programas.update', $programa->id) }}" autocomplete="off" >
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				<div class="form-row">
					<div class="form-group col-md-12">
				    	<label>Programa de Formacion</label>
				   		<input type="text" name="nomb_prog" class="form-control {{ $errors->has('nomb_prog') ? 'is-invalid' : '' }}" value="{{ old('nomb_prog', $programa->nomb_prog) }}"  autofocus>
		                @if ($errors->has('nomb_prog'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_prog') }}
		                    </div>
		               	@endif
				  	</div>

					<div class="form-group col-md-12">
				    	<label>Descripción</label>
				    	<textarea name="desc_prog" rows="3" class="form-control {{ $errors->has('desc_prog') ? 'is-invalid' : '' }}" autofocus>{{ old('desc_prog', $programa->desc_prog) }}
			    		</textarea>
		                @if ($errors->has('desc_prog'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('desc_prog') }}
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