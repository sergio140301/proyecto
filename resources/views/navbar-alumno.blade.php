<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo o título del panel -->
        <a class="navbar-brand" href="#">Panel del Alumno</a>

        <!-- Botón colapsable para pantallas pequeñas -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enlaces del navbar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Enlace para Tutorías -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('formalumnos.index')}}">Llenar seguimiento de tutorias</a>
                </li>
                <!-- Enlace para Asesorías -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('formalumnos.asesoriasalumno')}}">Asesorías</a>
                </li>
                <div class="d-flex ms-2">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-warning me-2">Registrarse</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-success">Iniciar Sesión</a>
                    @endguest
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-danger">Salir</button>
                        </form>

                    @endauth

                </div>
            </ul>
        </div>
    </div>
</nav>
