@canatleast(['asignaturas.index', 'asignaturas.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#asignaturas">
    <i class="material-icons mr-3">book</i> Asignaturas
  </a>
  <div class="collapse {{ Request::is('asignaturas', 'asignaturas/*') ? 'show' : '' }}" data-parent="#sidebar" id="asignaturas">

    @can('asignaturas.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('asignaturas.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('asignaturas.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar asignaturas
        </span>
      </a>
    @endcan
    @can('asignaturas.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('asignaturas.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('asignaturas.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar asignatura
        </span>
      </a>
    @endcan

  </div>
@endcanatleast