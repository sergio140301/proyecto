<nav class="navbar navbar-expand-lg bg-body-dark" style="background-color: #000000;">
  <div class="container-fluid">
      <a class="navbar-brand text-white" href="{{ route('inicio2')}}">TECNM</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">


          </ul>
          <div class="d-flex ms-auto"> <!-- Cambiado aquí -->
              @guest
                  <a href="{{ route('register') }}" class="btn btn-outline-warning me-2">Registrarse</a>
                  <a href="{{ route('login') }}" class="btn btn-outline-success">Iniciar Sesión</a>
              @endguest
              @auth
                  <form action="{{ route('logout') }}" method="POST" class="d-inline">
                      @csrf
                      <button class="btn btn-outline-danger">Salir</button>
                  </form>
                  <div class="text-white ms-3">
                      <p class="mb-0">Usuario: {{ Auth::user()->name }}</p>
                      <p class="mb-0">Correo: {{ Auth::user()->email }}</p>
                  </div>
              @endauth
          </div>
      </div>
  </div>
</nav>
