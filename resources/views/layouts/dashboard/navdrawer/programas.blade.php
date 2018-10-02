@canatleast(['programas.index', 'programas.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#programas">
    <i class="material-icons mr-3">local_parking</i> Programas
  </a>
  <div class="collapse {{ Request::is('programas', 'programas/*') ? 'show' : '' }}" data-parent="#sidebar" id="programas">

    @can('programas.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('programas.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('programas.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar programas
        </span>
      </a>
    @endcan
    @can('programas.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('programas.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('programas.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar programa
        </span>
      </a>
    @endcan

  </div>
@endcanatleast