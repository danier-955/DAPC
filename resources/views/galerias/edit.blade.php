@extends('layouts.app')
@section('title', 'Editar galeria')

@section('content')
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('galerias.index') }}">Galerias</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('galerias.edit', $galeria->id) }}">Editar</a></li>
    	<li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
  	</ol>
</nav>

<div class="card">
	<div class="card-header">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">photo_library</i> Editar galeria
  		</h1>
  	</div>
	<div class="card-body">

		<form  method="post" action="{{ route('galerias.update', $galeria->id) }}" autocomplete="off" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-row">
				<div class="col-md-8">

					<div class="form-row">
						<div class="form-group col-md-12">
					    	<label>Titulo</label>
					   		 <input type="text" name="titu_gale" class="form-control {{ $errors->has('titu_gale') ? 'is-invalid' : '' }}" value="{{ old('titu_gale', $galeria->titu_gale) }}" required autofocus>
			                @if ($errors->has('titu_gale'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('titu_gale') }}
			                    </div>
			               	@endif
				  		</div>
					</div>

					<div class="form-row">
				  		<div class="form-group col-md-12">
					    	<label>Página principal</label>
					   		<div class="custom-control custom-checkbox mt-3">
			                    <input type="checkbox" id="most_gale" name="most_gale" class="custom-control-input" {{ old('most_gale', $galeria->esVisible()) ? 'checked' : '' }}>
			                    <label class="custom-control-label" for="most_gale">
			                    	Visible en página principal
			                    </label>
			                </div>
				  		</div>
					</div>

					<div class="form-row">
				  		<div class="form-group col-md-12">
					    	<label>Fotografía</label>
					   		 <input type="file" name="foto_gale" class="file form-control {{ $errors->has('foto_gale') ? 'is-invalid' : '' }}" autofocus>
			                @if ($errors->has('foto_gale'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('foto_gale') }}
			                    </div>
			               	@endif
				  		</div>
					</div>

					<div class="form-row">
				 		<div class="form-group col-md-12">
					    	<label>Descripción</label>
					    	<textarea name="desc_gale" rows="5" class="form-control {{ $errors->has('desc_gale') ? 'is-invalid' : '' }}"  required autofocus>{{ old('desc_gale', $galeria->desc_gale) }}</textarea>
			                @if ($errors->has('desc_gale'))
			                    <div class="invalid-feedback">
			                    	{{ $errors->first('desc_gale') }}
			                    </div>
			               	@endif
					  	</div>
					</div>

				</div>
				<div class="col-md-4">

					<div class="card">
						@if (Storage::disk('galeria.thumbnail')->exists($galeria->foto_gale))
							<img class="card-img-top img-fluid"
								src="{{ Storage::disk('galeria.thumbnail')->url($galeria->foto_gale) }}"
								alt="{{ $galeria->titu_gale }}">
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
