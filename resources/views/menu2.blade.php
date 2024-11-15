<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Horarios</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-dark" style="background-color: #ffffff;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('catalogos.otraVista')}}">TECNM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('catalogos.submenu')}}">Catálogos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('horarios.submenuhorarios')}}">Horarios</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('proyectoPersonales.submenuproyectos')}}">Proyectos Personales</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Instrumentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tutorías</a>
                    </li>
                </ul>
                
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
            </div>
        </div>
    </nav>

</body>

</html>
