<aside aria-hidden="true" class="navdrawer navdrawer-permanent-lg shadow-1" id="navdrawerMD" tabindex="-1">
  <div class="navdrawer-content" id="sidebar">
    <div class="navdrawer-header bg-primary navdrawer-lg-shadow">
      <span class="navbar-brand px-0">{{ config('app.name') }}</span>
    </div>
    @auth
      <nav class="navdrawer-nav">
        <li class="nav-item">

          <div class="jumbotron jumbotron-user shadow-none">
          	<div class="typography-subheading text-truncate">
          		<i class="material-icons mr-2">security</i> {{ Auth::user()->getRolNombre() }}
          	</div>
          	<div class="typography-caption text-truncate text-white-secondary mt-1">
          		<i class="material-icons mr-3">hdr_strong</i> {{ Auth::user()->email }}
          	</div>
          </div>

        </li>
        <li class="nav-item">

          @include('layouts.dashboard.navdrawer.sesion')

        </li>
      </nav>
    @endauth

    <div class="navdrawer-divider"></div>
    <p class="navdrawer-subheader subheader-condensed">General</p>

    <ul class="navdrawer-nav">
      <li class="nav-item">

        <a class="nav-link {{ Request::routeIs('inicio') ? 'active' : '' }}" href="{{ route('inicio') }}">
          <i class="material-icons mr-3">home</i> Inicio
        </a>

        @include('layouts.dashboard.navdrawer.usuarios')

        @include('layouts.dashboard.navdrawer.administrativos')

        @include('layouts.dashboard.navdrawer.instructores')

        @include('layouts.dashboard.navdrawer.estudiantes')

        @include('layouts.dashboard.navdrawer.acudientes')

        <div class="navdrawer-divider"></div>

        @include('layouts.dashboard.navdrawer.grados')

        @include('layouts.dashboard.navdrawer.areas')

        @include('layouts.dashboard.navdrawer.asignaturas')

        <div class="navdrawer-divider"></div>

        @include('layouts.dashboard.navdrawer.galerias')

        @include('layouts.dashboard.navdrawer.calendarios')

        @include('layouts.dashboard.navdrawer.eventos')

        @include('layouts.dashboard.navdrawer.programas')

        @include('layouts.dashboard.navdrawer.alumnos')

        @include('layouts.dashboard.navdrawer.pasantias')

        <div class="navdrawer-divider"></div>

        @include('layouts.dashboard.navdrawer.implementos')

        @include('layouts.dashboard.navdrawer.inventarios')

      </li>
    </ul>

    @include('layouts.dashboard.navdrawer.fechas')

    @include('layouts.dashboard.navdrawer.seguridad')

  </div>
</aside>