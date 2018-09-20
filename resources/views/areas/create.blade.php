@extends('layouts.app')
@section('title', 'Registrar areas')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('areas.index') }}">Areas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('areas.create') }}">Registrar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">font_download</i> Registrar Areas
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('areas.store') }}" autocomplete="off">
			{{ csrf_field() }}

			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Información del Area</p>
			  <hr class="w-100">
			</blockquote>
			
			<div class="form-row">
					<div class="form-group col-md-12">
				    	<label>Nombre del Area </label>
				   		 <input type="text" name="nomb_area" class="form-control {{ $errors->has('nomb_area') ? 'is-invalid' : '' }}" value="{{ old('nomb_area') }}" required autofocus>
		                @if ($errors->has('nomb_area'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_area') }}
		                    </div>
		               	@endif
			  		</div>
			  </div>
			  <div class="form-row">
			 		<div class="form-group col-md-12">
				    	<label>Descripción</label>
				    	<textarea name="desc_area" rows="3" class="form-control {{ $errors->has('desc_area') ? 'is-invalid' : '' }}"  required autofocus>
			    			{{ old('desc_area') }}
			    		</textarea>
		                @if ($errors->has('desc_area'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('desc_area') }}
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
@endsection()