@canatleast(['alumnos.index', 'alumnos.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#alumnos">
    <i class="material-icons mr-3">people</i> Alumnos
  </a>
  <div class="collapse  {{ Request::is('alumnos', 'alumnos/*', 'alumnosprogramas', 'alumnosprogramas/*') ? 'show' : '' }}" data-parent="#sidebar" id="alumnos">

    @can('alumnos.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('alumnos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('alumnos.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar alumnos
        </span>
      </a>
    @endcan
    @can('alumnos.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('alumnos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('alumnos.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar alumno
        </span>
      </a>
    @endcan

  </div>
@endcanatleast