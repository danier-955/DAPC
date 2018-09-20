@extends('layouts.app')
@section('title', 'Grados')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
		<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
		<li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
		<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header">
	  		<h1 class="typography-headline">
	  			<i class="material-icons mr-1">school</i> Registrar grado
	  		</h1>
	  	</div>
		<div class="card-body">

			<form  method="post" action="#" autocomplete="off">
				{{ csrf_field() }}

				<div class="form-row">
					<div class="form-group col-md-3">
				    	<label>Nombre del Grado</label>
				   		<input type="text" name="nomb_grad" class="form-control" disabled value="{{$grado->nomb_grad}}">
			  		</div>
			  		<div class="form-group col-md-3">
				    	<label>Abreviacion del grado</label>
				   		<input type="number" name="abre_grad" class="form-control" disabled value="{{$grado->abre_grad}}">
			  		</div>
			  		<div class="form-group col-md-3">
				    	<label>Jornada</label>
					    <input type="text" name="" class="form-control" disabled value="{{$grado->getJornada()}} ">
			  		</div>
			  		
				</div>

				<div class="form-row">
					<div class="form-group col-md-12 text-center">
			  			<hr class="w-100">
			  			<a href="{{route('grados.edit',$grado->id)}}" class="btn btn-secondary">Editar</a>
				  	</div>
				</div>
			</form>
		</div>
	</div>
@endsection