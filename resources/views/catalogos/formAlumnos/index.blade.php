@extends('inicio2')

@section('contenido2')
<html>

<head>
    <title>Formulario Para Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .pre-cargado,
        .disponibilizado {
            margin-top: 20px;
        }

        .pre-cargado span,
        .disponibilizado span {
            font-weight: bold;
        }

        .coordinadora {
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }

        .radio-input {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .radio-input input {
            appearance: none;
            width: 2em;
            height: 2em;
            background-color: #171717;
            box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
            border-radius: 5px;
            transition: 0.4s ease-in-out;
        }

        .radio-input input:hover {
            scale: 1.2;
            cursor: pointer;
            box-shadow: none;
        }

        .radio-input .plus1 {
            position: relative;
            top: 0.01em;
            left: -2.20em;
            width: 1.3em;
            height: 0.2em;
            background-color: red;
            rotate: 45deg;
            scale: 0;
            border-radius: 5px;
            transition: 0.4s ease-in-out;
        }

        .radio-input .plus2 {
            position: relative;
            width: 1.3em;
            height: 0.2em;
            background-color: red;
            transform: rotate(90deg);
            border-radius: 5px;
            transition: 0.4s ease-in-out;
        }

        .radio-input input:checked {
            box-shadow: none;
        }

        .radio-input input:checked+.plus1 {
            transform: rotate(180deg);
            scale: 1;
        }
    </style>
</head>

<body>

    @if (isset($error))
    <div class="alert alert-danger mt-2">
        {{ $error }}
    </div>
    @else


    <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="form-title">Gestión Seguimiento Alumno</div>

        @if($existeRegistroSeguimiento<=0)
            <form method="POST" action="{{ route('formalumnos.store') }}">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>Información del Alumno</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" class="form-control" id="idAlumno" name="alumno_id" value="{{ $alumno->id }}" readonly>

                                <div class="col-sm-3">
                                    <label for="noControl">No Control:</label>
                                    <input type="text" class="form-control" id="noControl" name="noCtrl" value="{{ $alumno->noctrl }}" readonly>
                                    <br>
                                    <label for="semestre">Semestre:</label>
                                    <input type="text" class="form-control" id="semestre" value="{{ $alumno->semestre }}" readonly>
                                </div>
                                <div class="col">
                                    <label for="nombreAlumno">Alumno:</label>
                                    <input type="text" class="form-control" id="nombreAlumno" name="alumnoName" value="{{ $alumno->nombre }} {{ $alumno->apellidop }} {{ $alumno->apellidom }}" readonly>
                                    <br>
                                    <label for="carrera">Carrera:</label>
                                    <input type="text" class="form-control" id="carrera" name="carrera_id" value="{{ $alumno->nombreCarrera }}" readonly>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <label for="periodo">Periodo Actual:</label>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="periodo" value="{{ $periodos->periodo }}" readonly>
                            <input type="hidden" class="form-control" name="idperiodo" value="{{ $periodos->id }}" readonly>
                        </div>
                    </div>

                    <br>

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <label for="seguimientos">Seguimiento No. {{ $seguimientoActual->seguimiento }}</label>
                            <input type="hidden" class="form-control" id="seguimientos" name="periodo_tutoria_id" value="{{ $seguimientoActual->id }}" readonly>
                            <input type="hidden" class="form-control" name="numSeguimiento" value="{{ $seguimientoActual->seguimiento }}" readonly>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label for="fecha_ini" id="">Del:</label>
                                    <input class="form-control" id="fecha_ini" value="{{ $seguimientoActual->fecha_ini }}" readonly>
                                </div>
                                <div class="col">
                                    <label for="fecha_fin" id="">Al:</label>
                                    <input class="form-control" id="fecha_fin" value="{{ $seguimientoActual->fecha_fin }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>


                </div>

                @if($existeHorario>0)
                <div class="mb-3">
                    <br><br>
                    <div class="row">
                        <div class="col">
                            <h4 for="materia" class="form-label">MATERIAS QUE LLEVA EN SU HORARIO</h4>

                        </div>

                        <div class="col d-flex justify-content-end align-items-center" style="height: 100%;">
                            <button type="submit" class="btn btn-success mt-3" id="darAltaMaterias">Guardar Seguimiento</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        A = Acreditado
                    </div>
                    <div class="col">
                        NA = No Acreditado
                    </div>
                    <div class="col">
                        P = Pendiente de calificación
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th hidden>ID</th>
                            <th>Clave</th>
                            <th>Nombre</th>
                            <th>Semestre</th>
                            <th>Docente</th>

                            <th class="text-center">Temas Evaluados</th>
                            <th>Resultado</th>
                            <th class="text-center">Requiere Asesoría</th>
                            <th>Problemática</th>
                        </tr>
                    </thead>

                    <tbody id="materiasSeleccionadas">
                        @foreach($materias as $materia)
                        <tr>
                            <td hidden>{{ $materia->id }}</td>
                            <td>{{ $materia->idMateria }}</td>
                            <td>{{ $materia->nombreMateria }}</td>
                            <td class="text-center">{{ $materia->semestre }}</td>
                            <td>{{ $materia->nombres }} {{ $materia->apellidop }} {{ $materia->apellidom }}</td>
                            <td>
                                <select name="materias[{{ $materia->id }}][temasEv]" class="form-select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </td>
                            <td>
                                <select name="materias[{{ $materia->id }}][resultado]" class="form-select">
                                    <option value="A">A</option>
                                    <option value="NA">NA</option>
                                    <option value="P">P</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="materias[{{ $materia->id }}][asesoria]" value="1">
                            </td>
                            <td>
                                <input type="text" name="materias[{{ $materia->id }}][problematica]" class="form-control" placeholder="Describa problemática">
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @endif

                @if($existeHorario<=0)
                    <div class="alert alert-danger">
                    No tiene un Horario Cargado
                    </div>
                @endif
    </div>


    <!-- Fila Inferior -->
    <div class="row mt-4">
        <div class="col-md-6 text-center">
            <div class="pre-cargado">
                <label for="tutor"> <strong>Tutor:</strong> {{ $tutor->nombres }} {{ $tutor->apellidop }} {{ $tutor->apellidom }} </label>
                <input id="tutor" type="hidden" name="tutorName" value="{{ $tutor->nombres }} {{ $tutor->apellidop }} {{ $tutor->apellidom }}">
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="disponibilizado">
                <span>Disponibilizado:</span> MAyL Hilda P. Beltrán Hernández
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="coordinadora">
                Nombre coordinadora de Tutorías Dpto. Académico
            </div>

            <label id="fechaHoy" class="text-center d-block"></label>
        </div>
    </div>
    </form>
    @endif


    @if($existeRegistroSeguimiento>0)
    <div class="row">
        <!-- Columna Izquierda -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Información del Alumno</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" class="form-control" id="idAlumno" name="alumno_id" value="{{ $alumno->id }}" readonly>

                        <div class="col-sm-3">
                            <label for="noControl">No Control:</label>
                            <input type="text" class="form-control" id="noControl" name="noCtrl" value="{{ $alumno->noctrl }}" readonly>
                            <br>
                            <label for="semestre">Semestre:</label>
                            <input type="text" class="form-control" id="semestre" value="{{ $alumno->semestre }}" readonly>
                        </div>
                        <div class="col">
                            <label for="nombreAlumno">Alumno:</label>
                            <input type="text" class="form-control" id="nombreAlumno" name="alumnoName" value="{{ $alumno->nombre }} {{ $alumno->apellidop }} {{ $alumno->apellidom }}" readonly>
                            <br>
                            <label for="carrera">Carrera:</label>
                            <input type="text" class="form-control" id="carrera" name="carrera_id" value="{{ $alumno->nombreCarrera }}" readonly>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Columna Derecha -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <label for="periodo">Periodo Actual</label>
                </div>
                <div class="card-body">
                    <input type="text" class="form-control" id="periodo" value="{{ $periodos->periodo }}" readonly>
                    <input type="hidden" class="form-control" name="idperiodo" value="{{ $periodos->id }}" readonly>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <label for="seguimientos">Seguimiento No. {{ $seguimientoActual->seguimiento }}</label>
                    <input type="hidden" class="form-control" id="seguimientos" name="periodo_tutoria_id" value="{{ $seguimientoActual->id }}" readonly>
                    <input type="hidden" class="form-control" name="numSeguimiento" value="{{ $seguimientoActual->seguimiento }}" readonly>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label for="fecha_ini" id="">Del:</label>
                            <input class="form-control" id="fecha_ini" value="{{ $seguimientoActual->fecha_ini }}" readonly>
                        </div>
                        <div class="col">
                            <label for="fecha_fin" id="">Al:</label>
                            <input class="form-control" id="fecha_fin" value="{{ $seguimientoActual->fecha_fin }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <br>


        </div>

        @if($existeHorario>0)
        <div class="mb-3">
            <div class="row">
                <div class="alert alert-success">
                    Los Resultados de las Materias de este Seguimiento ya fueron Registrados
                </div>

                <br>
                <div class="col">
                    <a href="{{ route('generar-reporte') }}" class="btn btn-success">Descargar Seguimiento</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                A = Acreditado
            </div>
            <div class="col">
                NA = No Acreditado
            </div>
            <div class="col">
                P = Pendiente de calificación
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th hidden>ID</th>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Semestre</th>
                    <th>Docente</th>

                    <th>Temas Evaluados</th>
                    <th>Resultado</th>
                    <th>Requiere Asesoría</th>
                    <th>Problemática</th>
                </tr>
            </thead>

            <tbody>
                @foreach($materiasRegSeguimiento as $materia)
                <tr>
                    <td hidden>{{ $materia->id }}</td>
                    <td>{{ $materia->idMateria }}</td>
                    <td>{{ $materia->nombreMateria }}</td>
                    <td>{{ $materia->semestre }}</td>
                    <td>{{ $materia->nombres }} {{ $materia->apellidop }} {{ $materia->apellidom }}</td>

                    <td>{{ $materia->temasEv }}</td>
                    <td>{{ $materia->resultado }}</td>
                    <td>{{ $materia->asesoria ? 'Sí' : 'No' }}</td>
                    <td>{{ $materia->problematica }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @endif

        @if($existeHorario<=0)
            <div class="alert alert-danger">
            No tiene un Horario Cargado
            </div>
        @endif

    <!-- fila inferior -->
    <div class="row mt-4">
        <div class="col-md-6 text-center">
            <div class="pre-cargado">
                <label for="tutor"> <strong>Tutor:</strong> {{ $tutor->nombres }} {{ $tutor->apellidop }} {{ $tutor->apellidom }} </label>
                <input id="tutor" type="hidden" name="tutorName" value="{{ $tutor->nombres }} {{ $tutor->apellidop }} {{ $tutor->apellidom }}">
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="disponibilizado">
                <span>Disponibilizado:</span> MAyL Hilda P. Beltrán Hernández
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="coordinadora">
                Nombre coordinadora de Tutorías Dpto. Académico
            </div>

            <label id="fechaHoy" class="text-center d-block"></label>
        </div>
    </div>

    </div>
    @endif

    </div>

    @endif
    <!-- script para fecha actual -->
    <script>
        // Función para obtener el nombre del día en español
        function getDiaSemana(dia) {
            const dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
            return dias[dia];
        }

        // Función para obtener el nombre del mes en español
        function getMes(mes) {
            const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
            return meses[mes];
        }

        // Función que establece la fecha en el formato deseado
        function mostrarFecha() {
            const fecha = new Date();
            const diaSemana = getDiaSemana(fecha.getDay()); // Día de la semana
            const dia = fecha.getDate().toString().padStart(2, '0'); // Día con ceros a la izquierda si es necesario
            const mes = getMes(fecha.getMonth()); // Mes en palabras
            const anio = fecha.getFullYear(); // Año

            // Formato: "Lunes 02 de diciembre de 2024"
            const fechaFormateada = ${diaSemana} ${dia} de ${mes} de ${anio};

            // Mostrar la fecha en el elemento con id "fechaHoy"
            document.getElementById('fechaHoy').innerText = fechaFormateada;
        }

        // Ejecutar la función al cargar la página
        window.onload = mostrarFecha;
    </script>

</body>
</html>
@endsection
