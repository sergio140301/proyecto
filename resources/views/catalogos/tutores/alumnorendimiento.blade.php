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

        <!-- Tabla de Rendimiento -->
        <div class="row">
            <div class="col">
                <h3 class="text-secondary text-center mb-3">Rendimiento Académico</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th scope="col">Materia</th>
                                <th scope="col">Sem</th>
                                <th scope="col">Tareas Entregadas</th>
                                <th scope="col">Exámenes</th>
                                <th scope="col">Asistencias</th>
                                <th scope="col">Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Matemáticas Discretas</td>
                                <td class="text-center">4º</td>
                                <td class="text-center">90%</td>
                                <td class="text-center">85%</td>
                                <td class="text-center">95%</td>
                                <td class="text-center">90%</td>
                            </tr>
                            <tr>
                                <td>Programación Avanzada</td>
                                <td class="text-center">4º</td>
                                <td class="text-center">80%</td>
                                <td class="text-center">78%</td>
                                <td class="text-center">88%</td>
                                <td class="text-center">82%</td>
                            </tr>
                            <tr>
                                <td>Base de Datos</td>
                                <td class="text-center">4º</td>
                                <td class="text-center">85%</td>
                                <td class="text-center">90%</td>
                                <td class="text-center">92%</td>
                                <td class="text-center">89%</td>
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
