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
        <!-- Título principal -->
        <div class="row mb-4">
            <div class="col text-center">
                <h1 class="text-primary">Asignar Asesoría</h1>
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

        <!-- Asignación de Asesoría en una tabla -->
        <div class="table-responsive mb-4">
            @if($isAsesoriaRegistrada<=0)
                <form action="{{ route('asesorias.store') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" hidden>#</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Semestre</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Horario</th>
                            <th scope="col">Asesor</th>
                            <th scope="col">Lugar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td hidden>
                                <input type="hidden" name="idrendimiento" class="form-control" value="{{ $materiasAsesoria->id }}" readonly>
                            </td>

                            <td> {{ $materiasAsesoria->nombreMateria }} </td>
                            <td class="text-center"> {{ $materiasAsesoria->semestre }} </td>

                            <td>
                                <input type="date" id="fecha" name="fecha" class="form-control">
                            </td>
                            <td>
                                <input type="time" id="horario" name="horario" class="form-control">
                            </td>
                            <td>
                                <select name="idpersonal" id="idpersonal" class="form-select mb-2">
                                    <option value="-1" disabled selected>Seleccione Asesor</option>
                                    @foreach ($personals as $personal)
                                    <option value="{{ $personal->id }}">
                                        {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="idlugar" id="idlugar" class="form-select mb-2">
                                    <option value="-1" disabled selected>Seleccione Lugar</option>
                                    @foreach ($lugars as $lugar)
                                    <option value="{{ $lugar->id }}">
                                        {{ $lugar->nombrelugar }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Botón de Asignación -->
                <div class="col text-end">
                    <button type="submit" class="btn btn-success">Asignar Asesoría</button>
                </div>
                </form>
                @endif


                @if($isAsesoriaRegistrada>0)
                <div class="alert alert-success">
                    Ya fue asignada una Asesoría para esta Materia
                </div>

                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" hidden>#</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Horario</th>
                            <th scope="col">Asesor</th>
                            <th scope="col">Lugar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td hidden>{{ $asesoriaReg->id }}</td>
                            <td>{{ $asesoriaReg->nombreMateria }}</td>
                            <td>{{ $asesoriaReg->fecha }}</td>
                            <td>{{ $asesoriaReg->horario }}</td>
                            <td>{{ $asesoriaReg->nombres }} {{ $asesoriaReg->apellidop }} {{ $asesoriaReg->apellidom }}</td>
                            <td>{{ $asesoriaReg->nombrelugar }}</td>
                        </tr>
                    </tbody>
                </table>
                @endif
        </div>


    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@endsection
