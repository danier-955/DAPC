@isset ($usuario)
	@if ($usuario->esAcudiente())
		@can('acudientes.show')
			@include('partials.button_info', ['route' => route('acudientes.show', $usuario->acudiente->id), 'name' => 'acudiente'])
		@endcan
	@elseif ($usuario->esAdministrativo())
		@can('administrativos.show')
			@include('partials.button_info', ['route' => route('administrativos.show', $usuario->administrativo->id), 'name' => 'administrativo'])
		@endcan
	@elseif ($usuario->esDocente())
		@can('docentes.show')
			@include('partials.button_info', ['route' => route('docentes.show', $usuario->docente->id), 'name' => 'docente'])
		@endcan
	@elseif ($usuario->esEstudiante())
		@can('estudiantes.show')
			@include('partials.button_info', ['route' => route('estudiantes.show', $usuario->estudiante->id), 'name' => 'estudiante'])
		@endcan
	@else
		@isset ($btnSm)
			@include('partials.button_info', ['disabled' => true])
		@endisset
	@endif
@endisset