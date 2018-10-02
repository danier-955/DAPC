@canatleast(['practicantes.index', 'practicantes.create', 'seguimientos.index', 'seguimientos.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#pasantias">
    <i class="material-icons mr-3">folder_shared</i> Pasantias
  </a>
  <div class="collapse {{ Request::is('practicantes', 'practicantes/*', 'seguimientos', 'seguimientos/*') ? 'show' : '' }}" data-parent="#sidebar" id="pasantias">

    @canatleast(['practicantes.index', 'practicantes.create'])
      <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#practicantes">
        <i class="material-icons mr-3">group</i> Practicantes
      </a>
      <div class="collapse {{ Request::is('practicantes', 'practicantes/*') ? 'show' : '' }}" data-parent="#pasantias" id="practicantes">

        @can('practicantes.index')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('practicantes.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('practicantes.index') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">view_list</i> Listar practicantes
            </span>
          </a>
        @endcan
        @can('practicantes.create')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('practicantes.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('practicantes.create') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">add</i> Registrar practicante
            </span>
          </a>
        @endcan

      </div>
    @endcanatleast

    @canatleast(['seguimientos.index', 'seguimientos.create'])
      <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#seguimientos">
        <i class="material-icons mr-3">file_copy</i> Seguimientos
      </a>
      <div class="collapse {{ Request::is('seguimientos', 'seguimientos/*') ? 'show' : '' }}" data-parent="#pasantias" id="seguimientos">

        @can('seguimientos.index')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('seguimientos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('seguimientos.index') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">view_list</i> Listar seguimientos
            </span>
          </a>
        @endcan
        @can('seguimientos.create')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('seguimientos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('seguimientos.create') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">add</i> Registrar seguimiento
            </span>
          </a>
        @endcan

      </div>
    @endcanatleast

  </div>
@endcanatleast