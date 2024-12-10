@extends('inicio2')

@section('contenido2')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vista Alumno</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5">
            <!-- Título principal -->
            <div class="row mb-4">
                <div class="col text-center">
                    <h1 class="text-primary">Reporte del Alumno</h1>
                </div>

            </div>
            <label for="periodo">Periodo Actual:</label>
            <input type="text" class="form-control" id="periodo" value="{{ $periodos->periodo }}" readonly>
            <input type="hidden" class="form-control" name="periodo_id" value="{{ $periodos->id}}" readonly>

      

            <!-- Botón para descargar -->
            <div class="row mb-4">
                <div class="col text-end">
                    <a href="#" class="btn btn-success btn-sm">Descargar</a>
                </div>
            </div>

            <!-- Tabla de Asesorías -->
            <div class="row">
                <div class="col">
                    <h3 class="text-secondary text-center mb-3">Asesorías Programadas</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th scope="col">Materia</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Horario</th>
                                    <th scope="col">Lugar</th>
                                    <th scope="col">Asesor Asignado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asesorias as $asesoria)
                                    <tr>
                                        <td>{{ $asesoria->nombreMateria }}</td>
                                        <td>{{ $asesoria->fecha }}</td>
                                        <td>{{ $asesoria->horario }}</td>
                                        <td>{{ $asesoria->nombrelugar }}</td>
                                        <td>{{ $asesoria->nombres }} {{ $asesoria->apellidop }} {{ $asesoria->apellidom }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection
