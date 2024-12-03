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

    <!-- Oficio Section -->
    <div class="border rounded p-4 shadow-sm bg-white mb-4">
        <div class="header">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/logo-tec.png') }}" width="100px">
                <div class="ms-3">
                    <h1 class="text-danger fw-bold mb-1">EDUCACIÓN</h1>
                    <p class="mb-0 text-muted">Secretaría de Educación Pública</p>
                </div>
            </div>
            <div class="text-center">
                <h2 class="h5 fw-bold">Instituto Tecnológico de Piedras Negras</h2>
            </div>
        </div>

        <div class="text-end text-muted">
            <p>CLAVE: 05DIT0020V</p>
            <p>OFICIO: TUT/004/2024</p>
            <p>ASUNTO: COMISIÓN DE TUTOR</p>
            <p>Piedras Negras, Coahuila,</p>
            <p id="fechaActual"></p>
        </div>

        <div class="row">
            <div class="col">
                <form action="{{ route('tutorias.index') }}" method="GET">
                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento del Tutor:</label>
                        <select id="departamento" name="iddepto" class="form-select" onchange="this.form.submit()">
                            <option value="-1" disabled selected>Seleccione departamento</option>
                            @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}" @if($departamento->id == session('depto_id')) selected @endif>
                                {{ $departamento->nombreDepto }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="col">
                <form action="{{ route('tutorias.index') }}" method="GET">
                    <div class="mb-3">
                        <label for="carrera" class="form-label">Carrera de los Alumnos:</label>
                        <select id="carrera" name="idcarrera" class="form-select" onchange="this.form.submit()">
                        <option value="-1" disabled selected>Seleccione carrera</option>
                            @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}" @if($carrera->id == session('carrera_id')) selected @endif>{{ $carrera->nombreCarrera }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <form method="POST" action="{{ route('tutorias.store') }}">
            @csrf
            <!-- Campo para seleccionar el docente -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="personal" class="form-label">Tutor:</label>
                        <select id="personal" name="personal_id" class="form-select">
                            <option value="-1" disabled selected>Seleccione tutor</option>
                            @foreach ($personals as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombres }} {{ $docente->apellidop }} {{ $docente->apellidom }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Lista de Estudiantes Section -->
            <div class="border rounded p-4 shadow-sm bg-white">
                <h2 class="section-title">Lista de Estudiantes para Tutorías</h2>

                <div class="mb-3">
                    <label for="periodo" class="form-label">Selecciona Periodo:</label>
                    <select id="periodo" name="periodo_id" class="form-select">
                        @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alumno" class="form-label">Agregar Alumnos a Tutorías:</label>
                    <select id="alumno" class="form-select" onchange="agregarAlumno(this)">
                        <option value="-1" disabled selected>-Seleccione alumno-</option>
                        @foreach ($alumnos as $alumno)
                        <option value="{{ $alumno->id }}"
                            data-noctrl="{{ $alumno->noctrl }}" data-nombre="{{ $alumno->nombre }}"
                            data-apellidop="{{ $alumno->apellidop }}" data-apellidom="{{ $alumno->apellidom }}"
                            data-semestre="{{ $alumno->semestre }}">
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
                            <th>Semestre</th>
                        </tr>
                    </thead>
                    <tbody id="alumnosSeleccionados">
                        <!-- Filas dinámicas -->
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-success mt-3">Guardar Tutorados</button>
        </form>

        <!-- script para obtener fecha actual -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const fechaActual = document.getElementById("fechaActual");
                const fecha = new Date();

                // Lista de meses en español
                const meses = [
                    "enero", "febrero", "marzo", "abril", "mayo", "junio",
                    "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
                ];

                // Formatear la fecha
                const dia = fecha.getDate();
                const mes = meses[fecha.getMonth()];
                const año = fecha.getFullYear();

                // Establecer el texto
                fechaActual.textContent = `${dia}/${mes}/${año}`;
            });
        </script>

        <!-- script para agg alumnos a tabla -->
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
                const semestre = alumnoOption.getAttribute('data-semestre');

                // Crear una nueva fila en la tabla
                const nuevaFila = document.createElement('tr');
                nuevaFila.dataset.id = alumnoId; // Asignar el ID como atributo

                nuevaFila.innerHTML = 
                `
                <td>${noctrl}</td>
                <td>${nombre}</td>
                <td>${apellidop}</td>
                <td>${apellidom}</td>
                <td>${semestre}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm eliminarAlumno">Eliminar</button>
                    <input type="hidden" name="alumnos[${alumnoId}][id]" value="${alumnoId}">
                    <input type="hidden" name="alumnos[${alumnoId}][semestre]" value="${semestre}">
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
<br><br><br>
<a href="{{ route('formalumnos') }}" class="btn btn-secondary">
    Asignacion de maestro para tutorias
</a><br>

</html>
@endsection