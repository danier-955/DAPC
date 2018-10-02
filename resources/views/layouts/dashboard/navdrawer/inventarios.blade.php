@can('inventarios.index')
  <a class="nav-link {{ Request::routeIs('inventarios.index') ? 'active' : '' }}" href="{{ route('inventarios.index') }}">
    <i class="material-icons mr-3">assignment</i> Inventarios
  </a>
@endcan