@canatleast(['grados.index', 'grados.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#grados">
    <i class="material-icons mr-3">school</i> Grados
  </a>
  <div class="collapse {{ Request::is('grados', 'grados/*', 'subgrados', 'subgrados/*') ? 'show' : '' }}" data-parent="#sidebar" id="grados">

    @can('grados.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('grados.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('grados.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar grados
        </span>
      </a>
    @endcan
    @can('grados.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('grados.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('grados.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar grados
        </span>
      </a>
    @endcan

  </div>
@endcanatleast