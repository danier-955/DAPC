<a class="nav-link collapsed" data-toggle="collapse" href="#usuario">
  <i class="material-icons mr-3">account_circle</i> {{ Auth::user()->nombre }}
</a>
<div class="collapse" data-parent="#sidebar" id="usuario">
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