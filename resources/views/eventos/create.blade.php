@extends('layouts.app')
@section('title', 'Registrar evento')

@section('content')
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('eventos.index') }}">Eventos</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('eventos.create') }}">Registrar</a></li>
    	<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  	</ol>
</nav>

<div class="card">
	<div class="card-header">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">event_note</i> Registrar evento
  		</h1>
  	</div>
	<div class="card-body">

		<form  method="post" action="{{ route('eventos.store') }}" autocomplete="off" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-row">
				<div class="form-group col-md-8">
			    	<label>Titulo</label>
			   		 <input type="text" name="titu_even" class="form-control {{ $errors->has('titu_even') ? 'is-invalid' : '' }}" value="{{ old('titu_even') }}" required autofocus>
	                @if ($errors->has('titu_even'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('titu_even') }}
	                    </div>
	               	@endif
		  		</div>
		  		<div class="form-group col-md-4">
			    	<label>Página principal</label>
			   		<div class="custom-control custom-checkbox mt-3">
	                    <input type="checkbox" id="most_even" name="most_even" class="custom-control-input" {{ old('most_even') ? 'checked' : '' }}>
	                    <label class="custom-control-label" for="most_even">
	                    	Visible en página principal
	                    </label>
	                </div>
		  		</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-3">
			    	<label>Fecha inicio</label>
			   		 <input type="text" name="inic_even" class="start-datetimepicker form-control {{ $errors->has('inic_even') ? 'is-invalid' : '' }}" value="{{ old('inic_even') }}" required autofocus>
	                @if ($errors->has('inic_even'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('inic_even') }}
	                    </div>
	               	@endif
		  		</div>
				<div class="form-group col-md-3">
			    	<label>Fecha clausura</label>
			   		 <input type="text" name="fina_even" class="end-datetimepicker form-control {{ $errors->has('fina_even') ? 'is-invalid' : '' }}" value="{{ old('fina_even') }}" required autofocus>
	                @if ($errors->has('fina_even'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fina_even') }}
	                    </div>
	               	@endif
		  		</div>
				<div class="form-group col-md-3">
			    	<label>No. cupos</label>
			   		<input type="number" name="cupo_even" class="form-control {{ $errors->has('cupo_even') ? 'is-invalid' : '' }}" value="{{ old('cupo_even') }}" required autofocus>
	                @if ($errors->has('cupo_even'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('cupo_even') }}
	                    </div>
	               	@endif
		  		</div>
				<div class="form-group col-md-3">
					<label>Jornada</label>
				    <select name="jorn_even" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('jorn_even') ? 'is-invalid' : '' }}" required autofocus>
				    	@empty(old('jorn_even'))
		                    <option value="">··· Seleccione ···</option>
		                @endempty
				    	@foreach($jornadas as $jornada)
				      		<option value="{{ $jornada['id'] }}"
				      		@if (old('jorn_even') === $jornada['id']){{ 'selected' }}@endif>
				      			{{ $jornada['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('jorn_even'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('jorn_even') }}
	                    </div>
	               	@endif
				</div>
			</div>

			<div class="form-row">
		  		<div class="form-group col-md-12">
			    	<label>Fotografía</label>
			   		 <input type="file" name="foto_even" class="file form-control {{ $errors->has('foto_even') ? 'is-invalid' : '' }}" required autofocus>
	                @if ($errors->has('foto_even'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('foto_even') }}
	                    </div>
	               	@endif
		  		</div>
			</div>

			<div class="form-row">
		 		<div class="form-group col-md-12">
			    	<label>Descripción</label>
			    	<textarea name="desc_even" rows="8" class="form-control {{ $errors->has('desc_even') ? 'is-invalid' : '' }}"  required autofocus>{{ old('desc_even') }}</textarea>
	                @if ($errors->has('desc_even'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('desc_even') }}
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
