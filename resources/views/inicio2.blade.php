<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/js/app.js'])

    <title>Proyecto Tutorias</title>

</head>

<body>

    <div class="container">
        {{-- navbars --}}
        <div class="row">
            <div class="col">
                @if (Auth::user()->rol == 'admin')
                    @include('navbar-admin')
                @elseif(Auth::user()->rol == 'coord')
                    @include('navbar-coord-tutores')
                @elseif(Auth::user()->rol == 'tutor')
                    @include('navbar-tutor')
                @elseif(Auth::user()->rol == 'alumno')
                    @include('navbar-alumno')
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col">
            <h1>Bienvenido, {{ Auth::user()->rol }} 🐻 </h1>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const welcomeTitle = document.querySelector('h1');
                if (welcomeTitle) {
                welcomeTitle.style.display = 'none';
                }
            }, 3000); // Adjust the time as needed
            });
        </script>

        <div class="container">
            <div class="row">
                <div class="col">
                    @yield('contenido4000')
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @yield('apertura_materias')
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @yield('seleccion_grupos')
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @yield('esquema_apertura_materias')
                </div>
            </div>


            <div class="row">
                <div class="col">
                    @yield('contenido2')
                </div>
                <div class="col-md-12">
                    @yield('bienvenida')
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @yield('contenido1')
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @include('piedepagina2')
                </div>
            </div>
        </div>
    </div>


</body>

</html>
