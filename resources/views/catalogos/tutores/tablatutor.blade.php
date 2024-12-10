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
                <h1 class="text-primary">Reporte del Tutor</h1>
            </div>
        </div>

        <div class="row g-3 align-items-center mb-4">
            <div class="col-md-6">
                <form action="{{ route('tablatutor') }}" method="get">
                    <label for="idperiodo" class="form-label">Buscar Tutorados por Periodo</label>
                    <select name="idperiodo" id="idperiodo" onchange="this.form.submit()" class="form-select mb-2">
                        <option value="-1" disabled selected>Seleccione Periodo</option>
                        @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}" @if($periodo->id == session('periodo_id')) selected @endif>
                            {{ $periodo->periodo }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="col-md-6">
                <label for="tutor" class="form-label">Tutor Asignado</label>
                <input type="hidden" class="form-control" name="idpersonal" value="{{ $tutordealumnos->id }}" readonly>
                <input type="text" id="tutor" class="form-control" value="{{ $tutordealumnos->nombres }} {{ $tutordealumnos->apellidom }} {{ $tutordealumnos->apellidop }}" readonly>
            </div>
        </div>


        <!-- Botón Generar Reporte -->
        <div class="row mb-4">
            <div class="col text-end">
                <button class="btn btn-primary">Generar Reporte</button>
            </div>
        </div>

        <!-- Tabla de Alumnos Tutorados -->
        <div class="row">
            <div class="col">
                <h3 class="text-secondary text-center mb-3">Alumnos Tutorados</h3>
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
                            @foreach ($alumnostutorados as $tutorado)
                            <tr>
                                <td class="text-center">{{ $tutorado->noctrl }}</td>
                                <td>{{ $tutorado->nombre }} {{ $tutorado->apellidom }} {{ $tutorado->apellidop }}</td>
                                <td class="text-center">{{ $tutorado->semestreAlumno }}</td>
                                <td>{{ $tutorado->nombreCarrera }}</td>

                                <td class="text-center">
                                    <a href=""><img src="{{ asset('img/icono-ver.png') }}" width="30px" alt="Ver detalles"></a>
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