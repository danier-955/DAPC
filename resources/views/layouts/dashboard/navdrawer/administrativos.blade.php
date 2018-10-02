@canatleast(['administrativos.index', 'administrativos.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#administrativos">
    <i class="material-icons mr-3">people_outline</i> Administrativos
  </a>
  <div class="collapse {{ Request::is('administrativos', 'administrativos/*') ? 'show' : '' }}" data-parent="#sidebar" id="administrativos">

    @can('administrativos.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('administrativos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('administrativos.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar administrativos
        </span>
      </a>
    @endcan
    @can('administrativos.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('administrativos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('administrativos.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar administrativo
        </span>
      </a>
    @endcan

  </div>
@endcanatleast