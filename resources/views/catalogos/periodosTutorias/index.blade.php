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

        <form action="{{ route('periodotutorias.index') }}" method="get">
            <div class="mb-3">
                <label for="idperiodo" class="form-label">Indica en qué periodo serán las tutorías</label>
                <select class="form-select" id="idperiodo" name="idperiodo" onchange="this.form.submit()">
                    <option value="-1" disabled selected>Seleccione periodo</option>

                    @foreach ($periodos as $periodo)
                    <option value="{{ $periodo->id }}" @if($periodo->id == session('periodo_id')) selected @endif>
                        {{ $periodo->periodo }}
                    </option>
                    @endforeach
                </select>
            </div>
        </form>

        <form action="{{ route('periodotutorias.store') }}" method="POST">

            @csrf
            <input type="hidden" name="eliminar" id="eliminar" value="NOELIMINAR">

            @php
            // Obtener el periodo seleccionado de la sesión
            $periodoSeleccionado = $periodos->firstWhere('id', session('periodo_id'));
            $anioSeleccionado = $periodoSeleccionado ? substr($periodoSeleccionado->periodo, -2) : date('y');
            $anioCompleto = '20' . $anioSeleccionado;

            // Fechas predeterminadas basadas en el periodo seleccionado
            $fechasPredeterminadas = [
            ['titulo' => '1er seguimiento', 'inicio' => "{$anioCompleto}-09-16", 'final' => "{$anioCompleto}-09-20"],
            ['titulo' => '2do seguimiento', 'inicio' => "{$anioCompleto}-10-14", 'final' => "{$anioCompleto}-10-18"],
            ['titulo' => '3er seguimiento', 'inicio' => "{$anioCompleto}-11-11", 'final' => "{$anioCompleto}-11-15"],
            ['titulo' => '4to seguimiento', 'inicio' => "{$anioCompleto}-12-02", 'final' => "{$anioCompleto}-12-13"],
            ];
            @endphp



            <br>
            <div class="row">
                <label for="" class="form-label">Indica cuántos seguimientos</label>

                @foreach ($fechasPredeterminadas as $index => $fechas)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-check">
                                <!-- Checkbox que enviará el título como valor si está seleccionado -->
                                <input onchange="enviar(this)" type="checkbox" name="checkbox_{{ $index }}" value="{{ $fechas['titulo'] }}" class="form-check-input" id="checkbox_{{ $index }}"
                                    @if($pt->firstWhere('fecha_ini', $fechas['inicio'])) checked @endif>
                                <label class="form-check-label" for="checkbox_{{ $index }}">{{ $fechas['titulo'] }}</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <input class="form-control" type="text" name="fecha_ini_{{ $index }}" id="fecha_ini_{{ $index }}" value="{{ old('fecha_ini_' . $index, $fechas['inicio']) }}" readonly>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" name="fecha_fin_{{ $index }}" id="fecha_fin_{{ $index }}" value="{{ old('fecha_fin_' . $index, $fechas['final']) }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <br>
        </form>
        <br><br><br>
        <a href="{{ route('tutorias') }}" class="btn btn-secondary">
            Asignacion de maestro para tutorias
        </a><br>

    </div>

    <script>
        function enviar(chbox) {
            if (!chbox.checked) {
                var index = chbox.id.split('_')[1];
                var fecha_ini = document.getElementById('fecha_ini_' + index).value;
                var fecha_fin = document.getElementById('fecha_fin_' + index).value;
                document.getElementById('eliminar').value = fecha_ini + '|' + fecha_fin;
            }
            chbox.form.submit();
        }
    </script>


</body>

</html>
@endsection