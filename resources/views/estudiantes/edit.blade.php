@extends('layouts.app')
@section('title', 'Editar estudiante')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiante</a></li>
    <li class="breadcrumb-item"><a href="{{ route('estudiantes.edit', $estudiante->id) }}">Editar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">wc</i> Editar estudiante
		</h1>
	</div>

	<div class="card-body">
		<form method="post" action="{{ route('estudiantes.update', $estudiante->id) }}" autocomplete="off" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Información del estudiante</p>
			  <hr class="w-100">
			</blockquote>

			<div class="form-row">
				<div class="form-group col-md-3">
		    		<label>Tipo de documento</label>
	    			<select name="tipo_docu" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_docu') ? 'is-invalid' : '' }}"  autofocus>
	      				@foreach(Documento::tipos() as $tipo)
	      					<option value="{{ $tipo }}"
	      						@if (old('tipo_doce', $estudiante->tipo_docu) === $tipo){{ 'selected' }}@endif>
	      						{{ $tipo }}
	      					</option>
	      				@endforeach
	    			</select>
	                @if ($errors->has('tipo_docu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tipo_docu') }}
	                    </div>
	               	@endif
 				</div>
			  	<div class="form-group col-md-3">
			    	<label>No. Identificación</label>
			   		 <input type="number" name="docu_estu" class="form-control {{ $errors->has('docu_estu') ? 'is-invalid' : '' }}" value="{{ old('docu_estu', $estudiante->docu_estu) }}"  autofocus>
	                @if ($errors->has('docu_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('docu_estu') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Nombres</label>
			   		<input type="text" name="nomb_estu" class="form-control {{ $errors->has('nomb_estu') ? 'is-invalid' : '' }}" value="{{ old('nomb_estu', $estudiante->nomb_estu) }}"  autofocus>
	                @if ($errors->has('nomb_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_estu') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Primer apellido</label>
			   		<input type="text" name="pape_estu" class="form-control {{ $errors->has('pape_estu') ? 'is-invalid' : '' }}" value="{{ old('pape_estu', $estudiante->pape_estu) }}"  autofocus>
	                @if ($errors->has('pape_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('pape_estu') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-3">
			    	<label>Segundo apellido</label>
			   		<input type="text" name="sape_estu" class="form-control {{ $errors->has('sape_estu') ? 'is-invalid' : '' }}" value="{{ old('sape_estu', $estudiante->sape_estu) }}" autofocus>
	                @if ($errors->has('sape_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sape_estu') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
				    <label>Sexo</label>
				    <select name="sexo_estu" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sexo_estu') ? 'is-invalid' : '' }}"  autofocus>
				    	@foreach(Sexo::asociativos() as $sexo)
				      		<option value="{{ $sexo['id'] }}"
				      			@if (old('sexo_estu', $estudiante->sexo_estu) === $sexo['id']){{ 'selected' }}@endif>
				      			{{ $sexo['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('sexo_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sexo_estu') }}
	                    </div>
	               	@endif
		 		</div>
		 		<div class="form-group col-md-3">
			    	<label>Fecha de nacimiento</label>
			    	<input type="text" name="fech_naci" class="datepicker form-control {{ $errors->has('fech_naci') ? 'is-invalid' : '' }}" value="{{ old('fech_naci', optional($estudiante->fech_naci)->format('Y-m-d')) }}"  autofocus>
	                @if ($errors->has('fech_naci'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('fech_naci') }}
	                    </div>
	               	@endif
			  	</div>
			  	<div class="form-group col-md-3">
			    	<label>Dirección de residencia</label>
			   		<input type="text" name="dire_estu" class="form-control {{ $errors->has('dire_estu') ? 'is-invalid' : '' }}" value="{{ old('dire_estu', $estudiante->dire_estu) }}"  autofocus>
	                @if ($errors->has('dire_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('dire_estu') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div  class="form-row">
			  	<div class="form-group col-md-3">
			    	<label>Barrio de residencia</label>
			   		<input type="text" name="barr_estu" class="form-control {{ $errors->has('barr_estu') ? 'is-invalid' : '' }}" value="{{ old('barr_estu', $estudiante->barr_estu) }}" autofocus>
	                @if ($errors->has('barr_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('barr_estu') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Correo electrónico</label>
			   		<input type="email" name="corr_estu" class="form-control {{ $errors->has('corr_estu') ? 'is-invalid' : '' }}" value="{{ old('corr_estu', $estudiante->corr_estu) }}"  autofocus>
	                @if ($errors->has('corr_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('corr_estu') }}
	                    </div>
	               	@endif
			 	</div>
			 	<div class="form-group col-md-3">
			    	<label>Teléfono</label>
			   		<input type="number" name="tele_estu" class="form-control {{ $errors->has('tele_estu') ? 'is-invalid' : '' }}" value="{{ old('tele_estu', $estudiante->tele_estu) }}" autofocus>
	                @if ($errors->has('tele_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tele_estu') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Nombre del padre</label>
			   		<input type="text" name="padr_estu" class="form-control {{ $errors->has('padr_estu') ? 'is-invalid' : '' }}" value="{{ old('padr_estu', $estudiante->padr_estu) }}" autofocus>
	                @if ($errors->has('padr_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('padr_estu') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-3">
			    	<label>Nombre de la madre</label>
			   		<input type="text" name="madr_estu" class="form-control {{ $errors->has('madr_estu') ? 'is-invalid' : '' }}" value="{{ old('madr_estu', $estudiante->madr_estu) }}" autofocus>
	                @if ($errors->has('madr_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('madr_estu') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
				   	<label>Parentesco del acudiente</label>
				    <select name="pare_acud" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('pare_acud') ? 'is-invalid' : '' }}"  autofocus>
				    	@foreach(Parentesco::asociativos() as $parentesco)
				      		<option value="{{ $parentesco['id'] }}"
				      			@if (old('pare_acud', $estudiante->pare_acud) === $parentesco['id']){{ 'selected' }}@endif>
				      			{{ $parentesco['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('pare_acud'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('pare_acud') }}
	                    </div>
	               	@endif
		 		</div>
			  	<div class="form-group col-md-3">
			    	<label>Colegio de procedencia</label>
			   		<input type="text" name="cole_prov" class="form-control {{ $errors->has('cole_prov') ? 'is-invalid' : '' }}" value="{{ old('cole_prov', $estudiante->cole_prov) }}" autofocus>
	                @if ($errors->has('cole_prov'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('cole_prov') }}
	                    </div>
	               	@endif
			  	</div>
				<div class="form-group col-md-3">
			    	<label>Nombre de la E.P.S.</label>
			   		<input type="text" name="eps_estu" class="form-control {{ $errors->has('eps_estu') ? 'is-invalid' : '' }}" value="{{ old('eps_estu', $estudiante->eps_estu) }}" autofocus>
	                @if ($errors->has('eps_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('eps_estu') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<div class="form-row">
			  	<div class="form-group col-md-4">
				    <label>Tipo de estudiante</label>
				    <select name="tipo_estu" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_estu') ? 'is-invalid' : '' }}"  autofocus>
				    	@foreach(TipoEstudiante::asociativos() as $sexo)
				      		<option value="{{ $sexo['id'] }}"
				      			@if (old('tipo_estu', $estudiante->tipo_estu) === $sexo['id']){{ 'selected' }}@endif>
				      			{{ $sexo['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('tipo_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('tipo_estu') }}
	                    </div>
	               	@endif
		 		</div>
				<div class="form-group col-md-4">
				    <label>Grado matriculado</label>
				    <select name="sub_grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sub_grado_id') ? 'is-invalid' : '' }}"  autofocus>
	    				<option value="{{ $estudiante->getSubGradoId() }}" selected>
    				    	{{ $estudiante->getSubGradoNombre() }}
    				    </option>
				    </select>
	                @if ($errors->has('sub_grado_id'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('sub_grado_id') }}
	                    </div>
	               	@endif
		 		</div>
		 		<div class="form-group col-md-4">
		            <label>Certificado de grados (archivo)</label>
		            <input type="file" name="copi_grad" class="form-control {{ $errors->has('copi_grad') ? 'is-invalid' : '' }}" autofocus>
		            @if ($errors->has('copi_grad'))
		              <div class="invalid-feedback">
		                {{ $errors->first('copi_grad') }}
		              </div>
		            @endif
		        </div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-4">
		            <label>Carne de vacunación (archivo)</label>
		            <input type="file" name="carn_vacu" class="form-control {{ $errors->has('carn_vacu') ? 'is-invalid' : '' }}" autofocus>
		            @if ($errors->has('carn_vacu'))
		              <div class="invalid-feedback">
		                {{ $errors->first('carn_vacu') }}
		              </div>
		             @endif
		        </div>
		        <div class="form-group col-md-4">
		            <label>Fotografía (archivo)</label>
		            <input type="file" name="foto_estu" class="form-control {{ $errors->has('foto_estu') ? 'is-invalid' : '' }}" autofocus>
		            @if ($errors->has('foto_estu'))
		              <div class="invalid-feedback">
		                {{ $errors->first('foto_estu') }}
		              </div>
		             @endif
		        </div>
				<div class="form-group col-md-4">
		            <label>Documento de identidad (archivo)</label>
		            <input type="file" name="copi_docu" class="form-control {{ $errors->has('copi_docu') ? 'is-invalid' : '' }}" autofocus>
		            @if ($errors->has('copi_docu'))
		              <div class="invalid-feedback">
		                {{ $errors->first('copi_docu') }}
		              </div>
		             @endif
		        </div>
			</div>

			<div class="form-row">
		 		<div class="form-group col-md-12">
			    	<label>Observaciones</label>
			    	<textarea name="obse_estu" rows="3" class="form-control {{ $errors->has('obse_estu') ? 'is-invalid' : '' }}" autofocus>{{ old('obse_estu', $estudiante->obse_estu) }}</textarea>
	                @if ($errors->has('obse_estu'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('obse_estu') }}
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

		<blockquote class="blockquote my-3">
		  <p class="mb-0 typography-subheading">Útiles escolares asignados</p>
		  <hr class="w-100">
		</blockquote>

	    <ipca-implement
	    	:estudiante-id="{{ json_encode($estudiante->id) }}"
			:can-index="{{ boolval(Shinobi::can('estudiantes.implementos.index')) ? 'true' : 'false' }}"
			:can-create="{{ boolval(Shinobi::can('estudiantes.implementos.create')) ? 'true' : 'false' }}"
			:can-edit="{{ boolval(Shinobi::can('estudiantes.implementos.edit')) ? 'true' : 'false' }}"
			:can-destroy="{{ boolval(Shinobi::can('estudiantes.implementos.destroy')) ? 'true' : 'false' }}"
	        :implementos="{{ json_encode($implementos) }}">
		</ipca-implement>

	</div>
</div>
@endsection