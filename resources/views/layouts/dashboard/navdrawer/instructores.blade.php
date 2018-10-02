@canatleast(['docentes.index', 'docentes.create', 'planeamientos.index', 'planeamientos.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#instructores">
    <i class="material-icons mr-3">people</i> Instructores
  </a>
  <div class="collapse {{ Request::is('docentes', 'docentes/*', 'planeamientos', 'planeamientos/*') ? 'show' : '' }}" data-parent="#sidebar" id="instructores">

    @canatleast(['docentes.index', 'docentes.create'])
      <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#docentes">
        <i class="material-icons mr-3">group</i> Docentes
      </a>
      <div class="collapse {{ Request::is('docentes', 'docentes/*') ? 'show' : '' }}" data-parent="#instructores" id="docentes">

        @can('docentes.index')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('docentes.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('docentes.index') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">view_list</i> Listar docentes
            </span>
          </a>
        @endcan
        @can('docentes.create')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('docentes.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('docentes.create') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">add</i> Registrar docente
            </span>
          </a>
        @endcan

      </div>
    @endcanatleast

    @canatleast(['planeamientos.index', 'planeamientos.create'])
      <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#planeamientos">
        <i class="material-icons mr-3">local_library</i> Planeaciones
      </a>
      <div class="collapse {{ Request::is('planeamientos', 'planeamientos/*') ? 'show' : '' }}" data-parent="#instructores" id="planeamientos">

        @can('planeamientos.index')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('planeamientos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('planeamientos.index') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">view_list</i> Listar planeaciones
            </span>
          </a>
        @endcan
        @can('planeamientos.create')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('planeamientos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('planeamientos.create') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">add</i> Registrar planeación
            </span>
          </a>
        @endcan

      </div>
    @endcanatleast

  </div>
@endcanatleast