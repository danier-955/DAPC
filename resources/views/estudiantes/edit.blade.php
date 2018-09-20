@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiante</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('estudiantes.edit', $estudiante->id) }}">Editar</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>

	<div class="card">
		<div class="card-header">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">wc</i> Editar Estudiante
			</h1>
		</div>

		<div class="card-body">
			<form method="post" action="{{ route('estudiantes.update', $estudiante->id) }}" autocomplete="off" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				<blockquote class="blockquote my-3">
				  <p class="mb-0 typography-subheading">Información del Estudiante</p>
				  <hr class="w-100">
				</blockquote>

				<div class="form-row">
					<div class="form-group col-md-3">
			    		<label >Tipo de documento</label>
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
				    	<label>Fecha de Nacimiento</label>
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
				    	<label>Nombre del Padre</label>
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
				    	<label>Nombre del Madre</label>
				   		<input type="text" name="madr_estu" class="form-control {{ $errors->has('madr_estu') ? 'is-invalid' : '' }}" value="{{ old('madr_estu', $estudiante->madr_estu) }}" autofocus>
		                @if ($errors->has('madr_estu'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('madr_estu') }}
		                    </div>
		               	@endif
				  	</div>

				  	<div class="form-group col-md-3">
				    	<label>Instituto Anterior</label>
				   		<input type="text" name="cole_prov" class="form-control {{ $errors->has('cole_prov') ? 'is-invalid' : '' }}" value="{{ old('cole_prov', $estudiante->cole_prov) }}" autofocus>
		                @if ($errors->has('cole_prov'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('cole_prov') }}
		                    </div>
		               	@endif
				  	</div>
					
					<div class="form-group col-md-3">
					   <label>Parentesco del acudiente</label>
					    <select name="pare_acud" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('pare_acud') ? 'is-invalid' : '' }}"  autofocus>
					    	{{-- <option>{{ old('pare_acud', $estudiante->pare_acud) }}</option> --}}
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
				    	<label>Nombre de EPS</label>
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
					    <label>Tipo de Estudiante</label>
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
					    <label>Grado asignado</label>
					    <select name="sub_grado_id" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('sub_grado_id') ? 'is-invalid' : '' }}"  autofocus>
		    				@empty(old('sub_grado_id'))
		    				    <option value="{{ $estudiante->sub_grado_id }}" selected>
		    				    	{{ $estudiante->getSubGradoNombre() }}
		    				    </option>
		    				@endempty
					      	@foreach($grados as $grado)
								@foreach($grado->subGrados as $subGrado)
								 	<option value="{{ $subGrado->id }}"
					      				@if (old('sub_grado_id', $estudiante->getSubGradoId()) === $subGrado->id){{ 'selected' }}@endif>
					      					{{ $grado->abre_grad }} &middot; {{ $subGrado->abre_subg }} &middot; Jornada {{ $grado->getJornada() }}
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
			            <label>Adjuntar Carne de Vacunacion</label>
			            <input type="file" name="carn_vacu" class="form-control {{ $errors->has('carn_vacu') ? 'is-invalid' : '' }}" autofocus>
			            @if ($errors->has('carn_vacu'))
			              <div class="invalid-feedback">
			                {{ $errors->first('carn_vacu') }}
			              </div>
			             @endif
			        </div>

			        <div class="form-group col-md-4">
			            <label>Adjuntar Foto</label>
			            <input type="file" name="foto_estu" class="form-control {{ $errors->has('foto_estu') ? 'is-invalid' : '' }}" autofocus>
			            @if ($errors->has('foto_estu'))
			              <div class="invalid-feedback">
			                {{ $errors->first('foto_estu') }}
			              </div>
			             @endif
			        </div>
					
					<div class="form-group col-md-4">
			            <label>Adjuntar Documento de Identidad</label>
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
				    	<label>Observaciòn</label>
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
			  <p class="mb-0 typography-subheading">Utiles Escolares</p>
			  <hr class="w-100">
			</blockquote>


			<form id="storeUtiles" method="post" action="{{ route('inventarios.store') }}" autocomplete="off">
			{{ csrf_field() }}
			
			<input type="hidden" name="estudiante_id" value="{{$estudiante->id}}" readonly>
				<div class="form-row">
		
					<div class="form-group col-md-5">
					    <label>Útiles</label>
					    <select name="implemento_id" class="form-control" required autofocus>
					    	<option value="">··· Seleccione ···</option>
				            @foreach($implementos->chunk(15) as $chunk)
					            @foreach($chunk as $implemento)
				                  	<option value="{{ $implemento->id }}">
				                    	{{ $implemento->nomb_util }}
				                  	</option>
				        		@endforeach
			        		@endforeach
					    </select>
			           <div id="error_implemento_id"></div>
					</div>
					<div class="form-group col-md-2">
				    	<label>Unidades</label>
				   		 <input type="number" name="cant_util" class="form-control" required autofocus>
		                <div id="error_cant_util"></div>
				  	</div>

					<div class="col-sm-12 col-md-4 col-lg-4">
						<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						
				  			<button type="submit" class="btn btn-primary">Registrar</button>
							<span class="loading mx-3" style="display: none;">
								<i class="fas fa-sync fa-spin fa-2x align-middle"></i>
							</span>
						</div>
					</div>
				</div>
			</form>
		  	<hr class="mt-0 w-100">

			<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Útil</th>
							<th>Unidades</th>
							<th>Opción</th>
						</tr>
					</thead>
					<tbody id="indexUtiles"></tbody>
						@foreach($utiles as $util)
							<tr>
								<td class="text-nowrap">{{ $util->getImplemento() }}</td>
								<td class="text-nowrap">{{ $util->cant_util }}</td>
									<td class="text-nowrap text-center">
										@can('inventarios.edit')
											@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('inventarios.edit', $util->id)])
										@endcan
										@can('inventarios.destroy')
											@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('inventarios.destroy', $util->id)])
										@endcan
									</td>
								</td>
							</tr>

						@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	@mix('js/inventario.js')
@endpush