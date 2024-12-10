<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="#">Panel de Admin</a>

        <!-- Botón de menú para dispositivos pequeños -->
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

   
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalogos.submenu') }}">Catálogos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('materiasabiertas') }}">Apertura de Materias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('periodotutorias') }}">Abrir Tutorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Horario Alumno</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
