@extends('inicio2')

@section('contenido2')

<body>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-center my-4">Sistema de Horarios</h1>
    <div class="col-4 d-flex align-items-center justify-content-end">
        <a href="" class="btn btn-primary">
            <h5>BUSCAR GRUPO</h5>
        </a>
    </div>

    <hr />
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Periodo y Acciones</h5>
                        <hr />
                        <form>
                            <label for="idperiodo" class="form-label">Periodo:</label>
                            <select class="form-select mb-3" id="idperiodo" name="idperiodo" onchange="this.form.submit()">
                                <option value="-1">Seleccionar Periodo</option>
                                @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id }}" @if($periodo->id == session('periodo_id')) selected @endif>
                                    {{ $periodo->periodo }}
                                </option>
                                @endforeach
                            </select>
                            @error('idperiodo')
                            <ul class="list-unstyled text-danger">
                                <p>{{ $message }}</p>
                            </ul>
                            @enderror

                            <label for="idcarrera" class="form-label">Carrera:</label>
                            <select class="form-select mb-3" id="idcarrera" name="idcarrera" onchange="this.form.submit()">
                                <option value="-1">Seleccionar Carrera</option>
                                @foreach ($carreras as $carr)
                                <option value="{{ $carr->id }}" @if($carr->id == session('carrera_id')) selected @endif>
                                    {{ $carr->nombreCarrera }}
                                </option>
                                @endforeach
                            </select>
                            @error('idcarrera')
                            <ul class="list-unstyled text-danger">
                                <p>{{ $message }}</p>
                            </ul>
                            @enderror

                            <label for="sem" class="form-label">Semestre:</label>
                            <select class="form-select mb-3" id="sem" name="sem" onchange="this.form.submit()">
                                <option value="-1">Seleccione el Semestre</option>
                                @for ($i = 1; $i <= 9; $i++)
                                    <option value="{{ $i }}" {{ session('semestre') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                    </option>
                                    @endfor
                            </select>
                            @error('sem')
                            <ul class="list-unstyled text-danger">
                                <p>{{ $message }}</p>
                            </ul>
                            @enderror
                        </form>
                    </div>
                </div>

                <br><br><br>
                <form>
                    <label for="idedificio" class="form-label fw-bold">Edificios:</label>
                    <select class="form-select mb-3" id="idedificio" name="idedificio" onchange="this.form.submit()">
                        <option value="-1">Seleccionar Edificio</option>
                        @foreach ($edificios as $edificio)
                        <option value="{{ $edificio->id }}" @if($edificio->id == session('edificio_id')) selected @endif>
                            {{ $edificio->nombreedificio }}
                        </option>
                        @endforeach
                    </select>
                    @error('idedificio')
                    <ul class="list-unstyled text-danger">
                        <p>{{ $message }}</p>
                    </ul>
                    @enderror
                </form>

                <form action="{{ route('aperturagrupo.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="eliminar" id="eliminar" value="NOELIMINAR">

                    <label for="idlugar" class="form-label fw-bold">Lugares:</label>
                    @foreach ($lugars as $lugar)
                    <div class="form-check">
                        <input type="radio" name="idlugar" id="{{ $lugar->id }}" value="{{ $lugar->id }}" class="form-check-input">
                        <label for="{{ $lugar->id }}" class="form-check-label">
                            {{ $lugar->nombrelugar }}
                        </label>
                    </div>
                    @endforeach
            </div>

            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white fw-demibold">Datos del Grupo</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                @csrf
                                <label for="materia_id" class="form-label">Materias:</label>
                                <select name="materia_id" id="materia_id" class="form-control" onchange="">
                                    <option value="-1">Seleccione la Materia</option>
                                    @foreach ($carrera[0]->reticulas[0]->materias as $materia)
                                    @if ($ma->contains('materia_id', $materia->id))
                                    <option value="{{ $materia->id }}"> {{ $materia->nombreMateria }} </option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('materia_id')
                                <ul class="list-unstyled text-danger">
                                    <p>{{ $message }}</p>
                                </ul>
                                @enderror

                                <br />
                                <label for="personal_id" class="form-label">Docentes:</label>
                                <select name="personal_id" id="personal_id" class="form-control" onchange="">
                                    <option value="-1">Seleccione un Docente</option>
                                    @foreach ($personals as $person)
                                    <option value="{{ $person->id }}">
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
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input type="text" name="fecha" id="fecha" class="form-control mb-3" value="" readonly />
                                @error('fecha')
                                <ul class="list-unstyled text-danger">
                                    <p>{{ $message }}</p>
                                </ul>
                                @enderror

                                <label for="grupo" class="form-label">Grupo:</label>
                                <input type="text" class="form-control" id="grupo" name="grupo" value="" />
                                @error('grupo')
                                <ul class="list-unstyled text-danger">
                                    <p>{{ $message }}</p>
                                </ul>
                                @enderror

                                <label for="maxAlumnos" class="form-label">Max Alumnos:</label>
                                <input type="text" class="form-control" id="maxAlumnos" name="maxAlumnos" />
                                @error('maxAlumnos')
                                <ul class="list-unstyled text-danger">
                                    <p>{{ $message }}</p>
                                </ul>
                                @enderror
                            </div>
                        </div>
                        <br />
                    </div>
                </div>

                <br><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Horas</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miércoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horas as $hora)
                        <tr>
                            <td>{{ $hora->hora_ini }} - {{ $hora->hora_fin }}</td>
                            @foreach(['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'] as $dia)
                            <td>
                                <input
                                    type="checkbox"
                                    name="horarios[{{ $dia }}][]"
                                    value="{{ $hora->hora_ini }}-{{ $hora->hora_fin }}">
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit">Guardar</button>
                </form>
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

        document.addEventListener('DOMContentLoaded', (event) => {
            const fechaInput = document.getElementById('fecha');
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            // Enero es 0!
            const dd = String(today.getDate()).padStart(2, '0');
            const formattedDate = `${yyyy}-${mm}-${dd}`;
            fechaInput.value = formattedDate;
        });
    </script>
</body>
@endsection
