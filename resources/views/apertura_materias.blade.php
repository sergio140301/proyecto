@extends('inicio2')

@section('apertura_materias')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apertura de Materias</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#periodo, #carrera').change(function() {
                if ($('#periodo').val() && $('#carrera').val()) {
                    $('.semestre-section').show();
                } else {
                    $('.semestre-section').hide();
                }
            });

            $('.checkbox-semestre').change(function() {
                var semestre = $(this).val();
                if ($(this).is(':checked')) {
                    $('#' + semestre).show();
                } else {
                    $('#' + semestre).hide();
                }
            });

            $('#guardar').click(function() {
                var selectedData = {};
                $('.checkbox-semestre:checked').each(function() {
                    var semestre = $(this).val();
                    selectedData[semestre] = [];
                    $('#' + semestre + ' select').each(function() {
                        selectedData[semestre].push($(this).val());
                    });
                });

                console.log(selectedData); // Muestra en la consola los datos seleccionados
                alert('Datos guardados (mira la consola para ver los detalles)');
            });
        });
    </script>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Apertura de Materias</h1>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="periodo" class="form-label">Periodo</label>
                    <select class="form-select" id="periodo">
                        <option value="">-- Seleccione --</option>
                        <option value="Enero-Junio 2024">Enero-Junio 2024</option>
                        <option value="Agosto-Diciembre 2024">Agosto-Diciembre 2024</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="carrera" class="form-label">Carrera</label>
                    <select class="form-select" id="carrera">
                        <option value="">-- Seleccione --</option>
                        <option value="ISC">ISC</option>
                        <option value="MEC">MEC</option>
                        <option value="IGE">IGE</option>
                        <option value="COT">COT</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3 semestre-section" style="display: none;">
            <h5>Seleccione los semestres:</h5>
            <div class="form-check">
                <input class="form-check-input checkbox-semestre" type="checkbox" value="S1" id="semestre1">
                <label class="form-check-label" for="semestre1">Semestre 1</label>
            </div>
            <div class="form-check">
                <input class="form-check-input checkbox-semestre" type="checkbox" value="S2" id="semestre2">
                <label class="form-check-label" for="semestre2">Semestre 2</label>
            </div>
            <!-- Agrega más semestres según sea necesario -->
        </div>

        <div class="row semestre-section" style="display: none;">
            <div class="col-md-8">
                <div id="S1" style="display: none;">
                    <h5>Materias del Semestre 1</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Materia 1</th>
                                <th>Materia 2</th>
                                <th>Materia 3</th>
                                <th>Materia 4</th>
                                <th>Materia 5</th>
                                <th>Materia 6</th>
                                <th>Materia 7</th>
                                <th>Materia 8</th>
                                <th>Materia 9</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-select">
                                        <option value="">-- Seleccione --</option>
                                        <option value="materia1">Materia 1</option>
                                        <option value="materia2">Materia 2</option>
                                        <option value="materia3">Materia 3</option>
                                    </select>
                                </td>
                                <td colspan="8"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="S2" style="display: none;">
                    <h5>Materias del Semestre 2</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Materia 1</th>
                                <th>Materia 2</th>
                                <th>Materia 3</th>
                                <th>Materia 4</th>
                                <th>Materia 5</th>
                                <th>Materia 6</th>
                                <th>Materia 7</th>
                                <th>Materia 8</th>
                                <th>Materia 9</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-select">
                                        <option value="">-- Seleccione --</option>
                                        <option value="materia1">Materia 1</option>
                                        <option value="materia2">Materia 2</option>
                                        <option value="materia3">Materia 3</option>
                                    </select>
                                </td>
                                <td colspan="8"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <button id="guardar" class="btn btn-primary">Guardar</button>
        <a href="{{ route('seleccion_grupos') }}">
            <button class="btn btn-success">Seleccionar Grupos</button>
        </a>
    </div>
</body>
@endsection
