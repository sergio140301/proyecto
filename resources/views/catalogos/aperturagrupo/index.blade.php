@extends('inicio2')

@section('contenido2')

    <body>
        <h1 class="text-center my-4">Sistema de Horarios</h1>
        <hr />
        <div class="container">
            <!-- Primera fila: Cards principales -->
            <form action="{{ route('aperturagrupo.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- DATOS DEL GRUPO -->
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Datos del Grupo</h5>
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input type="date" name="fecha" id="fecha" class="form-control mb-3"
                                    value="{{ session('fecha', date('Y-m-d')) }}" required />

                                <label for="personal" class="form-label">Maestro:</label>
                                <input type="text" class="form-control" name="personal" id="personal"
                                    value="{{ session('personal') }}" disabled />
                                <input type="hidden" name="personal_id" id="personal_id_hidden"
                                    value="{{ session('personal_id') }}" />

                                <label for="materia" class="form-label">Materia:</label>
                                <input type="text" class="form-control" id="materia" name="materia"
                                    value="{{ session('materia') }}" disabled />
                                <input type="hidden" name="materia_id" id="materia_id_hidden"
                                    value="{{ session('materia_id') }}" />
                            </div>
                        </div>
                    </div>

                    <!-- INFO ADICIONAL -->
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Información Adicional</h5>
                                <label for="grupo" class="form-label">Grupo:</label>
                                <input type="text" class="form-control" id="grupo" name="grupo"
                                    value="{{ session('grupo') }}" required />
                                @if ($errors->has('grupo'))
                                    <div class="alert alert-danger">
                                        <p>Error en el nombre del Grupo, ya existe! {{ $errors->first('grupo') }}</p>
                                    </div>
                                @endif

                                <label for="maxAlumnos" class="form-label">Max Alumnos:</label>
                                <input type="number" class="form-control" id="maxAlumnos" name="maxAlumnos"
                                    value="{{ session('maxAlumnos') }}" required />

                                <label for="descripcion" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion"
                                    value="{{ session('descripcion') }}" />
                            </div>
                        </div>
                    </div>

                {{-- hola mundo! --}}
                    <!-- PERIODO Y ACCIONES -->
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Periodo y Acciones</h5>
                                <label for="periodo1" class="form-label">Periodo:</label>
                                <select class="form-select mb-3" id="periodo1" name="periodo_id" required>
                                    <option selected>Seleccionar Periodo</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->id }}"
                                            {{ session('periodo_id') == $periodo->id ? 'selected' : '' }}>
                                            {{ $periodo->periodo }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="periodo2" class="form-label">Carrera:</label>
                                <select class="form-select mb-3" id="periodo2" name="carrera_id" required>
                                    <option selected>Seleccionar Carrera</option>
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}"
                                            {{ session('carrera_id') == $carrera->id ? 'selected' : '' }}>
                                            {{ $carrera->nombreCarrera }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-primary w-100">Iniciar Grupo</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- COMBOBOX -->
            <div class="row">
                <div class="col">
                    <label for="personal_id" class="form-label">Docentes:</label>
                    <select name="personal_id" id="personal_id" class="form-control" onchange="mostrarSeleccionado()">
                        <option value="" disabled selected>Seleccione un Docente</option>
                        @foreach ($personals as $person)
                            <option value="{{ $person->id }}"
                                {{ session('personal_id') == $person->id ? 'selected' : '' }}>
                                {{ $person->nombres }} {{ $person->apellidop }} {{ $person->apellidom }}
                            </option>
                        @endforeach
                    </select>
                    @error('personal_id')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la selección de personal: {{ $message }}</p>
                        </ul>
                    @enderror
                </div>

                <div class="col">
                    <label for="edificio_id" class="form-label">Edificios:</label>
                    <form action="{{ route('aperturagrupo.index') }}" method="get" id="form-edificios">
                        <select name="edificio_id" id="edificio_id"
                            onchange="document.getElementById('form-edificios').submit()" class="form-control">
                            <option value="-1">Seleccione el Edificio</option>
                            @foreach ($edificios as $ed)
                                <option value="{{ $ed->id }}" @if ($ed->id == session('edificio_id')) selected @endif>
                                    {{ $ed->nombreedificio }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <label for="lugares_id" class="form-label">Lugares:</label>
                    <select name="lugares_id" id="lugares_id" class="form-control">
                        <option value="-1">Seleccione el Lugar</option>
                        @foreach ($lugars as $lugar)
                            <option value="{{ $lugar->id }}"
                                {{ session('lugares_id') == $lugar->id ? 'selected' : '' }}>
                                {{ $lugar->nombrelugar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label for="semestre" class="form-label">Semestre:</label>
                    <form action="{{ route('aperturagrupo.index') }}" method="get" id="form-semestre">
                        <select class="form-select mb-3" id="semestre" name="semestre" onchange="this.form.submit()">
                            <option value="-1">Seleccione el Semestre</option>
                            <option value="1" {{ request('semestre') == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ request('semestre') == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ request('semestre') == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ request('semestre') == 4 ? 'selected' : '' }}>4</option>
                            <option value="5" {{ request('semestre') == 5 ? 'selected' : '' }}>5</option>
                            <option value="6" {{ request('semestre') == 6 ? 'selected' : '' }}>6</option>
                            <option value="7" {{ request('semestre') == 7 ? 'selected' : '' }}>7</option>
                            <option value="8" {{ request('semestre') == 8 ? 'selected' : '' }}>8</option>
                            <option value="9" {{ request('semestre') == 9 ? 'selected' : '' }}>9</option>
                        </select>
                    </form>

                    <label for="materias_id" class="form-label">Materias:</label>
                    <select name="materia_id" id="materias_id" class="form-control" onchange="updateMateriaName()">
                        <option value="-1">Seleccione la Materia</option>
                        @foreach ($materias as $materia)
                            <option value="{{ $materia->id }}" data-nombre="{{ $materia->nombreMateria }}"
                                {{ session('materia_id') == $materia->id ? 'selected' : '' }}>
                                {{ $materia->nombreMateria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Columna con tabla de días y horas -->
                <div class="col">
                    <h5 class="text-center mb-3">Horario Semanal</h5>
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Hora</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="hora-1">
                                <td>06:00:00 - 07:00:00</td>
                                <td><input type="radio" name="lunes" class="form-check-input" id="lunes-1"
                                        disabled /></td>
                                <td><input type="radio" name="martes" class="form-check-input" id="martes-1"
                                        disabled /></td>
                                <td><input type="radio" name="miercoles" class="form-check-input" id="miercoles-1"
                                        disabled /></td>
                                <td><input type="radio" name="jueves" class="form-check-input" id="jueves-1"
                                        disabled /></td>
                                <td><input type="radio" name="viernes" class="form-check-input" id="viernes-1"
                                        disabled /></td>
                            </tr>
                            <!-- Repetir para más horas -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            function enviar(chbox) {
                if (!chbox.checked) {
                    document.getElementById('eliminar').value = chbox.value;
                }
                chbox.form.submit();
            }

            function mostrarSeleccionado() {
                // Obtener el select y el input
                const select = document.getElementById('personal_id');
                const input = document.getElementById('personal');
                const hiddenInput = document.getElementById('personal_id_hidden');

                // Obtener el texto del elemento seleccionado
                const textoSeleccionado = select.options[select.selectedIndex].text;
                const valorSeleccionado = select.value;

                // Asignar el texto al input
                input.value = textoSeleccionado;
                hiddenInput.value = valorSeleccionado;
            }

            function updateMateriaName() {
                const materiaSelect = document.getElementById('materias_id');
                const selectedOption = materiaSelect.options[materiaSelect.selectedIndex];
                const materiaName = selectedOption.text;
                const materiaId = selectedOption.value;

                // Rellenar el input con el nombre de la materia
                document.getElementById('materia').value = materiaName;
                document.getElementById('materia_id_hidden').value = materiaId;
            }

            // Establecer la fecha actual en el campo de fecha
            document.addEventListener('DOMContentLoaded', function() {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('fecha').value = today;
            });
        </script>
    </body>
@endsection
