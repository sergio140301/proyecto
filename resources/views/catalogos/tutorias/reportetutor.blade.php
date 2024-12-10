
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
                <h1 class="text-primary">Reporte de Tutorías</h1>
            </div>
        </div>

        <!-- Filtros: Período y Tutor -->
        <div class="row g-3 align-items-center mb-4">
            <div class="col-md-6">
                <label for="periodo" class="form-label">Período</label>
                <input type="text" id="periodo" class="form-control" placeholder="Ejemplo: 2023-1">
            </div>
            <div class="col-md-6">
                <label for="tutor" class="form-label">Tutor</label>
                <input type="text" id="tutor" class="form-control" placeholder="Nombre del Tutor">
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
                                <th scope="col">NCH</th>
                                <th scope="col">Alumno</th>
                                <th scope="col">Semestre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">123456</td>
                                <td>Juan Pérez</td>
                                <td class="text-center">4º</td>
                            </tr>
                            <tr>
                                <td class="text-center">789101</td>
                                <td>María López</td>
                                <td class="text-center">6º</td>
                            </tr>
                            <tr>
                                <td class="text-center">112131</td>
                                <td>Carlos García</td>
                                <td class="text-center">8º</td>
                            </tr>
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