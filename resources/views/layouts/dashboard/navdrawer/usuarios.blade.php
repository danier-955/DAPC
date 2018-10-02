@can('usuarios.index')
	<a class="nav-link {{ Request::routeIs('usuarios.index') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
    	<i class="material-icons mr-3">supervised_user_circle</i> Usuarios
  	</a>
@endcan