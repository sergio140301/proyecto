<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/js/app.js'])

    <title>Proyecto Tutorias</title>

    <style>
        body {
            background-color: #040075;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero-section {
            background-size: cover;
            background-position: center;
            padding: 50px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            flex: 1;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1rem;
            max-width: 600px;
            margin: auto;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>

        @include('menu')

        <section class="hero-section" style="background-color: #160142;">
            <div class="text-center">
                <h1 class="hero-title">PROYECTO</h1>

                <h2 class="hero-subtitle">TUTORIAS <br> INICIA SESION O REGISTRATE</h2>
            </div>
        </section>
        <div class="container my-4">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{ asset('img/logo-tec.png') }}" width="50px">
                    <h5 class="card-title">Información Importante</h5>
                    <p class="card-text">
                        Debes iniciar sesión para poder acceder al sistema
                        con el usuario asignado...
                    </p>
                    <p class="card-text">
                        Bienvenido al sistema de tutorias del Instituto Tecnológico de Piedras Negras.
                    </p>
                </div>
            </div>
        </div>


    @yield('contenido1')

    @include('piedepagina')

    <footer>
        <p>© 2024 Sergio Abraham Valdes Escamilla. Todos los derechos reservados.</p>
    </footer>

</body>

</html>
