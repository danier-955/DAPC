@extends('layouts.app')
@section('title', 'Registrar galeria')

@section('content')
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('galerias.index') }}">Galerias</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('galerias.create') }}">Registrar</a></li>
    	<li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  	</ol>
</nav>

<div class="card">
	<div class="card-header bg-light-2">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">photo_library</i> Registrar galeria
  		</h1>
  	</div>
	<div class="card-body">

		<form  method="post" action="{{ route('galerias.store') }}" autocomplete="off" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-row">
				<div class="form-group col-md-8">
			    	<label>Titulo</label>
			   		 <input type="text" name="titu_gale" class="form-control {{ $errors->has('titu_gale') ? 'is-invalid' : '' }}" value="{{ old('titu_gale') }}" required autofocus>
	                @if ($errors->has('titu_gale'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('titu_gale') }}
	                    </div>
	               	@endif
		  		</div>
		  		<div class="form-group col-md-4">
			    	<label>Página principal</label>
			   		<div class="custom-control custom-checkbox mt-3">
	                    <input type="checkbox" id="most_gale" name="most_gale" class="custom-control-input" {{ old('most_gale') ? 'checked' : '' }}>
	                    <label class="custom-control-label" for="most_gale">
	                    	Visible en página principal
	                    </label>
	                </div>
		  		</div>
			</div>

			<div class="form-row">
		  		<div class="form-group col-md-9">
			    	<label>Fotografía</label>
			   		 <input type="file" name="foto_gale" class="file form-control {{ $errors->has('foto_gale') ? 'is-invalid' : '' }}" required autofocus>
	                @if ($errors->has('foto_gale'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('foto_gale') }}
	                    </div>
	               	@endif
		  		</div>
				<div class="form-group col-md-3">
					<label>Jornada</label>
				    <select name="jorn_gale" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('jorn_gale') ? 'is-invalid' : '' }}" required autofocus>
				    	@empty(old('jorn_gale'))
		                    <option value="">··· Seleccione ···</option>
		                @endempty
				    	@foreach($jornadas as $jornada)
				      		<option value="{{ $jornada['id'] }}"
				      		@if (old('jorn_gale') === $jornada['id']){{ 'selected' }}@endif>
				      			{{ $jornada['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('jorn_gale'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('jorn_gale') }}
	                    </div>
	               	@endif
				</div>
			</div>

			<div class="form-row">
		 		<div class="form-group col-md-12">
			    	<label>Descripción</label>
			    	<textarea name="desc_gale" rows="3" class="form-control {{ $errors->has('desc_gale') ? 'is-invalid' : '' }}"  required autofocus>{{ old('desc_gale') }}</textarea>
	                @if ($errors->has('desc_gale'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('desc_gale') }}
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
