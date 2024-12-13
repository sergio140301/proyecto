<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="">Panel del Coordinador de Tutorias</a>


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

        <!-- Enlaces del Navbar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tutorias')}}">Tutorías</a>
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
