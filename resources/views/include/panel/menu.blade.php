<!-- Navigation -->
  <h6 class="navbar-heading text-muted">
    @if(Auth::user()->role == 'admin') 
      Gestionar Datos
    @else
      Menu
    @endif
  </h6>
<ul class="navbar-nav"> 
  @if(Auth::user()->role == 'admin') 
    <li class="nav-item">
      <a class="nav-link" href="/home">
        <i class="ni ni-tv-2 text-primary"></i> Dashboard
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/specialties') }}">
        <i class="ni ni-planet text-blue"></i> Especialidades
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/doctors') }}">
        <i class="ni ni-single-02 text-orange"></i> Médicos
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/patients">
        <i class="ni ni-satisfied text-yellow"></i> Pacientes
      </a>
    </li>
  @elseif(Auth::user()->role == 'doctor')
    <li class="nav-item">
      <a class="nav-link" href="/schedule">
        <i class="ni ni-time-alarm text-success"></i> Gestionar Horario
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('patients') }}">
        <i class="ni ni-single-02 text-blue"></i> Mis pacientes
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/specialties') }}">
        <i class="ni ni-calendar-grid-58 text-orange"></i> Mis citas
      </a>
    </li>
  @else {{-- patient --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/specialties') }}">
        <i class="ni ni-laptop text-blue"></i> Reservar cita
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/specialties') }}">
        <i class="ni ni-calendar-grid-58 text-orange"></i> Mis citas
      </a>
    </li>
  @endif
  <li class="nav-item">
    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('formLogout').submit()">
      <i class="ni ni-key-25 text-info"></i> Cerrar sesión
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
      @csrf
    </form>
  </li>
</ul>

@if(Auth::user()->role == 'admin') 
  <!-- Divider -->
  <hr class="my-3">
  <!-- Heading -->
  <h6 class="navbar-heading text-muted">Reportes</h6>
  <!-- Navigation -->
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
      <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
        <i class="ni ni-spaceship"></i> Frecuencia de citas
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
        <i class="ni ni-palette"></i> Médicos más activos
      </a>
    </li>
  </ul>
@endif