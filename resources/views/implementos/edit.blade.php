@extends('layouts.app')
@section('title', 'Editar implemento')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('implementos.index') }}">Utiles</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('implementos.edit', $implemento->id) }}">Editar</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>

	<div class="card">
		<div class="card-header">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">library_books</i> Editar Util
			</h1>
		</div>

		<div class="card-body">
			<form method="post" action="{{ route('implementos.update', $implemento->id) }}" autocomplete="off" >
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				<div class="form-row">

					<div class="form-group col-md-12">
				    	<label>Util</label>
				   		<input type="text" name="nomb_util" class="form-control {{ $errors->has('nomb_util') ? 'is-invalid' : '' }}" value="{{ old('nomb_util', $implemento->nomb_util) }}"  autofocus>
		                @if ($errors->has('nomb_util'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_util') }}
		                    </div>
		               	@endif
				  	</div>
			
				</div>
				<div class="form-row">
			 		<div class="form-group col-md-12">
				    	<label>Observaciòn</label>
				    	<textarea name="desc_util" rows="3" class="form-control {{ $errors->has('desc_util') ? 'is-invalid' : '' }}" autofocus>{{ old('desc_util', $implemento->desc_util) }}
			    		</textarea>
		                @if ($errors->has('desc_util'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('desc_util') }}
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