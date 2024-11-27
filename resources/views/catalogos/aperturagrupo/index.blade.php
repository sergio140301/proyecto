@extends('inicio2')
@section('contenido2')

    <body>
        @if (session('sucess'))
            <div class="alert alert-success">
                {{ session('sucess') }}
            </div>
        @endif

        <h1 class="text-center my-4">Sistema de Horarios</h1>
        <div class="container my-4">
            <div class="row row-cols-1 row-cols-md-2 g-4">

                <!-- Card 1: Periodo y Acciones -->
                <div class="col">
                    <div class="card shadow-sm border-primary">
                        <div class="card-header bg-primary text-white text-center">
                            Periodo y Acciones
                        </div>
                        <div class="card-body">
                            {{-- filtros encapsulados en un form para consultar --}}
                            <form>
                                <div class="mb-3">
                                    <label for="idperiodo" class="form-label">Periodo:</label>
                                    <select name="idperiodo" id="idperiodo" class="form-select"
                                        onchange="this.form.submit()">
                                        <option value="-1">Selecciona</option>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id }}"
                                                @if ($periodo->id == session('periodo_id')) selected @endif>
                                                {{ $periodo->id }} {{ $periodo->periodo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idperiodo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="idcarrera" class="form-label">Carrera:</label>
                                    <select name="idcarrera" id="idcarrera" class="form-select"
                                        onchange="this.form.submit()">
                                        <option value="-1">Selecciona</option>
                                        @foreach ($carreras as $carr)
                                            <option value="{{ $carr->id }}"
                                                @if ($carr->id == session('carrera_id')) selected @endif>
                                                {{ $carr->id }} {{ $carr->nombreCarrera }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idcarrera')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sem" class="form-label">Semestre:</label>
                                    <select name="sem" id="sem" class="form-select" onchange="this.form.submit()">
                                        <option value="-1">Selecciona</option>
                                        @for ($i = 1; $i <= 9; $i++)
                                            <option value="{{ $i }}"
                                                {{ session('semestre') == $i ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('semestre')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- form edificios -->
                    <form action="">
                        <h1>Edificios</h1>
                        <select name="edificioid" id="edificioid" onchange="this.form.submit()">
                            <option value="-1">selecciona periodo</option>
                            @foreach ($edificios as $edi)
                                <option value="{{ $edi->id }}" @if ($edi->id == session('edificio_id')) selected @endif>
                                    {{ $edi->id }} {{ $edi->nombreedificio }}

                                </option>
                            @endforeach


                        </select>
                    </form><br>
                    <form method="POST" action="{{ route('aperturagrupo.store') }}">

                        <!-- form aulas -->

                        <label for="idlugar" class="form-label fw-bold">Lugares:</label>
                        @foreach ($lugars as $lugar)
                            <div class="form-check">
                                <input type="radio" name="idlugar" id="{{ $lugar->id }}" value="{{ $lugar->id }}"
                                    class="form-check-input">
                                <label for="{{ $lugar->id }}" class="form-check-label">
                                    {{ $lugar->nombrelugar }}
                                </label>
                            </div>
                        @endforeach


                </div>





                <!-- Card 2: Datos del Grupo -->
                <div class="col">
                    <div class="card shadow-sm border-primary">
                        <div class="card-header bg-primary text-white text-center">
                            Datos del Grupo
                        </div>
                        <div class="card-body">

                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="materia_id" class="form-label">Materias:</label>
                                    <select name="materia_id" id="materia_id" class="form-select">
                                        <option value="">Selecciona</option>
                                        @foreach ($filtrotriple[0]->reticulas[0]->materias as $materia)
                                            @if ($filtroma->contains('materia_id', $materia->id))
                                                <option value="{{ $materia->id }}">{{ $materia->nombreMateria }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('materia_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="personal_id" class="form-label">Docentes:</label>
                                    <select name="personal_id" id="personal_id" class="form-select">
                                        <option value="">Selecciona</option>
                                        @foreach ($personals as $personal)
                                            <option value="{{ $personal->id }}">
                                                {{ $personal->nombres }} {{ $personal->apellidop }}
                                                {{ $personal->apellidom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('personal_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="fecha" class="form-label">Fecha:</label>
                                    <input type="text" name="fecha" id="fecha" class="form-control" readonly>
                                    @error('fecha')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="grupo" class="form-label">Grupo:</label>
                                    <input type="text" name="grupo" id="grupo" class="form-control">
                                    @error('grupo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="maxAlumnos" class="form-label">Máx. Alumnos:</label>
                                    <input type="text" name="maxAlumnos" id="maxAlumnos" class="form-control">
                                    @error('maxAlumnos')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                        </div>

                    </div>
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
                    <button type="submit" class="btn btn-success w-100 mt-3">Abrir Grupo</button>
                    </form>
                </div>

            </div>


        </div>


    </body>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var formattedDate = today.getFullYear() + '-' +
            ('0' + (today.getMonth() + 1)).slice(-2) + '-' +
            ('0' + today.getDate()).slice(-2);
        document.getElementById('fecha').value = formattedDate;
    });
</script>
