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

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

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
                <form action="{{ route('asesorias.asesoriastutor') }}" method="get">
                    <label for="idperiodo" class="form-label">Buscar Tutorados que requieren Asesorías por Periodo</label>
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
        </div>

        <!-- Tabla de Alumnos Requiriendo Asesoría -->
        <div class="row">
            <div class="col">
                <h3 class="text-secondary text-center mb-3">Alumnos Requiriendo Asesoría</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th scope="col" hidden># Rendimiento</th>
                                <th scope="col">N° Control</th>
                                <th scope="col">Alumno</th>
                                <th scope="col">Semestre</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Materia que requiere Asesoría</th>
                                <th scope="col">Asignar Asesoría</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asesorias as $asesoria)
                            <tr>
                                <td class="text-center" hidden>{{ $asesoria->id }}</td>
                                <td class="text-center">{{ $asesoria->noctrl }}</td>
                                <td>{{ $asesoria->nombre }} {{ $asesoria->apellidop }} {{ $asesoria->apellidom }}</td>
                                <td class="text-center">{{ $asesoria->semestreAlumno }}</td>
                                <td>{{ $asesoria->nombreCarrera }}</td>
                                <td>{{ $asesoria->nombreMateria }}</td>
                                <td class="text-center">
                                    <a href="{{ route('asesorias.asignarAs', ['id' => $asesoria->id, 'noctrl' => $asesoria->noctrl]) }}">
                                        <img src="{{ asset('img/add.png') }}" width="30px" alt="Asignar">
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
