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

        <!-- Información del Alumno -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="numControl" class="form-label">Número de Control</label>
                <input type="text" id="numControl" class="form-control" placeholder="Ejemplo: 194530" disabled>
            </div>
            <div class="col-md-4">
                <label for="nombreAlumno" class="form-label">Alumno</label>
                <input type="text" id="nombreAlumno" class="form-control" placeholder="Nombre del Alumno" disabled>
            </div>
            <div class="col-md-4">
                <label for="semestre" class="form-label">Semestre</label>
                <input type="text" id="semestre" class="form-control" placeholder="Ejemplo: 4º" disabled>
            </div>
        </div>

        <!-- Carrera -->
        <div class="row mb-4">
            <div class="col-md-12">
                <label for="carrera" class="form-label">Carrera</label>
                <input type="text" id="carrera" class="form-control" placeholder="Ejemplo: Ingeniería en Sistemas" disabled>
            </div>
        </div>

        <!-- Asignación de Asesoría en una tabla -->
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
                    <tr>
                        <td><input type="text" id="materia" class="form-control" value="Matemáticas Discretas" disabled></td>
                        <td><input type="date" id="fecha" class="form-control"></td>
                        <td><input type="time" id="horario" class="form-control"></td>
                        <td>
                            <select id="asesor" class="form-select">
                                <option value="asesor1">Asesor 1</option>
                                <option value="asesor2">Asesor 2</option>
                                <option value="asesor3">Asesor 3</option>
                            </select>
                        </td>
                        <td>
                            <select id="lugar" class="form-select">
                                <option value="sala1">Sala 1</option>
                                <option value="sala2">Sala 2</option>
                                <option value="sala3">Sala 3</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Botón de Asignación -->
        <div class="row mb-4">
            <div class="col text-end">
                <button class="btn btn-success">Asignar Asesoría</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection
