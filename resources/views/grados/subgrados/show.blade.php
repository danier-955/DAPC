@extends('layouts.app')
@section('title', 'Sub Grados')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
		<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
		<li class="breadcrumb-item"><a href="{{ route('subgrados.index') }}">Sub grados</a></li>
		<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header">
	  		<h1 class="typography-headline">
	  			<i class="material-icons mr-1">school</i> Informacion del sub grado
	  		</h1>
	  	</div>
		<div class="card-body">

			<form  method="post" action="#" autocomplete="off">
				{{ csrf_field() }}

				<div class="form-row">
					<div class="form-group col-md-3">
				    	<label>Nombre del sub grado</label>
				   		<input type="text" name="abre_subg" class="form-control" disabled value="{{$subgrado->abre_subg}}">
			  		</div>
			  		<div class="form-group col-md-3">
				    	<label>Cantidad de estudiantes</label>
				   		<input type="number" name="cant_estu" class="form-control" disabled value="{{$subgrado->cant_estu}}">
			  		</div>
			  		<div class="form-group col-md-3">
				    	<label>Grado de donde proviene</label>
					    <input type="text" name="" class="form-control" disabled value="{{$subgrado->getGrado()}}">
			  		</div>
			  		<div class="form-group col-md-3">
				    	<label>Director de Grupo</label>
					    <input type="text" name="" class="form-control" disabled value="{{$subgrado->getDirectorNombre()}} ">
			  		</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12 text-center">
			  			<hr class="w-100">
			  			<a href="{{route('subgrados.edit',$subgrado->id)}}" class="btn btn-secondary">Editar</a>
				  	</div>
				</div>
			</form>
		</div>
	</div>
@endsection