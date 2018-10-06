@canatleast(['notas.index', 'notas.create'])
  <a class="nav-link collapsed" data-toggle="collapse" href="#notas">
    <i class="material-icons mr-3">note</i> Notas
  </a>
  <div class="collapse {{ Request::is('notas', 'notas/*') ? 'show' : '' }}" data-parent="#sidebar" id="notas">

    @can('notas.index')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('notas.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('notas.index') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">view_list</i> Listar notas
        </span>
      </a>
    @endcan
    @can('notas.create')
      <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('notas.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('notas.create') }}">
        <span class="font-weight-normal">
          <i class="material-icons mr-2">add</i> Registrar nota
        </span>
      </a>
    @endcan

  </div>
@endcanatleast