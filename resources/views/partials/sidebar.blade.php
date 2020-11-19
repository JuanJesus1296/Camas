<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <div class="nav-link">
          <div class="user-wrapper">
            <div class="profile-image">
              <img src="{{ asset('images/149071.png') }}" alt="profile image">
            </div>
            <div class="text-wrapper">
              <p class="profile-name">{{ strtoupper(auth()->user()->person->fullname) }}</p>
              <div>
                <small class="designation text-muted">{{ strtoupper(auth()->user()->person->name) }}</small>
                <span class="status-indicator online"></span>
              </div>
            </div>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#inicio2" aria-expanded="false" aria-controls="inicio2">
          <i class="menu-icon mdi mdi-home"></i>
          <span class="menu-title">Inicio</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="inicio2">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Matriz de camas</a>
            </li>

          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#mantenimiento" aria-expanded="false" aria-controls="mantenimiento">
          <i class="menu-icon fa fa-cogs"></i>
          <span class="menu-title">Mantenimiento</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="mantenimiento">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('pacientes.index') }}">Pacientes</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('medicos.index') }}">Médicos</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('diagnosticos.index') }}">Diagnósticos</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('equipos.index') }}">Equipos</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('habitaciones.index') }}">Habitaciones</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('pisos.index') }}">Espacios físicos</a>
            </li>

          </ul>
        </div>
      </li>


      @canany (['Activar médico', 'Desactivar médico'])
      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#administracion" aria-expanded="false" aria-controls="administracion">
          <i class="menu-icon mdi mdi-television"></i>
          <span class="menu-title">Administración</span>
          <i class="menu-arrow"></i>
        </a>
        @canany (['Activar médico', 'Desactivar médico'])
        <div class="collapse" id="administracion">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('home')  }}">Médicos</a>
            </li>
          </ul>
        </div>
        @endcan
      </li>
      @endcan

      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#security" aria-expanded="false" aria-controls="security">
          <i class="menu-icon mdi mdi-security"></i>
          <span class="menu-title">Seguridad</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="security">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('cuentas.usuario')}}">Cuentas de Usuario</a>
            </li>


            <li class="nav-item">
            <a class="nav-link" href="{{ route('seguridad.perfiles')}}">Perfiles y Permisos</a>
            </li>

          </ul>
        </div>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ route('perfil') }}">
            <i class="menu-icon mdi mdi-account"></i>
            <span class="menu-title">Perfil</span>
          </a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form2').submit();">
          <i class="menu-icon mdi mdi-logout"></i>
          <span class="menu-title">Cerrar Sesion</span>
        </a>
      </li>

    </ul>
  </nav>
