@if (isset($disabled) && $disabled)
	<button type="button" class="btn btn-float btn-danger" data-toggle="tooltip" title="Ver información" disabled>
		<i class="material-icons">add</i>
	</button>
@else
	<a href="{{ $route or '' }}"
	   class="btn btn-float" data-toggle="tooltip" title="Registrar">
		<i class="material-icons">add</i>
	</a>
@endif