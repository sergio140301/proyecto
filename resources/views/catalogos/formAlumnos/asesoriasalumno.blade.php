@extends('inicio2')

@section('contenido2')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Asesoría</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col text-center">
                <h1 class="text-primary">Asesorías Alumno</h1>
            </div>
        </div>

        <div class="col-md-2">
            <label for="periodo">Periodo Actual:</label>
            <input type="text" class="form-control" id="periodo" value="{{ $periodos->periodo }}" readonly>
            <input type="hidden" class="form-control" name="idperiodo" value="{{ $periodos->id }}" readonly>
        </div>

        <br>
        <div class="row mb-4">
            <div class="col text-end">
            <a href="{{ route('generar-reporte-asesoria') }}" class="btn btn-primary">Descargar</a>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Materia</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Asesor</th>
                        <th scope="col">Lugar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asesorias as $asesoria)
                    <tr>
                        <td>{{ $asesoria->nombreMateria }}</td>
                        <td>{{ $asesoria->fecha }}</td>
                        <td>{{ $asesoria->horario }}</td>
                        <td>{{ $asesoria->nombres }} {{ $asesoria->apellidop }} {{ $asesoria->apellidom }}</td>
                        <td>{{ $asesoria->nombrelugar }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@endsection
