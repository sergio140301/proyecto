@extends('inicio2')

@section('contenido2')
<html>

<head>
    <title>Asignación de Tutorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            background-color: white;
            border: 1px solid #ced4da;
            padding: 20px;
            border-radius: 5px;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            margin-top: 10px;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .btn {
            display: block;
            width: 100%;
            font-size: 18px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <h1>¡Bienvenido a Asignación de Tutorías!</h1>

        @if ($existenSeguimientos <= 0)
            <form method="POST" action="{{ route('periodotutorias.store') }}">
            @csrf

            <div class="row">
                <div class="col">
                    <label for="seguimientos" class="form-label">Seguimientos:</label>
                    <select class="form-select" id="seguimientos" onchange="generarCards()">
                        <option value="-1" disabled selected>Cant. de seguimientos a abrir</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div class="col">
                    <label for="periodo">Periodo Actual:</label>
                    <input type="text" class="form-control" id="periodo" value="{{ $periodos->periodo }}" readonly>
                    <input type="hidden" class="form-control" name="idperiodo" value="{{ $periodos->id }}" readonly>
                    <input type="hidden" id="cantidad_seguimientos" name="cantidad_seguimientos" value="0"> <!-- Campo oculto para la cantidad -->
                </div>
            </div>

            <div id="cards-container" class="row">
                <!-- Aquí se generarán las tarjetas si no hay seguimientos abiertos -->
            </div>
            <button type="submit" class="btn btn-success mt-3">Abrir Seguimientos</button>
            </form>
            @endif

            <div class="row">
                @if ($existenSeguimientos > 0)
                <div id="cards-container" class="row g-3">
                    <label for="periodo">Periodo Actual:</label>
                    <input type="text" class="form-control" id="periodo" value="{{ $periodos->periodo }}" readonly>
                    <input type="hidden" class="form-control" name="idperiodo" value="{{ $periodos->id }}" readonly>



                    @foreach ($seguimientosAbiertos as $index => $seguimiento)
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <label>Seguimiento {{ $index + 1 }}</label>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" type="date" value="{{ $seguimiento->fecha_ini }}" readonly>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="date" value="{{ $seguimiento->fecha_fin }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @endif
            </div>



            <br><br><br>
            <a href="{{ route('tutorias') }}" class="btn btn-secondary">
                Asignación de maestro para tutorías
            </a><br>
    </div>

    <script>
        function generarCards() {
            const select = document.getElementById('seguimientos');
            const container = document.getElementById('cards-container');
            const cantidad = parseInt(select.value);
            const cantidadField = document.getElementById('cantidad_seguimientos'); // Campo oculto

            // Limpiar el contenedor
            container.innerHTML = '';
            cantidadField.value = cantidad; // Actualizar el campo oculto

            // Crear fila inicial
            let row = document.createElement('div');
            row.className = 'row g-3'; // g-3 para espaciado entre columnas

            // Generar tarjetas
            for (let i = 1; i <= cantidad; i++) {
                const col = document.createElement('div');
                col.className = 'col-md-6 col-lg-4'; // Ajustar el tamaño de columna según el diseño
                col.innerHTML =
                    `<div class="card">
                        <div class="card-header">
                            <label>Seguimiento ${i}</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <input class="form-control" type="date" name="fecha_ini_${i}" value="">
                                </div>
                                <div class="col">
                                    <input class="form-control" type="date" name="fecha_fin_${i}" value="">
                                </div>
                            </div>
                        </div>
                    </div>`;
                row.appendChild(col);

                // Crear una nueva fila si se llena
                if (i % 3 === 0 || i === cantidad) {
                    container.appendChild(row); // Agregar la fila al contenedor
                    row = document.createElement('div'); // Crear una nueva fila
                    row.className = 'row g-3';
                }
            }
        }
    </script>

</body>

</html>
@endsection