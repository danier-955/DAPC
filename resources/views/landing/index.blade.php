@extends('layouts.landing')
@section('title', '¡Bienvenido!')

@section('content')
<section class="jumbotron jumbotron-fluid bg-primary jumbotron-landing text-center" id="inicio">
  <div class="container p-md-5">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-8">
        <h1 class="typography-display-4">{{ config('app.name') }}</h1>
        <p class="font-weight-light typography-title">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
        <p>
          <a href="{{ route('login') }}" class="btn btn-lg btn-secondary my-2">
            <i class="material-icons mr-2">input</i> Comenzar
          </a>
        </p>
      </div>
    </div>
  </div>
</section>

<section class="py-5" id="promociones">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center py-5">
          <h2 class="typography-display-1">Nuestras promociones</h2>
          <p class="lead text-muted">Duis aute irure dolor in reprehenderit.</p>
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Programas de Formación</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            @foreach($programas as $programa)
              <div class="list-group list-group-flush" >
                <div class="expansion-panel list-group-item">
                    <div class="card" >
                      <div class="card-body">
                        <a aria-controls="collapseFour" aria-expanded="false" class="expansion-panel-toggler collapsed" data-toggle="collapse" href="#{{'acordeon'. $loop->index}}" id="headingFour">
                        {{ $programa->nomb_prog }}
                          <div class="expansion-panel-icon ml-3 text-black-secondary">
                            <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                            <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
                          </div>
                        </a>
                        <div aria-labelledby="headingFour" class="collapse"  id="{{'acordeon'. $loop->index}}">
                          <div class="expansion-panel-body">
                            {{$programa->desc_prog}}
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Actividades realizadas</h5>
          </div>
          <div id="galeriaSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">

              @forelse ($galerias as $galeria)
                <div class="carousel-item {{ ($loop->index === 0) ? 'active' : '' }}">
                  <img class="d-block w-100" src="{{ Storage::disk('galeria')->url($galeria->foto_gale) }}" alt="{{ $galeria->titu_gale }}">
                  <div class="carousel-caption d-none d-md-block">
                    <h5 class="typography-title">{{ $galeria->titu_gale }}</h5>
                    <p class="typography-caption text-justify">{{ $galeria->desc_gale }}</p>
                  </div>
                </div>
              @empty
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{ asset('img/sin-galeria.jpg') }}" alt="Sin galeria">
                  <div class="carousel-caption d-none d-md-block">
                    <h5 class="typography-title">¡No hay fotografías disponibles!</h5>
                    <p class="typography-caption text-justify">Pronto actualizaremos pronto nuestra galeria.</p>
                  </div>
                </div>
              @endforelse

            </div>
            @if ($galerias->isNotEmpty())
              <ol class="carousel-indicators">
                @for ($i = 0; $i < $galerias->count(); $i++)
                  <li data-target="#galeriaSlider" data-slide-to="{{ $i }}" {!! ($i === 0) ? 'class="active"' : '' !!}></li>
                @endfor
              </ol>
              <a class="carousel-control-prev" href="#galeriaSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
              </a>
              <a class="carousel-control-next" href="#galeriaSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light" id="eventos">
  <div class="container mb-5">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex align-items-center flex-column justify-content-center py-5">
          <p class="typography-display-1">
            <i class="material-icons">event_note</i>
          </p>
          <h2 class="typography-display-1">Nuestros eventos</h2>
          <p class="lead text-muted">Duis aute irure dolor in reprehenderit.</p>
        </div>
      </div>
    </div>
    @if ($eventos->isNotEmpty())

      <div class="card-columns">
        @foreach($eventos as $evento)

          <div class="card">
            @if (Storage::disk('evento')->exists($evento->foto_even))
              <img class="card-img-top img-fluid"
                src="{{ Storage::disk('evento')->url($evento->foto_even) }}"
                alt="{{ $evento->titu_even }}">
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $evento->titu_even }}</h5>
              <p class="typography-subheading card-quote">
                No. cupos
                <span class="chip font-weight-bold">{{ $evento->cupo_even }} alumnos</span>
              </p>
              <p class="typography-subheading card-start">
                <span class="chip" data-toggle="tooltip" title="Fecha de inicio">
                  <i class="chip-icon bg-primary">C</i>
                  {{ optional($evento->inic_even)->format('l d, F Y \— h:i a') }}
                </span>
              </p>
              <p class="typography-subheading card-end">
                <span class="chip" data-toggle="tooltip" title="Fecha de clausura">
                  <i class="chip-icon bg-danger">T</i>
                  {{ optional($evento->fina_even)->format('l d, F Y \— h:i a') }}
                </span>
              </p>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <small class="text-muted">
                Actualizada {{ optional($evento->updated_at)->diffForHumans() }}
              </small>
              <button class="btn btn-flat-secondary" data-toggle="modal" data-target="#eventoModal"
                data-title="{{ $evento->titu_even }}"
                data-description="{!! nl2br($evento->desc_even) !!}">
                Más información
              </button>
            </div>
          </div>

        @endforeach
      </div>

      <div class="d-flex align-items-center justify-content-center mt-3">
        <a href="{{ route('landing.eventos') }}" class="btn btn-lg btn-secondary">
          <i class="material-icons mr-2">check_circle</i> Ver más eventos
        </a>
      </div>

      @include('landing.partials.modal_evento')

    @else

      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          <div class="card text-center">
            <div class="card-body my-3">
              <blockquote class="blockquote mb-0">
                <p class="typography-headline">
                  ¡No hay eventos disponibles!
                </p>
                <p class="lead text-muted">
                  Pronto llegarán nuevos eventos.
                </p>
              </blockquote>
            </div>
          </div>
        </div>
      </div>

    @endif
  </div>
</section>

<section class="py-5" id="contactenos">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex align-items-center flex-column justify-content-center py-5">
          <p class="typography-display-1">
            <i class="material-icons">email</i>
          </p>
          <h2 class="typography-display-1">Contáctenos</h2>
          <p class="lead text-muted">Duis aute irure dolor in reprehenderit.</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <h5 class="card-header">Completa la información</h5>
          <div class="card-body">
            <form>
              <div class="form-group row">
                	<div class="col-md-4">
                		<div class="floating-label">
                    	<label for="nombres">Nombres</label>
                    	<input type="text" class="form-control" id="nombres" placeholder="Nombres..." required>
                    </div>
                	</div>
                	<div class="col-md-4">
                		<div class="floating-label">
                     	<label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" id="apellidos" placeholder="Apellidos..." required>
                    </div>
                	</div>
                	<div class="col-md-4">
                		<div class="floating-label">
	                  	<label for="correo">Correo Electrónico</label>
	                  	<input type="email" class="form-control" id="correo" placeholder="Correo electrónico..." required>
	                  	</div>
                	</div>
              </div>
              <div class="form-group">
              	<div class="floating-label">
                		<label for="asunto">Asunto</label>
                		<input type="text" class="form-control" id="asunto" placeholder="Asunto..." required>
              	</div>
              </div>
              <div class="form-group">
              	<textarea class="form-control" id="mensaje" rows="5" placeholder="Escribe aquí tu mensaje..." required></textarea>
              </div>
              <hr>
              <div class="form-group text-center">
                	<button type="reset" class="btn btn-secondary">Limpiar</button>
                	<button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection