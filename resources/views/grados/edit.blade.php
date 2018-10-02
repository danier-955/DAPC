@extends('layouts.app')
@section('title', 'Editar grado')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
	<li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	<li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
	<li class="breadcrumb-item"><a href="{{ route('grados.edit', $grado->id) }}">Editar</a></li>
	<li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
  		<h1 class="typography-headline">
  			<i class="material-icons mr-1">school</i> Editar grado
  		</h1>
		<div>
			@can('grados.subgrados.create')
				@include('partials.button_subgrado', ['route' => route('grados.subgrados.create', $grado->id)])
			@endcan
		</div>
  	</div>
	<div class="card-body">

        <blockquote class="blockquote my-3">
          <p class="mb-0 typography-subheading">Información del grado</p>
          <hr class="w-100">
        </blockquote>

		<form  method="post" action="{{route('grados.update', $grado->id)}} " autocomplete="off">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-row">
				<div class="form-group col-md-6">
			    	<label>Nombre</label>
			   		<input type="text" name="nomb_grad" class="form-control {{ $errors->has('nomb_grad') ? 'is-invalid' : '' }}" value="{{ $grado->nomb_grad }}" required autofocus>
	                @if ($errors->has('nomb_grad'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('nomb_grad') }}
	                    </div>
	               	@endif
		  		</div>
		  		<div class="form-group col-md-3">
			    	<label>Abreviación (letras o números)</label>
			   		<input type="text" name="abre_grad" class="form-control {{ $errors->has('abre_grad') ? 'is-invalid' : '' }}" value="{{ $grado->abre_grad }}" required autofocus>
	                @if ($errors->has('abre_grad'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('abre_grad') }}
	                    </div>
	               	@endif
		  		</div>
		  		<div class="form-group col-md-3">
			    	<label>Jornada</label>
				    <select name="jorn_grad" class="selectpicker dropdown-dense show-tick selectbox form-control {{ $errors->has('jorn_grad') ? 'is-invalid' : '' }}" required autofocus>
				    	<option value="{{ $grado->jorn_grad }}" selected>
	                    	{{ $grado->getJornada() }}
	                    </option>
				    	@foreach($jornadas as $jornada)
				      		<option value="{{ $jornada['id'] }}"
				      		@if (old('jorn_grad', $grado->jorn_grad) === $jornada['id']){{ 'selected' }}@endif>
				      			{{ $jornada['texto'] }}
				      		</option>
				      	@endforeach
				    </select>
	                @if ($errors->has('jorn_grad'))
	                    <div class="invalid-feedback">
	                    	{{ $errors->first('jorn_grad') }}
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

        <blockquote class="blockquote my-4">
          <p class="mb-0 typography-subheading">Subgrados asociados</p>
          <hr class="w-100">
        </blockquote>

        @if ($grado->subGrados->isNotEmpty())
            <div class="table-responsive">
                <table cellspacing="0" cellpadding="0" class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Abreviación</th>
                            <th>Capacidad estudiantes</th>
                            <th>Director de grupo</th>
                            <th class="text-center">Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $iteration = 1;
                        @endphp
                        @foreach($grado->subGrados->chunk(15) as $chunk)
                            @foreach($chunk as $subgrado)
                                <tr>
                                    <td>{{ $iteration++ }}</td>
                                    <td>{{ $subgrado->abre_subg }}</td>
                                    <td>{{ $subgrado->cant_estu }}</td>
                                    <td>{{ $subgrado->getDirectorNombre() }}</td>
                                    <td class="text-center">
                                        @can('grados.subgrados.edit')
                                            @include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('grados.subgrados.edit', [$grado->id, $subgrado->id])])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            @component('partials.alert_empty')
                No hay subgrados asociados.
            @endcomponent
        @endif

	</div>
</div>
@endsection