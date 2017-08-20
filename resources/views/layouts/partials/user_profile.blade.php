@if(!$usuarioConectado)
<ul class="navbar-nav mr-auto">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Invitado</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{ url('/login') }}">Login</a>
      <a class="dropdown-item" href="{{ url('/usuarios/creacion') }}">Nuevo Usuario</a>
    </div>
  </li>
</ul>
@else
<ul class="navbar-nav mr-auto">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $usuarioConectado->usuario }}</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{ url('/usuarios/edicion/' . $usuarioConectado->slug ) }}">Editar Perfil</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ url('/logout') }}">Salir</a>
    </div>
  </li>
</ul>
@endif
