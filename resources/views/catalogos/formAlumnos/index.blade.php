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
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="form-title">¡Formulario Para Alumnos!</div>
        <form method="POST" action="{{ route('formalumnos.store') }}">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
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
                        <div class="card-header">
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

                <div class="mb-3">
                    <br><br>
                    <div class="row">
                        <div class="col">
                            <label for="materia" class="form-label">Materias que lleva en su Horario:</label>
                            <select class="form-select" id="materia" onchange="agregarMateria(this)">
                                <option value="-1" disabled selected>-Seleccione materias-</option>
                                @foreach ($materias as $materia)
                                <option value="{{ $materia->id }}"
                                    data-idmateria="{{ $materia->idMateria }}"
                                    data-nombremateria="{{ $materia->nombreMateria }}"
                                    data-semestre="{{ $materia->semestre }}"
                                    data-docente="{{ $materia->nombres }} {{ $materia->apellidop }} {{ $materia->apellidom }}">
                                    {{ $materia->nombreMateria }}
                                </option>
                                @endforeach
                            </select>
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

                            <th>Temas Evaluados</th>
                            <th>Resultado</th>
                            <th>Asesoría</th>
                            <th>Problemática</th>
                        </tr>
                    </thead>
                    <tbody id="materiasSeleccionadas">
                        <!-- Filas dinámicas -->
                    </tbody>
                </table>
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
                        <span>Disponibilizado:</span> MayL Hilda Flores
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
    </div>

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
            const fechaFormateada = `${diaSemana} ${dia} de ${mes} de ${anio}`;

            // Mostrar la fecha en el elemento con id "fechaHoy"
            document.getElementById('fechaHoy').innerText = fechaFormateada;
        }

        // Ejecutar la función al cargar la página
        window.onload = mostrarFecha;
    </script>

    <!-- script para agg materia -->
    <script>
        function agregarMateria(select) {
            const materiaId = select.value;
            const materiaOption = select.options[select.selectedIndex];

            // Validar selección de una materia válida
            if (materiaId === '-1') {
                return; // No hacer nada si no se selecciona una materia válida
            }

            // Verifica si la materia ya está en la tabla
            const tabla = document.getElementById('materiasSeleccionadas');
            if ([...tabla.querySelectorAll('tr')].some(row => row.dataset.id === materiaId)) {
                alert("Esta materia ya fue agregada.");
                return;
            }

            // Extraer los datos de la materia
            const idMateria = materiaOption.getAttribute('data-idmateria');
            const nombreMateria = materiaOption.getAttribute('data-nombremateria');
            const semestre = materiaOption.getAttribute('data-semestre');
            const docente = materiaOption.getAttribute('data-docente');

            // Crear una nueva fila en la tabla
            const nuevaFila = document.createElement('tr');
            nuevaFila.dataset.id = materiaId; // Asignar el ID como atributo

            // Crear el HTML de la nueva fila
            nuevaFila.innerHTML = `
            <td>${idMateria}</td>
            <td>${nombreMateria}</td>
            <td>${semestre}</td>
            <td>${docente}</td>
            <td>
                <select class="form-select" name="materias[${materiaId}][temasEv]">
                    ${[1, 2, 3, 4, 5, 6, 7].map(num => `<option value="${num}">${num}</option>`).join('')}
                </select>
            </td>
            <td>
                <select class="form-select" name="materias[${materiaId}][resultado]">
                    <option value="A">A</option>
                    <option value="NA">NA</option>
                    <option value="P">P</option>
                </select>
            </td>
            <td>
                <input type="checkbox" class="asesoriaCheckbox" name="materias[${materiaId}][asesoria]" value="1">
            </td>
            <td>
                <input type="text" name="materias[${materiaId}][problematica]" class="problematicInput form-control" style="display:none;">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm eliminarMateria">x</button>
                <input type="hidden" name="materias[${materiaId}][id]" value="${materiaId}">
            </td>
        `;

            // Agregar la fila a la tabla
            tabla.appendChild(nuevaFila);

            // Limpiar selección
            select.value = '-1';

            // Agregar funcionalidad al botón de eliminar
            nuevaFila.querySelector('.eliminarMateria').addEventListener('click', function() {
                nuevaFila.remove();
            });

            // Agregar funcionalidad al checkbox de asesoría
            nuevaFila.querySelector('.asesoriaCheckbox').addEventListener('change', function() {
                const problematicInput = nuevaFila.querySelector('.problematicInput');
                problematicInput.style.display = this.checked ? 'block' : 'none';
            });
        }
    </script>

</body>

</html>
@endsection