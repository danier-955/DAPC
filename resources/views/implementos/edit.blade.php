@extends('layouts.app')
@section('title', 'Editar útil escolar')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('implementos.index') }}">Útiles escolares</a></li>
    <li class="breadcrumb-item"><a href="{{ route('implementos.edit', $implemento->id) }}">Editar</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">brush</i> Editar útil escolar
		</h1>
	</div>

	<div class="card-body">
		<form method="post" action="{{ route('implementos.update', $implemento->id) }}" autocomplete="off" >
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<blockquote class="blockquote my-3">
			  <p class="mb-0 typography-subheading">Información del útil escolar</p>
			  <hr class="w-100">
			</blockquote>

			<div class="form-row">

				<div class="form-group col-md-12">
			    	<label>Nombre</label>
			   		<input type="text" name="nomb_util" class="form-control {{ $errors->has('nomb_util') ? 'is-invalid' : '' }}" value="{{ old('nomb_util', $implemento->nomb_util) }}"  autofocus>
	                @if ($errors->has('nomb_util'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_util') }}
	                    </div>
	               	@endif
			  	</div>

			</div>
			<div class="form-row">
		 		<div class="form-group col-md-12">
			    	<label>Descripción</label>
			    	<textarea name="desc_util" rows="3" class="form-control {{ $errors->has('desc_util') ? 'is-invalid' : '' }}" autofocus>{{ old('desc_util', $implemento->desc_util) }}
		    		</textarea>
	                @if ($errors->has('desc_util'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('desc_util') }}
	                    </div>
	               	@endif
			  	</div>
			</div>

			<blockquote class="blockquote my-4">
	          <p class="mb-0 typography-subheading">Subgrados asociados</p>
	          <hr class="w-100">
	        </blockquote>

	        <div class="form-row">
                <div class="form-group col-md-12">
                    <ul class="list-group list-group-flush">
                        @foreach($grados as $grado)
	                        @foreach($grado->subGrados->chunk(15) as $chunk)
	                            @foreach($chunk as $subgrado)
	                                <li class="list-group-item list-group-item-action">
	                                    <div class="custom-control custom-checkbox">
	                                        <input type="checkbox"
	                                            id="customCheck{{ $subgrado->id }}" name="subgrados[{{ $subgrado->id }}]"
	                                            class="custom-control-input {{ $errors->has('subgrados.' . $subgrado->id) ? 'is-invalid' : '' }}"
	                                            value="{{ $subgrado->id }}"
	                                            {{ old('subgrados.' . $subgrado->id, $implemento->getSubGradoId($subgrado->id)) === $subgrado->id ? 'checked' : '' }}>
	                                        <label class="custom-control-label" for="customCheck{{ $subgrado->id }}">
	                                            {{ $grado->abre_grad . ' &middot; ' . $subgrado->abre_subg . ' &middot; Jornada '. $grado->getJornada() }}
	                                        </label>
	                                        <div class="text-muted">{{ $subgrado->desc_prog }}</div>
	                                        @if ($errors->has('subgrados.' . $subgrado->id))
	                                            <div class="invalid-feedback">
	                                                {{ $errors->first('subgrados.' . $subgrado->id) }}
	                                            </div>
	                                        @endif
	                                    </div>
	                                </li>
	                            @endforeach
	                        @endforeach
	                    @endforeach
                    </ul>
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