@extends('layouts.app')
@section('title', 'Editar evento')

@section('content')
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('eventos.index') }}">Eventos</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('eventos.edit', $evento->id) }}">Editar</a></li>
    	<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  	</ol>
</nav>

<div class="card">
	<div class="card-header">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">event_note</i> Editar evento
  		</h1>
  	</div>
	<div class="card-body">

		<form  method="post" action="{{ route('eventos.update', $evento->id) }}" autocomplete="off" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-row">
				<div class="col-md-8">

					<div class="form-row">
						<div class="form-group col-md-12">
					    	<label>Titulo</label>
					   		 <input type="text" name="titu_even" class="form-control {{ $errors->has('titu_even') ? 'is-invalid' : '' }}" value="{{ old('titu_even', $evento->titu_even) }}" required autofocus>
			                @if ($errors->has('titu_even'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('titu_even') }}
			                    </div>
			               	@endif
				  		</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
					    	<label>Fecha inicio</label>
					   		 <input type="text" name="inic_even" class="start-datetimepicker form-control {{ $errors->has('inic_even') ? 'is-invalid' : '' }}" value="{{ old('inic_even', optional($evento->inic_even)->format('Y-m-d h:i a')) }}" required autofocus>
			                @if ($errors->has('inic_even'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('inic_even') }}
			                    </div>
			               	@endif
				  		</div>
						<div class="form-group col-md-6">
					    	<label>Fecha clausura</label>
					   		 <input type="text" name="fina_even" class="end-datetimepicker form-control {{ $errors->has('fina_even') ? 'is-invalid' : '' }}" value="{{ old('fina_even', optional($evento->fina_even)->format('Y-m-d h:i a')) }}" required autofocus>
			                @if ($errors->has('fina_even'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('fina_even') }}
			                    </div>
			               	@endif
				  		</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
					    	<label>No. cupos</label>
					   		<input type="number" name="cupo_even" class="form-control {{ $errors->has('cupo_even') ? 'is-invalid' : '' }}" value="{{ old('cupo_even', $evento->cupo_even) }}" required autofocus>
			                @if ($errors->has('cupo_even'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('cupo_even') }}
			                    </div>
			               	@endif
				  		</div>
				  		<div class="form-group col-md-6">
					    	<label>Página principal</label>
					   		<div class="custom-control custom-checkbox mt-3">
			                    <input type="checkbox" id="most_even" name="most_even" class="custom-control-input" {{ old('most_even', $evento->esVisible()) ? 'checked' : '' }}>
			                    <label class="custom-control-label" for="most_even">
			                    	Visible en página principal
			                    </label>
			                </div>
				  		</div>
					</div>

					<div class="form-row">
				  		<div class="form-group col-md-12">
					    	<label>Fotografía</label>
					   		 <input type="file" name="foto_even" class="file form-control {{ $errors->has('foto_even') ? 'is-invalid' : '' }}" autofocus>
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
					    	<textarea name="desc_even" rows="8" class="form-control {{ $errors->has('desc_even') ? 'is-invalid' : '' }}"  required autofocus>{{ old('desc_even', $evento->desc_even) }}</textarea>
			                @if ($errors->has('desc_even'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('desc_even') }}
			                    </div>
			               	@endif
					  	</div>
					</div>

				</div>
				<div class="col-md-4">

					<div class="card">
						@if (Storage::disk('evento')->exists($evento->foto_even))
							<img class="card-img-top img-fluid"
								src="{{ Storage::disk('evento')->url($evento->foto_even) }}"
								alt="{{ $evento->titu_even }}">
						@else
							<div class="card-body d-flex align-items-center justify-content-center py-5">
								<p class="typography-display-3 text-black-secondary">
									<i class="material-icons">broken_image</i>
								</p>
							</div>
						@endif
					</div>

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
