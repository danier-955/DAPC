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

          <a class="nav-link collapsed" data-toggle="collapse" href="#user">
            <i class="material-icons mr-3">account_circle</i> {{ Auth::user()->nombre }}
          </a>
          <div class="collapse" data-parent="#sidebar" id="user">
            <a class="nav-item nav-link pl-5 py-3 text-black-secondary" href="{{ route('usuarios.show', Auth::user()->id) }}">
              <span class="font-weight-normal">
                <i class="material-icons mr-2">person_outline</i> Ver usuario
              </span>
            </a>
            <a class="nav-item nav-link pl-5 py-3 text-black-secondary" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span class="font-weight-normal">
                <i class="material-icons mr-2">exit_to_app</i> Cerrar sesión
              </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>

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

        @canatleast(['administrativos.index', 'administrativos.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#administrativos">
            <i class="material-icons mr-3">people_outline</i> Administrativos
          </a>
          <div class="collapse {{ Request::is('administrativos', 'administrativos/*') ? 'show' : '' }}" data-parent="#sidebar" id="administrativos">

            @can('administrativos.index')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('administrativos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('administrativos.index') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">view_list</i> Listar administrativos
                </span>
              </a>
            @endcan
            @can('administrativos.create')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('administrativos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('administrativos.create') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">add</i> Registrar administrativo
                </span>
              </a>
            @endcan

          </div>
        @endcanatleast

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

        @canatleast(['asignaturas.index', 'asignaturas.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#asignaturas">
            <i class="material-icons mr-3">book</i> Asignaturas
          </a>
          <div class="collapse {{ Request::is('asignaturas', 'asignaturas/*') ? 'show' : '' }}" data-parent="#sidebar" id="asignaturas">

            @can('asignaturas.index')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('asignaturas.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('asignaturas.index') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">view_list</i> Listar asignaturas
                </span>
              </a>
            @endcan
            @can('asignaturas.create')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('asignaturas.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('asignaturas.create') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">add</i> Registrar asignatura
                </span>
              </a>
            @endcan

          </div>
        @endcanatleast

         @can('calendarios.index')
          <a class="nav-link {{ Request::routeIs('calendarios.index') ? 'active' : '' }}" href="{{ route('calendarios.index') }}">
            <i class="material-icons mr-3">event</i> Calendarios
          </a>
        @endcan

        @canatleast(['eventos.index', 'eventos.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#eventos">
            <i class="material-icons mr-3">event_note</i> Eventos
          </a>
          <div class="collapse {{ Request::is('eventos', 'eventos/*') ? 'show' : '' }}" data-parent="#sidebar" id="eventos">

            @can('eventos.index')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('eventos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('eventos.index') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">view_list</i> Listar eventos
                </span>
              </a>
            @endcan
            @can('eventos.create')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('eventos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('eventos.create') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">add</i> Registrar evento
                </span>
              </a>
            @endcan

          </div>
        @endcanatleast

         @canatleast(['galerias.index', 'galerias.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#galerias">
            <i class="material-icons mr-3">photo_library</i> Galerias
          </a>
          <div class="collapse {{ Request::is('galerias', 'galerias/*') ? 'show' : '' }}" data-parent="#sidebar" id="galerias">

            @can('galerias.index')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('galerias.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('galerias.index') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">view_list</i> Listar galerias
                </span>
              </a>
            @endcan
            @can('galerias.create')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('galerias.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('galerias.create') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">add</i> Registrar galeria
                </span>
              </a>
            @endcan

          </div>
        @endcanatleast

         @canatleast(['grados.index', 'grados.create', 'subgrados.index', 'subgrados.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#crear_grados">
            <i class="material-icons mr-3">school</i> Grados
          </a>
          <div class="collapse {{ Request::is('grados', 'grados/*', 'subgrados', 'subgrados/*') ? 'show' : '' }}" data-parent="#crear_grados" id="crear_grados">

            @canatleast(['grados.index', 'grados.create'])
              <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#subgrados">
                <i class="material-icons mr-3">school</i> grados
              </a>
              <div class="collapse {{ Request::is('grados', 'grados/*') ? 'show' : '' }}" data-parent="#docentes" id="subgrados">

                @can('grados.index')
                  <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('grados.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('grados.index') }}">
                    <span class="font-weight-normal">
                      <i class="material-icons mr-2">view_list</i> Listar grados
                    </span>
                  </a>
                @endcan
                @can('grados.create')
                  <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('grados.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('grados.create') }}">
                    <span class="font-weight-normal">
                      <i class="material-icons mr-2">add</i> Registrar grados
                    </span>
                  </a>
                @endcan

              </div>
            @endcanatleast

            @canatleast(['subgrados.index', 'subgrados.create'])
              <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#subsubgrados">
                <i class="material-icons mr-3">school</i> subgrados
              </a>
              <div class="collapse {{ Request::is('subgrados', 'subgrados/*') ? 'show' : '' }}" data-parent="#pasantias" id="subsubgrados">

                @can('subgrados.index')
                  <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('subgrados.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('subgrados.index') }}">
                    <span class="font-weight-normal">
                      <i class="material-icons mr-2">view_list</i> Listar subgrados
                    </span>
                  </a>
                @endcan
                @can('subgrados.create')
                  <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('subgrados.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('subgrados.create') }}">
                    <span class="font-weight-normal">
                      <i class="material-icons mr-2">add</i> Registrar subgrados
                    </span>
                  </a>
                @endcan

              </div>
            @endcanatleast

          </div>
        @endcanatleast

        @canatleast(['estudiantes.index', 'estudiantes.create', 'inventarios.index', 'inventarios.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#incripciones">
          <i class="material-icons mr-3">wc</i> Incripciones
          </a>
          <div class="collapse  {{ Request::is('estudiantes', 'estudiantes/*', 'inventarios', 'inventarios/*') ? 'show' : '' }}"  data-parent="#sidebar" id="incripciones">
            
            <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('estudiantes.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('estudiantes.create') }}">
              <span class="font-weight-normal">
                <i class="material-icons mr-2">add</i> Registrar Estudiante
              </span>
            </a>
            <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('acudientes.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('acudientes.index') }}">
              <span class="font-weight-normal">
                <i class="material-icons mr-2">view_list</i> Listar Acudientes
              </span>
            </a>
            <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('estudiantes.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('estudiantes.index') }}">
              <span class="font-weight-normal">
                <i class="material-icons mr-2">view_list</i> Listar Estudiante
              </span>
            </a>
          </div>
        @endcanatleast

        @canatleast(['docentes.index', 'docentes.create', 'planeamientos.index', 'planeamientos.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#docentes">
            <i class="material-icons mr-3">assignment_ind</i> Instructores
          </a>
          <div class="collapse {{ Request::is('docentes', 'docentes/*', 'planeamientos', 'planeamientos/*') ? 'show' : '' }}" data-parent="#sidebar" id="docentes">

            @canatleast(['docentes.index', 'docentes.create'])
              <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#subdocentes">
                <i class="material-icons mr-3">group</i> Docentes
              </a>
              <div class="collapse {{ Request::is('docentes', 'docentes/*') ? 'show' : '' }}" data-parent="#docentes" id="subdocentes">

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
              <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#subplaneaciones">
                <i class="material-icons mr-3">local_library</i> Planeaciones
              </a>
              <div class="collapse {{ Request::is('planeamientos', 'planeamientos/*') ? 'show' : '' }}" data-parent="#docentes" id="subplaneaciones">

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

        @can('inventarios.index')
          <a class="nav-link {{ Request::routeIs('inventarios.index') ? 'active' : '' }}" href="{{ route('inventarios.index') }}">
            <i class="material-icons mr-3">account_balance</i> Inventarios
          </a>
        @endcan

       @canatleast(['alumnos.index', 'alumnos.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#alumnos">
            <i class="material-icons mr-3">assignment_ind</i> Matriculas Alumnos
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
                  <i class="material-icons mr-2">add</i> Registrar alumnos
                </span>
              </a>
            @endcan

          </div>
        @endcanatleast

        @canatleast(['practicantes.index', 'practicantes.create', 'seguimientos.index', 'seguimientos.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#pasantias">
            <i class="material-icons mr-3">assignment_turned_in</i> Pasantias
          </a>
          <div class="collapse {{ Request::is('practicantes', 'practicantes/*', 'seguimientos', 'seguimientos/*') ? 'show' : '' }}" data-parent="#pasantias" id="pasantias">

            @canatleast(['practicantes.index', 'practicantes.create'])
              <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#subpracticantes">
                <i class="material-icons mr-3">group</i> Practicantes
              </a>
              <div class="collapse {{ Request::is('practicantes', 'practicantes/*') ? 'show' : '' }}" data-parent="#docentes" id="subpracticantes">

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
              <a class="nav-link collapsed pl-4" data-toggle="collapse" href="#subseguimientos">
                <i class="material-icons mr-3">class</i> Seguimientos
              </a>
              <div class="collapse {{ Request::is('seguimientos', 'seguimientos/*') ? 'show' : '' }}" data-parent="#pasantias" id="subseguimientos">

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

        @canatleast(['programas.index', 'programas.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#programas">
            <i class="material-icons mr-3">rate_review</i> Programas Formación
          </a>
          <div class="collapse {{ Request::is('programas', 'programas/*') ? 'show' : '' }}" data-parent="#sidebar" id="programas">

            @can('programas.index')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('programas.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('programas.index') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">view_list</i> Listar programas
                </span>
              </a>
            @endcan
            @can('programas.create')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('programas.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('programas.create') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">add</i> Registrar programa
                </span>
              </a>
            @endcan
            
          </div>
        @endcanatleast
        
        @can('usuarios.index')
          <a class="nav-link {{ Request::routeIs('usuarios.index') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
            <i class="material-icons mr-3">supervised_user_circle</i> Usuarios
          </a>
        @endcan 
        
        @canatleast(['implementos.index', 'implementos.create'])
          <a class="nav-link collapsed" data-toggle="collapse" href="#implementos">
            <i class="material-icons mr-3">library_books</i> Utiles Escolares
          </a>
          <div class="collapse {{ Request::is('implementos', 'implementos/*') ? 'show' : '' }}" data-parent="#sidebar" id="implementos">

            @can('implementos.index')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('implementos.index') ? 'active' : 'text-black-secondary' }}" href="{{ route('implementos.index') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">view_list</i> Listar implementos
                </span>
              </a>
            @endcan
            @can('implementos.create')
              <a class="nav-item nav-link pl-5 py-3 {{ Request::routeIs('implementos.create') ? 'active' : 'text-black-secondary' }}" href="{{ route('implementos.create') }}">
                <span class="font-weight-normal">
                  <i class="material-icons mr-2">add</i> Registrar implementos
                </span>
              </a>
            @endcan
          </div>
        @endcanatleast
        
      </li>
    </ul>

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

  </div>
</aside>