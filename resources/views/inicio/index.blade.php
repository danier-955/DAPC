@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white shadow-1">
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Estas aquí</li>
  </ol>
</nav>

<div class="alert alert-danger typography-subheading">
  * Validar al registrar y editar que el nombre de la materia no se repita en el mismo grado, y que la suma del peso de las materias con la misma area no supere el 100%.<br>
  * Validar al registrar y editar que la abreviación del grado no se repita de acuerdo a la jornada.<br>
  * Validar al registrar y editar que la abreviación del subgrado no se repita de acuerdo al grado.<br>
  * En estudiantes filtrar y mostrar estudiante por estado para saber cuales estan activos, inactivos, y la fecha de retirados y graduados (tambien colocarlo en el editar y show).<br>
  * Validar que al registrar un almuno un evento no se cruzen con otros eventos que tenga registrado o vaya a registrar.<br>
</div>

<div class="jumbotron text-center">
  <h1 class="typography-display-3">Bienvenid@ a {{ config('app.name') }}</h1>
  <p class="typography-headline">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p class="typography-subheading">It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-lg btn-secondary" href="javascript:(void);" role="button">Ver más</a>
</div>
@endsection
