@extends('layouts.error')
@section('title', 'Se ha superado el límite de ancho de banda disponible')

@section('content')
	<blockquote class="blockquote mb-0">
		<p class="typography-display-2">
			Ancho de banda excedido.
		</p>
	</blockquote>

	<p class="typography-subheading">
		Se ha superado el límite de ancho de banda disponible, intentelo de nuevo.
	</p>
@endsection