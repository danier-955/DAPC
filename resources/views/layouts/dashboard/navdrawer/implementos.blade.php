@canatleast(['implementos.index', 'implementos.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#implementos">
    <i class="material-icons mr-3">brush</i> Útiles escolares
  </a>
  <div class="collapse {{ Request::is('implementos', 'implementos/*') ? 'show' : '' }}" data-parent="#sidebar" id="implementos">

    @can('implementos.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('implementos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('implementos.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar útiles escolares
        </span>
      </a>
    @endcan
    @can('implementos.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('implementos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('implementos.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar útil escolar
        </span>
      </a>
    @endcan
  </div>
@endcanatleast