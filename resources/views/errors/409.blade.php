@extends('layouts.error')
@section('title', 'Error en la consulta')

@section('content')
	<blockquote class="blockquote mb-0">
		<p class="typography-display-2">
			Error en la consulta.
		</p>
	</blockquote>

	<p class="typography-subheading">
		No se puede eliminar de forma permanente el recurso porque está relacionado con algún otro.
	</p>
@endsection