@extends('layouts.app')
@section('title', 'Galerias')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('galerias.index') }}">Galerias</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="card">
	<div class="card-header d-flex align-items-center justify-content-between bg-light-2">
		<h1 class="typography-headline">
			<i class="material-icons mr-1">photo_library</i> Galerias
		</h1>
		@can('galerias.create')
			@include('partials.button_create', ['route' => route('galerias.create')])
		@endcan
	</div>
	<div class="card-body">

		<form method="GET" action="{{ route('galerias.index') }}" autocomplete="off">
			<div class="row clearfix">
            	<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label>Titulo</label>
						<input type="text" name="titu_gale"
							class="form-control {{ $errors->has('titu_gale') ? 'is-invalid' : '' }}"
							value="{{ old('titu_gale', Request::get('titu_gale')) }}">
		                @if ($errors->has('titu_gale'))
		                    <div class="invalid-feedback">
		                    	{{ $errors->first('titu_gale') }}
		                    </div>
		               	@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label>Página principal</label>
				   		<div class="custom-control custom-checkbox mt-3">
		                    <input type="checkbox" id="most_gale" name="most_gale" class="custom-control-input" {{ old('most_gale', Request::get('most_gale')) ? 'checked' : '' }}>
		                    <label class="custom-control-label" for="most_gale">
		                    	Visible en página principal
		                    </label>
		                </div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="form-group my-4 d-flex justify-content-sm-center justify-content-md-start">
						<button type="submit" class="btn btn-secondary">Búscar</button>
					</div>
				</div>
        	</div>
        </form>
	  	<hr class="mt-0 w-100">

		@if ($galerias->isNotEmpty())
			<div class="card-columns">
				@foreach($galerias as $galeria)

					<div class="card">
						@if (Storage::disk('galeria.thumbnail')->exists($galeria->foto_gale))
							<img class="card-img-top img-fluid"
								src="{{ Storage::disk('galeria.thumbnail')->url($galeria->foto_gale) }}"
								alt="{{ $galeria->titu_gale }}">
						@else
							<div class="card-body bg-light-2 text-center py-5">
								<p class="typography-display-3 text-black-secondary">
									<i class="material-icons">broken_image</i>
								</p>
							</div>
						@endif
						<div class="card-body">
							<h5 class="card-title">{{ $galeria->titu_gale }}</h5>
							<p class="card-text">{!! nl2br($galeria->desc_gale) !!}</p>
							<p class="card-text chip">
								Resp.
								<span class="font-weight-bold ml-1">
									{{ $galeria->getAdministrativo() }}
								</span>
							</p>
					      	<p class="card-text">
					      		<small class="text-muted">
					      			Jornada {{ $galeria->getJornada() }} &middot;
					      			Actualizada {{ optional($galeria->updated_at)->diffForHumans() }}
					      		</small>
					      	</p>
						</div>
					    <div class="card-footer d-flex align-items-center justify-content-between">
					    	<div class="chip {{ $galeria->getVisibleColor() }}">
					    		{{ $galeria->getVisibleTitulo() }}
					    	</div>
							<div class="text-right">
								@can('galerias.edit')
									@include('partials.button_edit', ['btnSm' => 'btn-sm', 'route' => route('galerias.edit', $galeria->id)])
								@endcan
								@can('galerias.destroy')
									@include('partials.button_destroy', ['btnSm' => 'btn-sm', 'route' => route('galerias.destroy', $galeria->id)])
								@endcan
							</div>
					    </div>
					</div>

				@endforeach
			</div>
		@else
			@component('partials.alert_empty')
				No hay galerias registradas.
			@endcomponent
		@endif
	</div>
	@if ($galerias->hasPages())
	  	<hr class="my-0 w-100">
	  	<div class="card-actions align-items-center justify-content-center px-3">
	    	{{ $galerias->appends(request()->query())->links() }}
	  	</div>
  	@endif
</div>
@endsection