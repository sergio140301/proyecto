@extends('inicio2')

@section('contenido2')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Tutor</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Título principal -->
        <div class="row mb-4">
            <div class="col text-center">
                <h1 class="text-primary">Reporte Asesorías</h1>
            </div>
        </div>

        <!-- Filtro: Período -->
        <div class="row g-3 align-items-center mb-4">
            <div class="col-md-12">
                <label for="periodo" class="form-label">Período</label>
                <select id="periodo" class="form-control">
                    @foreach($periodostutores as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Botón Generar Reporte -->
        <div class="row mb-4">
            <div class="col text-end">
                <button class="btn btn-primary">Generar Reporte</button>
            </div>
        </div>

        <!-- Tabla de Alumnos Requiriendo Asesoría -->
        <div class="row">
            <div class="col">
                <h3 class="text-secondary text-center mb-3">Alumnos Requiriendo Asesoría</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th scope="col">N° Control</th>
                                <th scope="col">Alumno</th>
                                <th scope="col">Semestre</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asesorias as $asesoria)
                                <tr>
                                    <td class="text-center">{{ $asesoria->noctrl }}</td>
                                    <td>{{ $asesoria->nombre }} {{ $asesoria->apellidop }} {{ $asesoria->apellidom }}</td>
                                    <td class="text-center">{{ $asesoria->semestreAlumno }}</td>
                                    <td>{{ $asesoria->nombreCarrera }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('asesoriasalumnos') }}">
                                            <img src="{{ asset('img/icono-ver.png') }}" width="30px" alt="Ver detalles">
                                        </a>
                                    </td>
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
