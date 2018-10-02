@extends('layouts.app')
@section('title', 'Editar seguimiento')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('seguimientos.index') }}">Seguimientos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('seguimientos.edit', $seguimiento->id) }}">Editar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">file_copy</i> Editar seguimiento
		</h1>
	</div>
	<div class="card-body">

		<form method="post" action="{{ route('seguimientos.update', $seguimiento->id) }}" autocomplete="off">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-row">
				<div class="form-group col-md-6">
		    		<label>Practicante</label>
	    			<select name="practicante_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('practicante_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
	    				@empty(old('practicante_id'))
	    				    <option value="{{ $seguimiento->practicante_id }}" selected>
	    				    	{{ $seguimiento->getPracticante() }}
	    				    </option>
	    				@endempty
	      				@foreach($practicantes->chunk(15) as $chunk)
		      				@foreach($chunk as $practicante)
		      					<option value="{{ $practicante->id }}"
		      						@if (old('practicante_id', $seguimiento->practicante_id) === $practicante->id){{ 'selected' }}@endif>
		      						{{ "{$practicante->nomb_prac} {$practicante->pape_prac} {$practicante->sape_prac}" }}
		      					</option>
		      				@endforeach
	      				@endforeach
	    			</select>
	                @if ($errors->has('practicante_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('practicante_id') }}
	                    </div>
	               	@endif
 				</div>
				<div class="form-group col-md-6">
		    		<label>Docente</label>
	    			<select name="docente_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('docente_id') ? 'is-invalid' : '' }}" data-live-search="true" data-live-search-placeholder="Búscar ..." required autofocus>
	    				@empty(old('docente_id'))
	    				    <option value="{{ $seguimiento->docente_id }}" selected>
	    				    	{{ $seguimiento->getDocente() }}
	    				    </option>
	    				@endempty
	      				@foreach($docentes->chunk(15) as $chunk)
		      				@foreach($chunk as $docente)
		      					<option value="{{ $docente->id }}"
		      						@if (old('docente_id', $seguimiento->docente_id) === $docente->id){{ 'selected' }}@endif>
		      						{{ "{$docente->nomb_doce} {$docente->pape_doce} {$docente->sape_doce}" }}
		      					</option>
		      				@endforeach
	      				@endforeach
	    			</select>
	                @if ($errors->has('docente_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('docente_id') }}
	                    </div>
	               	@endif
 				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-3">
			    	<label>Fecha</label>
			    	<input type="text" name="fech_segu" class="datepicker form-control {{ $errors->has('fech_segu') ? 'is-invalid' : '' }}" value="{{ old('fech_segu', optional($seguimiento->fech_segu)->format('Y-m-d')) }}" required autofocus>
	                @if ($errors->has('fech_segu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_segu') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Hora llegada</label>
			    	<input type="text" name="hora_lleg" class="timepicker form-control {{ $errors->has('hora_lleg') ? 'is-invalid' : '' }}" value="{{ old('hora_lleg', $seguimiento->hora_lleg) }}" required autofocus>
	                @if ($errors->has('hora_lleg'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('hora_lleg') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Hora salida</label>
			    	<input type="text" name="hora_sali" class="timepicker form-control {{ $errors->has('hora_sali') ? 'is-invalid' : '' }}" value="{{ old('hora_sali', $seguimiento->hora_sali) }}" required autofocus>
	                @if ($errors->has('hora_sali'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('hora_sali') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Horas cumplidas</label>
			   		<input type="number" name="hora_cump" class="form-control {{ $errors->has('hora_cump') ? 'is-invalid' : '' }}" value="{{ old('hora_cump', $seguimiento->hora_cump) }}" required autofocus>
			   		@if ($errors->has('hora_cump'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('hora_cump') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Actividades realizadas</label>
		    		<textarea name="acti_real" rows="3" class="form-control {{ $errors->has('acti_real') ? 'is-invalid' : '' }}" required autofocus>{{ old('acti_real', $seguimiento->acti_real) }}</textarea>
	                @if ($errors->has('acti_real'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('acti_real') }}
	                    </div>
	               	@endif
		  		</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-12">
		    		<label>Observaciones</label>
		    		<textarea name="obse_segu" rows="3" class="form-control {{ $errors->has('obse_segu') ? 'is-invalid' : '' }}" autofocus>{{ old('obse_segu', $seguimiento->obse_segu) }}</textarea>
	                @if ($errors->has('obse_segu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('obse_segu') }}
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