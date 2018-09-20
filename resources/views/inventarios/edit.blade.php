@extends('layouts.app')
@section('title', 'Editar Utiles')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white shadow-1">
	    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('inventarios.index') }}">Utiles</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('inventarios.edit', $util->id) }}">Editar</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Estas Aquí</li>
	  </ol>
	</nav>

	<div class="card">
		<div class="card-header">
			<h1 class="typography-headline">
				<i class="material-icons mr-1">rate_review</i> Editar Util
			</h1>
		</div>

		<div class="card-body">

		</div>
	</div>
@endsection