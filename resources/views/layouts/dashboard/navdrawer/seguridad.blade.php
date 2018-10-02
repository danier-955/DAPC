@role (SpecialRole::administrador())
  <div class="navdrawer-divider"></div>
  <p class="navdrawer-subheader subheader-condensed">Seguridad</p>

  <ul class="navdrawer-nav">
    <li class="nav-item">

      <a class="nav-link collapsed" data-toggle="collapse" href="#roles">
        <i class="material-icons mr-3">security</i> Roles y permisos
      </a>
      <div class="collapse {{ Request::is('roles', 'roles/*') ? 'show' : '' }}" data-parent="#sidebar" id="roles">
        <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('roles.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('roles.index') }}">
          <span class="font-weight-normal">
            <i class="material-icons mr-2">view_list</i> Listar roles
          </span>
        </a>
        <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('roles.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('roles.create') }}">
          <span class="font-weight-normal">
            <i class="material-icons mr-2">add</i> Registrar roles
          </span>
        </a>
      </div>

      <a class="nav-link {{ Request::routeIs('bitacoras.index') ? 'active' : '' }}" href="{{ route('bitacoras.index') }}">
        <i class="material-icons mr-3">library_books</i> Bitácoras
      </a>

    </li>
  </ul>
@endrole