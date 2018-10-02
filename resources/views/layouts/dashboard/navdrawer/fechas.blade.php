@canatleast(['fechas.index', 'fechas.create'])
  <div class="navdrawer-divider"></div>

  <p class="navdrawer-subheader subheader-condensed">Configuración</p>
  <ul class="navdrawer-nav">
    <li class="nav-item">

      <a class="nav-link collapsed" data-toggle="collapse" href="#fechas">
        <i class="material-icons mr-3">date_range</i> Fechas
      </a>
      <div class="collapse {{ Request::is('fechas', 'fechas/*') ? 'show' : '' }}" data-parent="#sidebar" id="fechas">

        @can('fechas.index')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('fechas.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('fechas.index') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">view_list</i> Listar fechas
            </span>
          </a>
        @endcan
        @can('fechas.create')
          <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('fechas.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('fechas.create') }}">
            <span class="font-weight-normal">
              <i class="material-icons mr-2">add</i> Registrar fecha
            </span>
          </a>
        @endcan

      </div>

    </li>
  </ul>
@endcanatleast