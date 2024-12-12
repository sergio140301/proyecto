@extends('inicio2')

@section('contenido2')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Rendimiento del Alumno</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Título principal -->
        <div class="row mb-4">
            <div class="col text-center">
                <h1 class="text-primary">Rendimiento del Alumno</h1>
            </div>
        </div>

        <!-- Carrera -->
        <div class="row mb-4">
            <div class="col-md-12">
                <label for="carrera" class="form-label">Carrera</label>
                <input type="text" id="carrera" class="form-control" value="{{ $alumno->nombreCarrera }}" readonly>
            </div>
        </div>

        <!-- Información del Alumno -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="hidden" id="idalumno" class="form-control" value="{{ $alumno->id }}" readonly>

                <label for="numControl" class="form-label">Número de Control</label>
                <input type="text" id="numControl" class="form-control" value="{{ $alumno->noctrl }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="nombreAlumno" class="form-label">Alumno</label>
                <input type="text" id="nombreAlumno" class="form-control" value="{{ $alumno->nombre }} {{ $alumno->apellidop }} {{ $alumno->apellidom }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="semestre" class="form-label">Semestre</label>
                <input type="text" id="semestre" class="form-control" value="{{ $alumno->semestreAlumno }}" readonly>
            </div>
        </div>



        <!-- Tabla de Rendimiento -->
         @if($existenRendimientos > 0)
        <div class="row">
            <div class="col">
                <h3 class="text-secondary text-center mb-3">Rendimiento Académico</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th scope="col">Materia</th>
                                <th scope="col">Semestre</th>
                                <th scope="col">Temas Evaluados</th>
                                <th scope="col">Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rendimientos as $rendimiento)
                            <tr>
                                <td>{{ $rendimiento->nombreMateria }}</td>
                                <td>{{ $rendimiento->semestre }}</td>
                                <td>{{ $rendimiento->temasEv }}</td>
                                <td>{{ $rendimiento->resultado }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        @if($existenRendimientos<=0)
        <div class="alert alert-danger">
            No ha registrado el seguimiento
        </div>
        @endif
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@endsection
