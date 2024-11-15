@extends('inicio2')

@section('seleccion_grupos')

<style>
   body {
    font-family: Arial, sans-serif;
}

.card {
    margin-bottom: 20px;
}

.card-header {
    background-color: #f0f0f0;
    padding: 10 px;
    border-bottom: 1px solid #ddd;
}

.card-body {
    padding: 20px;
}

.table-striped {
    border-collapse: collapse;
}

.table-striped th, .table-striped td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.table-striped th {
    background-color: #f0f0f0;
}
</style>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Grupos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzIA5k8PRxUg9+Ogz6AFJvKKKig1700/x4oquvM+b6Y7Yq/56+H9r" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Gestión de Grupos de Estudio</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Información del Grupo</h4>
                    </div>
                    <div class="card-body">
                        <form id="form-grupo">
                            <div class="mb-3">
                                <label for="semestre" class="form-label">Semestre:</label>
                                <select class="form-select" id="semestre">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                            <div class="mb-3">
 <label for="materia" class="form-label">Materia:</label>
                                <select class="form-select" id="materia">
                                    <!-- Combo box para seleccionar materia -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="profesor" class="form-label">Profesor:</label>
                                <select class="form-select" id="profesor">
                                    <!-- Combo box para seleccionar profesor -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fecha-creacion" class="form-label">Fecha de Creación:</label>
                                <input type="date" class="form-control" id="fecha-creacion">
                            </div>
                            <div class="mb-3">
                                <label for="maestro" class="form-label">Maestro:</label>
                                <input type="text" class="form-control" id="maestro" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="grupo" class="form-label">Grupo:</label>
                                <input type="text" class="form-control" id="grupo">
                            </div>
                            <div class="mb-3">
                                <label for="max-alumnos" class="form-label">Máximo de Alumnos:</label>
                                <input type="number" class="form-control" id="max-alumnos" value="20" readonly>
                                <small class="text-muted">Solo se admiten 20 alumnos por grupo</small>
                            </div>
                            <div class="mb-3">
                                <label for="periodo" class="form-label">Periodo:</label>
                                <select class="form-select" id="periodo">
                                    <option value="Enero-Junio 2024">Enero-Junio 2024</option>
                                    <option value="Agosto-Diciembre 2024">Agosto-Diciembre 2024</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="carrera" class="form-label">Carrera:</label>
                                <select class="form-select" id="carrera">
                                    <option value="ISC">ISC</option>
                                    <option value="MEC">MEC</option>
                                    <option value="IGE">IGE</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Iniciar Grupo</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Horarios</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Día</th>
                                    <th>Lugar</th>
                                </tr>
                            </thead>
                            <tbody id="horarios">
                                <!-- Tabla para mostrar horarios -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Lugares</h4>
                    </div>
                    <div class="card-body">
                        <select class="form-select" id="lugar">
                            <option value="Sala E">Sala E</option>
                            <option value="Sala Valerdi">Sala Valerdi</option>
                            <option value="Sala R">Sala R</option>
                        </select>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="guardar-lugar">
                            <label class="form-check-label" for="guardar-lugar">Guardar lugar</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4ClPip1i60dTi5bKxtWls5ykbK05qh6npQNyyReHRB98z5oXdad7XzZMfV" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>




@endsection