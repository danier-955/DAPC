@extends('layouts.app')
@section('title', 'Editar fecha extracurricular')

@section('content')
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    	<li class="breadcrumb-item"><a href="{{ route('asignaturas.index') }}">Asignaturas</a></li>
    	<li class="breadcrumb-item"><a href="{{ route('asignaturas.show', $asignatura->id) }}">Ver asignatura</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('asignaturas.fechas.index', $asignatura->id) }}">Fechas extracurriculares</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('asignaturas.fechas.edit', [$asignatura->id, $fecha->id]) }}">Editar</a></li>
    	<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  	</ol>
</nav>

<div class="card">
	<div class="card-header">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">date_range</i> Editar fecha extracurricular
  		</h1>
  	</div>
	<div class="card-body">

		@isfalse($fechaExiste)
			<div class="alert alert-danger">
				<i class="material-icons mr-1">info</i>
				<strong>¡Lo sentimos!</strong> No es posible editar la fecha debido a que hay una fecha extracurricular en curso!
			</div>
		@endisfalse

        @component('asignaturas.fechas.partials.subject_matter', ['asignatura' => $asignatura])
        	Información de la fecha
        @endcomponent

		<form  method="post" action="{{ route('asignaturas.fechas.update', [$asignatura->id, $fecha->id]) }}" autocomplete="off">
			{{ method_field('PUT') }}
			{{ csrf_field() }}

			<div class="form-row">
				<div class="form-group col-md-3">
			    	<label>Fecha inicial</label>
			    	<input type="text" name="fech_inic" class="start-datetimepicker form-control {{ $errors->has('fech_inic') ? 'is-invalid' : '' }}" value="{{ old('fech_inic', datetime_inic_edit($fecha->fech_nota)) }}" required>
	                @if ($errors->has('fech_inic'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_inic') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Fecha final</label>
			    	<input type="text" name="fech_fina" class="end-datetimepicker form-control {{ $errors->has('fech_fina') ? 'is-invalid' : '' }}" value="{{ old('fech_fina', datetime_fina_edit($fecha->fech_nota)) }}" required>
	                @if ($errors->has('fech_fina'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_fina') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
					<label>Periodo</label>
				    <select name="peri_nota" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('peri_nota') ? 'is-invalid' : '' }}" required autofocus>
				    	<option value="{{ $fecha->peri_nota }}">{{ $fecha->getPeriodo() }}</option>
				    	@foreach(Periodo::asociativos() as $periodo)
				      		<option value="{{ $periodo['id'] }}"
				      		@if (old('peri_nota', $fecha->peri_nota) === $periodo['id']){{ 'selected' }}@endif>
				      			{{ $periodo['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('peri_nota'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('peri_nota') }}
	                    </div>
	               	@endif
				</div>
				<div class="form-group col-md-3">
					<label>Tipo de nota</label>
				    <select name="tipo_nota" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_nota') ? 'is-invalid' : '' }}" required autofocus>
				    	<option value="{{ $fecha->tipo_nota }}">{{ $fecha->getTipoNota() }}</option>
				    	@foreach(TipoNota::asociativos() as $tipoNota)
				      		<option value="{{ $tipoNota['id'] }}"
				      		@if (old('tipo_nota', $fecha->tipo_nota) === $tipoNota['id']){{ 'selected' }}@endif>
				      			{{ $tipoNota['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('tipo_nota'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tipo_nota') }}
	                    </div>
	               	@endif
				</div>
			</div>

			<div class="form-row">
		 		<div class="form-group col-md-12">
			    	<label>Motivo principal</label>
			    	<textarea name="moti_nota" rows="6" class="form-control {{ $errors->has('moti_nota') ? 'is-invalid' : '' }}"  required autofocus>{{ old('moti_nota', $fecha->moti_nota) }}</textarea>
	                @if ($errors->has('moti_nota'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('moti_nota') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			@istrue($fechaExiste)
				<div class="form-row">
					<div class="form-group col-md-12 text-center">
			  			<hr class="w-100">
				  		<button type="reset" class="btn btn-secondary">Limpiar</button>
				  		<button type="submit" class="btn btn-primary">Actualizar</button>
				  	</div>
				</div>
			@endistrue

		</form>

	</div>
</div>
@endsection
