@canatleast(['galerias.index', 'galerias.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#galerias">
    <i class="material-icons mr-3">photo_library</i> Galerias
  </a>
  <div class="collapse {{ Request::is('galerias', 'galerias/*') ? 'show' : '' }}" data-parent="#sidebar" id="galerias">

    @can('galerias.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('galerias.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('galerias.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar galerias
        </span>
      </a>
    @endcan
    @can('galerias.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('galerias.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('galerias.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar galeria
        </span>
      </a>
    @endcan

  </div>
@endcanatleast