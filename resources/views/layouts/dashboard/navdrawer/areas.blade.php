@canatleast(['areas.index', 'areas.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#areas">
    <i class="material-icons mr-3">font_download</i> Areas
  </a>
  <div class="collapse {{ Request::is('areas', 'areas/*') ? 'show' : '' }}" data-parent="#sidebar" id="areas">

    @can('areas.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('areas.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('areas.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar areas
        </span>
      </a>
    @endcan
    @can('areas.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('areas.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('areas.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar area
        </span>
      </a>
    @endcan

  </div>
@endcanatleast