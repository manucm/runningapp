<ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="{{ url('/home') }}">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">asdfds</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Pricing</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
    @if(Auth::user())
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Carreras</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ url('/carreras/creacion') }}">Crear Carrera</a>
          <a class="dropdown-item" href="{{ url('/carreras/listado') }}">Ver mis carreras</a>
          <a class="dropdown-item" href="{{ url('/carreras/importar') }}">Importar Carreras</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
    </li>
    @endif
</ul>
