@canatleast(['estudiantes.index', 'estudiantes.create', 'acudientes.index', 'acudientes.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#estudiantes">
    <i class="material-icons mr-3">wc</i> Estudiantes
  </a>
  <div class="collapse {{ Request::is('estudiantes', 'estudiantes/*') ? 'show' : '' }}"  data-parent="#sidebar" id="estudiantes">

    @can('estudiantes.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('estudiantes.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('estudiantes.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar estudiantes
        </span>
      </a>
    @endcan
    @can('estudiantes.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('estudiantes.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('estudiantes.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar estudiante
        </span>
      </a>
    @endcan

  </div>
@endcanatleast