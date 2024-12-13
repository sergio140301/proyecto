@extends('inicio2')

@section('contenido2')
<html>

<head>
    <title>Oficio y Lista de Estudiantes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .header img {
            height: 70px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>

<body class="container bg-light py-5">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <div class="container">
        <div class="row mt-4 mb-3">
            <div class="col-md-4">
                <form action="{{ route('horarioalumnos') }}" method="GET">
                    <div class="mb-3 mt-2">
                        <label for="periodo">Periodo Actual:</label>
                        <input type="text" class="form-control" id="periodo" value="{{ $periodos->periodo }}" readonly>
                        <input type="hidden" class="form-control" name="idperiodo" value="{{ $periodos->id }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="semestre">Semestre</label>
                        <select id="semestre" name="semestre" class="form-select" onchange="this.form.submit()">
                            <option value="-1" disabled {{ session('sem') == '-1' ? 'selected' : '' }}>Seleccione semestre</option>
                            @for ($i = 1; $i <= 9; $i++)
                                <option value="{{ $i }}" {{ session('sem') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="grupo">Grupos</label>
                        <select id="grupo" name="idgrupo" class="form-select" onchange="updateInfoGrupo()">
                            <option value="-1" disabled selected>Seleccione grupo</option>
                            @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}" @if($grupo->id == session('grupo_id')) selected @endif>
                                {{ $grupo->grupo }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        INFO GRUPO
                    </div>
                    @if($existegrupos > 0)
                    <div class="card-body">
                        <label for="carrera">Carrera:</label>
                        <input type="text" class="form-control" id="carrera" value="{{ $infoGrupo->nombreCarrera ?? '' }}" readonly>

                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="materia">Materia:</label>
                                <input type="text" class="form-control" id="materia" value="{{ $infoGrupo->nombreMateria ?? '' }}" readonly>
                            </div>
                            <div class="col">
                                <label for="maxAlumnos">Máx. Alumnos:</label>
                                <input type="text" class="form-control" id="maxAlumnos" value="{{ $infoGrupo->maxAlumnos ?? '' }}" readonly>
                            </div>
                        </div>

                        <label for="docente">Docente:</label>
                        <input type="text" class="form-control" id="docente" value="{{ $infoGrupo->docente ?? '' }}" readonly>
                    </div>
                    @endif
                    @if($existegrupos <= 0)
                        <div class="card-body">
                        <label for="carrera">Carrera:</label>
                        <input type="text" class="form-control" id="carrera" value="" readonly>

                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <label for="materia">Materia:</label>
                                <input type="text" class="form-control" id="materia" value="" readonly>
                            </div>
                            <div class="col">
                                <label for="maxAlumnos">Máx. Alumnos:</label>
                                <input type="text" class="form-control" id="maxAlumnos" value="" readonly>
                            </div>
                        </div>

                        <label for="docente">Docente:</label>
                        <input type="text" class="form-control" id="docente" value="" readonly>
                </div>
                @endif
            </div>
        </div>

        @if($existegrupos > 0)
        <div class="mt-2">
            <div class="card">
                <div class="card-header bg-success text-white">
                    HORARIO GRUPO
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                @foreach(['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'] as $dia)
                                <th>{{ $dia }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach(['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'] as $dia)
                                <td>
                                    @if (!empty($tablaHorarios[$dia]))
                                    {{ implode(', ', $tablaHorarios[$dia]) }}
                                    @else
                                    Sin horarios
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($existeHorario <= 0)
            <form method="POST" action="{{ route('horarioalumnos.store') }}">
            @csrf
            <div class="border rounded p-4 shadow-sm bg-white">
                <h2 class="section-title">Lista de Estudiantes para Horario</h2>

                <div class="mb-3">
                    <label for="alumno" class="form-label">Agregar Alumnos a Grupo:</label>
                    <select id="alumno" class="form-select" onchange="agregarAlumno(this)">
                        <option value="-1" disabled selected>Seleccione alumno</option>
                        @foreach ($alumnos as $alumno)
                        <option value="{{ $alumno->id }}"
                            data-noctrl="{{ $alumno->noctrl }}" data-nombre="{{ $alumno->nombre }}"
                            data-apellidop="{{ $alumno->apellidop }}" data-apellidom="{{ $alumno->apellidom }}">
                            {{ $alumno->nombre }} {{ $alumno->apellidop }} {{ $alumno->apellidom }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th hidden>ID</th>
                            <th>No. Control</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                        </tr>
                    </thead>
                    <tbody id="alumnosSeleccionados">
                        <!-- Filas dinámicas -->
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-success mt-3">Guardar Horario</button>
            </form>
            @endif

            @if($existeHorario > 0)
            <div class="border rounded p-4 shadow-sm bg-white">
                <h2 class="section-title">Alumnos Inscritos al Grupo</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No. Control</th>
                            <th>Alumno</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnosHorario as $alumno)
                        <tr>
                            <td>{{ $alumno->noctrl }}</td>
                            <td>{{ $alumno->nomalumno }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @endif

    </div>
    </div>


    <script>
        function updateInfoGrupo() {
            var select = document.getElementById('grupo');
            var selectedOption = select.options[select.selectedIndex];

            select.form.submit();

            document.getElementById('carrera').value = selectedOption.getAttribute('data-carrera');
            document.getElementById('materia').value = selectedOption.getAttribute('data-materia');
            document.getElementById('maxAlumnos').value = selectedOption.getAttribute('data-max');
            document.getElementById('docente').value = selectedOption.getAttribute('data-docente');
        }
    </script>

    <script>
        function agregarAlumno(select) {
            const alumnoId = select.value;
            const alumnoOption = select.options[select.selectedIndex];

            // Validar selección de un alumno válido
            if (alumnoId === '-1') {
                return; // No hacer nada si no se selecciona un alumno válido
            }

            // Verifica si el alumno ya está en la tabla
            const tabla = document.getElementById('alumnosSeleccionados');
            if ([...tabla.querySelectorAll('tr')].some(row => row.dataset.id === alumnoId)) {
                alert("Este alumno ya fue agregado.");
                return;
            }

            // Extraer los datos del alumno
            const noctrl = alumnoOption.getAttribute('data-noctrl');
            const nombre = alumnoOption.getAttribute('data-nombre');
            const apellidop = alumnoOption.getAttribute('data-apellidop');
            const apellidom = alumnoOption.getAttribute('data-apellidom');

            // Crear una nueva fila en la tabla
            const nuevaFila = document.createElement('tr');
            nuevaFila.dataset.id = alumnoId; // Asignar el ID como atributo

            nuevaFila.innerHTML =
                `
                <td>${noctrl}</td>
                <td>${nombre}</td>
                <td>${apellidop}</td>
                <td>${apellidom}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm eliminarAlumno">Eliminar</button>
                    <input type="hidden" name="alumnos[${alumnoId}][id]" value="${alumnoId}">
                </td>`;

            // Agregar la fila a la tabla
            tabla.appendChild(nuevaFila);

            // Limpiar selección
            select.value = '-1';

            // Agregar funcionalidad al botón de eliminar
            nuevaFila.querySelector('.eliminarAlumno').addEventListener('click', function() {
                nuevaFila.remove();
            });
        }
    </script>
</body>

</html>
@endsection
