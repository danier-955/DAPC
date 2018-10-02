@canatleast(['eventos.index', 'eventos.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#eventos">
    <i class="material-icons mr-3">event_note</i> Eventos
  </a>
  <div class="collapse {{ Request::is('eventos', 'eventos/*') ? 'show' : '' }}" data-parent="#sidebar" id="eventos">

    @can('eventos.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('eventos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('eventos.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar eventos
        </span>
      </a>
    @endcan
    @can('eventos.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('eventos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('eventos.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar evento
        </span>
      </a>
    @endcan

  </div>
@endcanatleast