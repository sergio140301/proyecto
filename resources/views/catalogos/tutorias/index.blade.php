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
        <form method="POST" action="{{ route('tutorias.store') }}">
            @csrf

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
                    <p>Piedras Negras, Coahuila, 06/septiembre/2024</p>
                </div>

                <div class="mb-3">
                    <label for="departamento" class="form-label">Selecciona Departamento:</label>
                    <select id="departamento" name="depto_id" class="form-select">
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombreDepto }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo para seleccionar el docente -->
                <div class="mb-3">
                    <label for="personal" class="form-label">Selecciona Docente:</label>
                    <select id="personal" name="personal_id" class="form-select">
                        @foreach ($personals as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellidop }}
                                {{ $docente->apellidom }}</option>
                        @endforeach
                    </select>
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
                        <label for="carrera" class="form-label">Selecciona Carrera:</label>
                        <select id="carrera" name="carrera_id" class="form-select">
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}">{{ $carrera->nombreCarrera }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="alumno" class="form-label">Selecciona Alumno:</label>
                        <select id="alumno" class="form-select">
                            @foreach ($alumnos as $alumno)
                                <option value="{{ $alumno->id }}" data-noctrl="{{ $alumno->noctrl }}"
                                    data-semestre="Semestre {{ $alumno->carrera->reticulas->flatMap->materias->pluck('semestre')->first() }}">
                                    {{ $alumno->nombre }} {{ $alumno->apellidop }} {{ $alumno->apellidom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" id="agregarAlumno" class="btn btn-primary mb-3">Agregar Alumno</button>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
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

                <input type="hidden" id="alumnosInput" name="alumnos">
        </form>

         
        <a href="{{ route('rendimientos.index') }}">
            <h1>VER RENDIMIENTOS</h1>
        </a><br>

        <script>
            const alumnosSeleccionados = [];
            document.getElementById('agregarAlumno').addEventListener('click', function() {
                const alumnoSelect = document.getElementById('alumno');
                const alumnoNoCtrl = alumnoSelect.options[alumnoSelect.selectedIndex].dataset.noctrl;
                const alumnoText = alumnoSelect.options[alumnoSelect.selectedIndex].text;
                const alumnoSemestre = alumnoSelect.options[alumnoSelect.selectedIndex].dataset.semestre;

                const [nombre, apellidop, apellidom] = alumnoText.split(' ');

                // Añadir a la tabla
                const row = `<tr>
                <td>${alumnoNoCtrl}</td>
                <td>${nombre}</td>
                <td>${apellidop}</td>
                <td>${apellidom}</td>
                <td>${alumnoSemestre}</td>
            </tr>`;
                document.getElementById('alumnosSeleccionados').insertAdjacentHTML('beforeend', row);

                // Guardar en un array
                alumnosSeleccionados.push({
                    no_control: alumnoNoCtrl,
                    nombre,
                    apellidop,
                    apellidom,
                    semestre: alumnoSemestre
                });

                // Actualizar input oculto
                document.getElementById('alumnosInput').value = JSON.stringify(alumnosSeleccionados);
            });
        </script>
    </body>

    </html>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alumnosSeleccionados = [];
            document.getElementById('agregarAlumno').addEventListener('click', function() {
                const alumnoSelect = document.getElementById('alumno');
                const alumnoNoCtrl = alumnoSelect.options[alumnoSelect.selectedIndex].dataset.noctrl;
                const alumnoText = alumnoSelect.options[alumnoSelect.selectedIndex].text;
                const alumnoSemestre = alumnoSelect.options[alumnoSelect.selectedIndex].dataset.semestre;

                const [nombre, apellidop, apellidom] = alumnoText.split(' ');

                // Añadir a la tabla
                const row = `<tr>
                <td>${alumnoNoCtrl}</td>
                <td>${nombre}</td>
                <td>${apellidop}</td>
                <td>${apellidom}</td>
                <td>${alumnoSemestre}</td>
                </tr>`;
                document.getElementById('alumnosSeleccionados').insertAdjacentHTML('beforeend', row);

                // Guardar en un array
                alumnosSeleccionados.push({
                    no_control: alumnoNoCtrl,
                    nombre,
                    apellidop,
                    apellidom,
                    semestre: alumnoSemestre
                });

                // Actualizar input oculto
                document.getElementById('alumnosInput').value = JSON.stringify(alumnosSeleccionados);
            });
        });
    </script>
@endsection