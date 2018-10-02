@extends('layouts.app')
@section('title', 'Registrar programa')

@section('content')
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('programas.index') }}">Programas</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('programas.create') }}">Registrar</a></li>
    	<li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  	</ol>
</nav>

<div class="card">
	<div class="card-header bg-light-2">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">local_parking</i> Registrar programa
  		</h1>
  	</div>
	<div class="card-body">

		<form  method="post" action="{{ route('programas.store') }}" autocomplete="off" >
			{{ csrf_field() }}

			<div class="form-row">
				<div class="form-group col-md-12">
			    	<label>Nombre</label>
			   		 <input type="text" name="nomb_prog" class="form-control {{ $errors->has('nomb_prog') ? 'is-invalid' : '' }}" value="{{ old('nomb_prog') }}" required autofocus>
	                @if ($errors->has('nomb_prog'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_prog') }}
	                    </div>
	               	@endif
		  		</div>
			</div>

		  	<div class="form-row">
		 		<div class="form-group col-md-12">
			    	<label>Descripción</label>
			    	<textarea name="desc_prog" rows="3" class="form-control {{ $errors->has('desc_prog') ? 'is-invalid' : '' }}" required autofocus>{{ old('desc_prog') }}</textarea>
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
			  		<button type="submit" class="btn btn-primary">Registrar</button>
			  	</div>
			</div>

		</form>

	</div>
</div>
@endsection