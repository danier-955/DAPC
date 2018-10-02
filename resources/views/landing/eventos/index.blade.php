@extends('layouts.landing')
@section('title', 'Eventos')

@section('content')
<section class="jumbotron jumbotron-fluid bg-primary jumbotron-landing text-center mb-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-8">
        <p class="typography-display-1">
          <i class="material-icons">event_note</i>
        </p>
        <h2 class="typography-display-1">Nuestros eventos</h2>
        <p class="font-weight-light typography-title">Duis aute irure dolor in reprehenderit.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

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
                      {{ optional($evento->inic_even)->format('l d, F Y \· h:i a') }}
                    </span>
                  </p>
                  <p class="typography-subheading card-end">
                    <span class="chip" data-toggle="tooltip" title="Fecha de clausura">
                      <i class="chip-icon bg-danger">T</i>
                      {{ optional($evento->fina_even)->format('l d, F Y \· h:i a') }}
                    </span>
                  </p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <small class="text-muted">
                    Actualizada {{ optional($evento->updated_at)->diffForHumans() }}
                  </small>
                  <button class="btn btn-flat-secondary" data-toggle="modal" data-target="#eventoModal"
                    data-description="{!! nl2br($evento->desc_even) !!}">
                    Más información
                  </button>
                </div>
              </div>

            @endforeach
          </div>

          @if ($eventos->hasPages())
            <hr class="w-100">
            <div class="d-flex align-items-center justify-content-center px-3">
              {{ $eventos->appends(request()->query())->links() }}
            </div>
          @endif

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
    </div>
  </div>
</section>
@endsection