@if (isset($disabled) && $disabled)
	<button type="button" class="btn {{ $btnSm or '' }} btn-float btn-danger" data-toggle="tooltip" title="Eliminar" disabled>
		<i class="material-icons">delete</i>
	</button>
@else
	<form method="POST" action="{{ $route or '' }}" style="display: inline;">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		{{-- <button type="submit" class="btn {{ $btnSm or '' }} btn-float btn-danger" data-toggle="tooltip" title="Eliminar">
			<i class="material-icons">delete</i>
		</button> --}}
		<button type="button" class="btn {{ $btnSm or '' }} btn-float btn-danger delete-swal" data-toggle="tooltip" title="Eliminar">
			<i class="material-icons">delete</i>
		</button>
	</form>
@endif