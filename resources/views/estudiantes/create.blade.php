@extends('layouts.app')
@section('title', 'Registrar estsudiante')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('estudiantes.create') }}">Registrar</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">wc</i> Registrar estudiante
			</h1>
		</div>
		<div class="card-body">
			<form method="post" action="{{ route('estudiantes.store') }}" autocomplete="off" enctype="multipart/form-data">
				{{ csrf_field() }}

				<blockquote class="blockquote my-3">
				  <p class="mb-0 typography-subheading">Información del estudiante</p>
				  <hr class="w-100">
				</blockquote>
				
				<div class="form-row">
					<div class="form-group col-md-3">
			    		<label >Tipo  de Documento</label>			    		
		    			<select  name="tipo_docu_estu" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_docu_estu') ? 'is-invalid' : '' }}" >
		    				@empty(old('tipo_docu_estu'))
			                    <option value="">··· Seleccione ···</option>
			                @endempty
		      				@foreach(Documento::tipos() as $tipo)
		      					<option value="{{ $tipo }}" 
			      					@if (old('tipo_docu_estu') === $tipo){{ 'selected' }}@endif>
			      					{{ $tipo }}
			      				</option>
		      				@endforeach
		    			</select>
		    			@if ($errors->has('tipo_docu_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('tipo_docu_estu') }}
		                    </div>
		               	@endif
	 				</div>

	 				<div class="form-group col-md-3">
				    	<label>No. Identificación</label>
				   		 <input type="number" name="docu_estu" class="form-control {{ $errors->has('docu_estu') ? 'is-invalid' : '' }}" value="{{ old('docu_estu') }}" required autofocus>
		                @if ($errors->has('docu_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('docu_estu') }}
		                    </div>
		               	@endif
				  	</div>
					
					<div class="form-group col-md-3">
				    	<label>Nombres</label>
				   		<input type="text" name="nomb_estu" class="form-control {{ $errors->has('nomb_estu') ? 'is-invalid' : '' }}" value="{{ old('nomb_estu') }}" required autofocus>
		                @if ($errors->has('nomb_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_estu') }}
		                    </div>
		               	@endif
				  	</div>

				  	<div class="form-group col-md-3">
				    	<label>Primer apellido</label>
				   		<input type="text" name="pape_estu" class="form-control {{ $errors->has('pape_estu') ? 'is-invalid' : '' }}" value="{{ old('pape_estu') }}" required autofocus>
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
				   		<input type="text" name="sape_estu" class="form-control {{ $errors->has('sape_estu') ? 'is-invalid' : '' }}" value="{{ old('sape_estu') }}" autofocus>
		                @if ($errors->has('sape_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('sape_estu') }}
		                    </div>
		               	@endif
				  	</div>

				  	<div class="form-group col-md-3">
					    <label>Sexo</label>
					    <select name="sexo_estu" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sexo_estu') ? 'is-invalid' : '' }}" required autofocus>
					    	@empty(old('sexo_estu'))
			                    <option value="">··· Seleccione ···</option>
			                @endempty
					    	@foreach(Sexo::asociativos() as $sexo)
					      		<option value="{{ $sexo['id'] }}"
					      		@if (old('sexo_estu') === $sexo['id']){{ 'selected' }}@endif>
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
			            <input type="text" name="fech_naci" class="datepicker form-control {{ $errors->has('fech_naci') ? 'is-invalid' : '' }}" value="{{ old('fech_naci') }}" required autofocus>
			            @if ($errors->has('fech_naci'))
			                <div class="invalid-feedback">
			                  {{ $errors->first('fech_naci') }}
			                </div>
			              @endif
			        </div>

		            <div class="form-group col-md-3">
				    	<label>Dirección de residencia</label>
				   		<input type="text" name="dire_estu" class="form-control {{ $errors->has('dire_estu') ? 'is-invalid' : '' }}" value="{{ old('dire_estu') }}" required autofocus>
		                @if ($errors->has('dire_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('dire_estu') }}
		                    </div>
		               	@endif
				  	</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-3">
				    	<label>Barrio de residencia</label>
				   		<input type="text" name="barr_acud" class="form-control {{ $errors->has('barr_acud') ? 'is-invalid' : '' }}" value="{{ old('barr_acud') }}" autofocus>
		                @if ($errors->has('barr_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('barr_acud') }}
		                    </div>
		               	@endif
				  	</div>

				  	<div class="form-group col-md-3">
				    	<label>Correo electrónico</label>
				   		<input type="email" name="corr_estu" class="form-control {{ $errors->has('corr_estu') ? 'is-invalid' : '' }}" value="{{ old('corr_estu') }}" required autofocus>
		                @if ($errors->has('corr_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('corr_estu') }}
		                    </div>
		               	@endif
				 	</div>

				 	<div class="form-group col-md-3">
				    	<label>Teléfono</label>
				   		<input type="number" name="tele_estu" class="form-control {{ $errors->has('tele_estu') ? 'is-invalid' : '' }}" value="{{ old('tele_estu') }}" autofocus>
		                @if ($errors->has('tele_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('tele_estu') }}
		                    </div>
		               	@endif
				  	</div>

				  	<div class="form-group col-md-3">
				    	<label>Nombre del Padre</label>
				   		<input type="text" name="padr_estu" class="form-control {{ $errors->has('padr_estu') ? 'is-invalid' : '' }}" value="{{ old('padr_estu') }}" autofocus>
		                @if ($errors->has('padr_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('padr_estu') }}
		                    </div>
		               	@endif
				  	</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
				    	<label>Nombre de la Madre</label>
				   		<input type="text" name="madr_estu" class="form-control {{ $errors->has('madr_estu') ? 'is-invalid' : '' }}" value="{{ old('madr_estu') }}" autofocus>
		                @if ($errors->has('madr_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('madr_estu') }}
		                    </div>
		               	@endif
				  	</div>
				  	
				  	<div class="form-group col-md-3">
				    	<label>Colegio Anterior</label>
				   		<input type="text" name="cole_prov" class="form-control {{ $errors->has('cole_prov') ? 'is-invalid' : '' }}" value="{{ old('cole_prov') }}" autofocus>
		                @if ($errors->has('cole_prov'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('cole_prov') }}
		                    </div>
		               	@endif
				  	</div>
					
					<div class="form-group col-md-3">
					    <label>Tipo de Estudiante</label>
					    <select name="tipo_estu" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('tipo_estu') ? 'is-invalid' : '' }}" required autofocus>
					    	@empty(old('tipo_estu'))
			                    <option value="">··· Seleccione ···</option>
			                @endempty
					    	@foreach(TipoEstudiante::asociativos() as $tipoestudiante)
					      		<option value="{{ $tipoestudiante['id'] }}"
					      		@if (old('tipo_estu') === $tipoestudiante['id']){{ 'selected' }}@endif>
					      			{{ $tipoestudiante['texto'] }}
					      		</option>
					      	@endforeach
					    </select>
		                @if ($errors->has('tipo_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('tipo_estu') }}
		                    </div>
		               	@endif
			 		</div>
				
					<div class="form-group col-md-3">
			            <label>Nombre de la EPS</label>
				   		<input type="text" name="eps_estu" class="form-control {{ $errors->has('eps_estu') ? 'is-invalid' : '' }}" value="{{ old('eps_estu') }}" autofocus>
		                @if ($errors->has('eps_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('eps_estu') }}
		                    </div>
		               	@endif
			        </div>
			    </div>
				<div class="form-row">
					<div class="form-group col-md-4">
					    <label>Grado Asignar</label>
					    <select name="sub_grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sub_grado_id') ? 'is-invalid' : '' }}" required autofocus>
					    	@empty(old('sub_grado_id'))
		                        <option value="">··· Seleccione ···</option>
		                    @endempty
					      	@foreach($grados as $grado)
								 @foreach($grado->subGrados as $subGrado)
								 <option value="{{ $subGrado->id }}"
					      			@if (old('sub_grado_id') === $subGrado->id){{ 'selected' }}@endif>
					      			{{ $grado->abre_grad }} &middot; {{ $subGrado->abre_subg }} &middot; Jornada {{$grado->getJornada() }}
					      		</option>
					      		@endforeach
					      	@endforeach
					    </select>
		                @if ($errors->has('sub_grado_id'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('sub_grado_id') }}
		                    </div>
		               	@endif
			 		</div>

			        <div class="form-group col-md-4">
			            <label>Adjuntar Certificados de Grados</label>
			            <input type="file" name="copi_grad" class="form-control {{ $errors->has('copi_grad') ? 'is-invalid' : '' }}" value="{{ old('copi_grad') }}" required autofocus>
			            @if ($errors->has('copi_grad'))
			              <div class="invalid-feedback">
			                {{ $errors->first('copi_grad') }}
			              </div>
			             @endif
			        </div>
				
					<div class="form-group col-md-4">
			            <label>Adjuntar Carne de Vacunacion</label>
			            <input type="file" name="carn_vacu" class="form-control {{ $errors->has('carn_vacu') ? 'is-invalid' : '' }}" value="{{ old('carn_vacu') }}" required autofocus>
			            @if ($errors->has('carn_vacu'))
			              <div class="invalid-feedback">
			                {{ $errors->first('carn_vacu') }}
			              </div>
			             @endif
			        </div>
			    </div>

				<div class="form-row">
			        <div class="form-group col-md-4">
			            <label>Adjuntar Foto</label>
			            <input type="file" name="foto_estu" class="form-control {{ $errors->has('foto_estu') ? 'is-invalid' : '' }}" value="{{ old('foto_estu') }}" required autofocus>
			            @if ($errors->has('foto_estu'))
			              <div class="invalid-feedback">
			                {{ $errors->first('foto_estu') }}
			              </div>
			             @endif
			        </div>
			        <div class="form-group col-md-4">
			            <label>Adjuntar Documento de Identidad</label>
			            <input type="file" name="copi_docu" class="form-control {{ $errors->has('copi_docu') ? 'is-invalid' : '' }}" value="{{ old('copi_docu') }}" required autofocus>
			            @if ($errors->has('copi_docu'))
			              <div class="invalid-feedback">
			                {{ $errors->first('copi_docu') }}
			              </div>
			             @endif
			        </div>
					
			        <div class="form-group col-md-12">
			            <label>Observacion</label>
			            <textarea name="obse_estu" rows="3" class="form-control " autofocus>
			              {{ old('obse_estu') }}
			            </textarea>
		             
		           </div>
				</div>

				<blockquote class="blockquote my-3">
				  <p class="mb-0 typography-subheading">Información del acudiente</p>
				  <hr class="w-100">
				</blockquote>

				<div class="row clearfix">
	                <div class="col-md-12">
	                    <div class="form-group {{ $errors->has('acudiente_id') ? 'has-error' : '' }}">
	                        <label class="col-form-label">Acudiente</label>
	                       <select id="acudiente_id" name="acudiente_id" class="form-control {{ $errors->has('acudiente_id') ? 'is-invalid' : '' }}">
	                            <option value="">--- Ninguno Registrado ---</option>
	                        </select>
	                        @if ($errors->has('acudiente_id'))
	                        <span class="form-control-feedback">{{ $errors->first('acudiente_id') }}</span>
	                        @endif
	                    </div>
	                </div>
	            </div>

				<div class="form-row">
					<div class="form-group col-md-3">
			    		<label >Tipo  de Documento</label>
		    			<select  id="tipo_docu" name="tipo_docu" class="selectpicker dropdown-dense show-tick selectbox form-control{{ $errors->has('tipo_docu') ? 'is-invalid' : '' }}" >
		    				@empty(old('tipo_docu'))
			                    <option value="">··· Seleccione ···</option>
			                @endempty
		      				@foreach(Documento::acudiente() as $tipo)
		      					<option value="{{ $tipo }}" 
			      					@if (old('tipo_docu') === $tipo){{ 'selected' }}@endif>
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
				   		 <input id="docu_acud" type="number" name="docu_acud" class="form-control {{ $errors->has('docu_acud') ? 'is-invalid' : '' }}" value="{{ old('docu_acud') }}" required autofocus>
		                @if ($errors->has('docu_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('docu_acud') }}
		                    </div>
		               	@endif
				  	</div>
					
					<div class="form-group col-md-3">
				    	<label>Nombres</label>
				   		<input  id="nomb_acud" type="text" name="nomb_acud" class="form-control {{ $errors->has('nomb_acud') ? 'is-invalid' : '' }}" value="{{ old('nomb_acud') }}" required autofocus>
		                @if ($errors->has('nomb_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('nomb_acud') }}
		                    </div>
		               	@endif
				  	</div>
				  	<div class="form-group col-md-3">
				    	<label>Primer apellido</label>
				   		<input id="pape_acud" type="text" name="pape_acud" class="form-control {{ $errors->has('pape_acud') ? 'is-invalid' : '' }}" value="{{ old('pape_acud') }}" required autofocus>
		                @if ($errors->has('pape_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('pape_acud') }}
		                    </div>
		               	@endif
				  	</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
				    	<label>Segundo apellido</label>
				   		<input id="sape_acud" type="text" name="sape_acud" class="form-control {{ $errors->has('sape_acud') ? 'is-invalid' : '' }}" value="{{ old('sape_acud') }}" autofocus>
		                @if ($errors->has('sape_acud'))
		                    <div class="invalid-feedback">
		                    	{{  $errors->first('sape_acud') }}
		                    </div>
		               	@endif
				  	</div>
					
					<div class="form-group col-md-3">
			    		<label >Parentesco</label>			    		
		    			<select  name="pare_acud" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('pare_acud') ? 'is-invalid' : '' }}" >
		    				@empty(old('pare_acud'))
			                    <option value="">··· Seleccione ···</option>
			                @endempty
		      			
		      				@foreach(Parentesco::asociativos() as $parentesco)
					      		<option value="{{ $parentesco['id'] }}"
					      		@if (old('pare_acud') === $parentesco['id']){{ 'selected' }}@endif>
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
					    <label>Sexo</label>
					    <select id="pare_acud" name="sexo_acud" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sexo_acud') ? 'is-invalid' : '' }}" required autofocus>
					    	@empty(old('sexo_acud'))
			                    <option value="">··· Seleccione ···</option>
			                @endempty
					    	@foreach(Sexo::asociativos() as $sexo)
					      		<option value="{{ $sexo['id'] }}"
					      		@if (old('sexo_acud') === $sexo['id']){{ 'selected' }}@endif>
					      			{{ $sexo['texto'] }}
					      		</option>
					      	@endforeach
					    </select>
		                @if ($errors->has('sexo_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('sexo_acud') }}
		                    </div>
		               	@endif
			 		</div>

			 		<div class="form-group col-md-3">
				    	<label>Dirección de residencia</label>
				   		<input id="dire_acud" type="text" name="dire_acud" class="form-control {{ $errors->has('dire_acud') ? 'is-invalid' : '' }}" value="{{ old('dire_acud') }}" required autofocus>
		                @if ($errors->has('dire_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('dire_acud') }}
		                    </div>
		               	@endif
				  	</div>
				  	<div class="form-group col-md-3">
				    	<label>Barrio de residencia</label>
				   		<input id="barr_acud" type="text" name="barr_acud" class="form-control {{ $errors->has('barr_acud') ? 'is-invalid' : '' }}" value="{{ old('barr_acud') }}" autofocus>
		                @if ($errors->has('barr_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('barr_acud') }}
		                    </div>
		               	@endif
				  	</div>
				
					<div class="form-group col-md-3">
				    	<label>Correo electrónico</label>
				   		<input id="corr_acud" type="email" name="corr_acud" class="form-control {{ $errors->has('corr_acud') ? 'is-invalid' : '' }}" value="{{ old('corr_acud') }}" required autofocus>
		                @if ($errors->has('corr_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('corr_acud') }}
		                    </div>
		               	@endif
				 	</div>

				 	<div class="form-group col-md-3">
				    	<label>Teléfono</label>
				   		<input id="tele_acud" type="number" name="tele_acud" class="form-control {{ $errors->has('tele_acud') ? 'is-invalid' : '' }}" value="{{ old('tele_acud') }}" autofocus>
		                @if ($errors->has('tele_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('tele_acud') }}
		                    </div>
		               	@endif
				  	</div>

				  	<div class="form-group col-md-3">
				    	<label>Profesión</label>
				   		<input id="prof_acud" type="text" name="prof_acud" class="form-control {{ $errors->has('prof_acud') ? 'is-invalid' : '' }}" value="{{ old('prof_acud') }}" autofocus>
		                @if ($errors->has('prof_acud'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('prof_acud') }}
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

