@canatleast(['acudientes.index', 'acudientes.create'])
  <a class="nav-link {{ Request::routeIs('acudientes.index') ? 'active' : '' }}" href="{{ route('acudientes.index') }}">
    <i class="material-icons mr-3">group</i> Acudientes
  </a>
@endcanatleast