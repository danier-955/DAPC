@if (isset($disabled) && $disabled)
	<button type="button" class="btn {{ $btnSm or '' }} btn-float btn-danger" data-toggle="tooltip" title="Ver información" disabled>
		<i class="material-icons">directions</i>
	</button>
@else
	<a href="{{ $route or '' }}"
	   class="btn {{ $btnSm or '' }} btn-float" data-toggle="tooltip" title="Ver {{ $name or '' }}">
		<i class="material-icons">directions</i>
	</a>
@endif