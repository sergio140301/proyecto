@extends('inicio2')

@section('contenido1')

@endsection

@section('contenido4000')
<br>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    @if ($accion == 'crear')
                    Insertar nuevo Grupo
                    @elseif ($accion == 'actualizar')
                    Actualizar Grupo
                    @elseif ($accion == 'ver')
                    Ver Grupo
                    @endif
                </h4>
            </div>

            <div class="card-body">
                <form method="POST"
                    action="{{ $accion == 'crear' ? route('grupos18283.store') : route('grupos18283.update', $grupo18283->id) }}">
                    @csrf
                    @if ($accion == 'actualizar')
                    @method('PUT')
                    @endif
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="grupo" class="form-label">Grupo</label>
                                <input type="text" name="grupo" class="form-control" id="grupo"
                                    value="{{ old('grupo', $grupo18283->grupo ?? '') }}" {{$desabilitado}}>
                                @error('grupo')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en el grupo: {{ $message }}</p>
                                </ul>
                                @enderror
                                <div class="form-text">Ingrese el grupo</div>
                            </div>

                            <div class="mb-3">
                                <label for="maxAlumnos" class="form-label">Máximo de Alumnos</label>
                                <input type="text" name="maxAlumnos" class="form-control" id="maxAlumnos"
                                    value="{{ old('maxAlumnos', $grupo18283->maxAlumnos ?? '') }}" {{$desabilitado}}>
                                @error('maxAlumnos')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en maxAlumnos: {{ $message }}</p>
                                </ul>
                                @enderror
                                <div class="form-text">Ingrese el máximo de Alumnos permitidos</div>
                            </div>

                            <div class="mb-3">
                                <label for="personal_id" class="form-label">Docente</label>
                                <select name="personal_id" id="personal_id" class="form-control" {{$desabilitado}}>
                                    <option value="" disabled selected>Seleccione un docente</option>
                                    @foreach ($personals as $personal)
                                    <option value="{{ $personal->id }}"
                                        {{ (old('personal_id', $grupo18283->personal_id ?? '') == $personal->id) ? 'selected' : '' }}>
                                        {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('personal_id')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la selección de personal: {{ $message }}</p>
                                </ul>
                                @enderror
                                <div class="form-text">Seleccione el docente</div>
                            </div>

                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" name="descripcion" class="form-control" id="descripcion"
                                    value="{{ old('descripcion', $grupo18283->descripcion ?? '') }}" {{$desabilitado}}>
                                @error('descripcion')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la descripcion: {{ $message }}</p>
                                </ul>
                                @enderror
                                <div class="form-text">Ingrese la descripcion</div>
                            </div>

                            <div class="mb-3">
                                <label for="periodo_id" class="form-label">Periodo</label>
                                <select name="periodo_id" id="periodo_id" class="form-control" {{$desabilitado}}>
                                    <option value="" disabled selected>Seleccione un periodo</option>
                                    @foreach ($periodos as $periodo)
                                    <option value="{{ $periodo->id }}"
                                        {{ (old('periodo_id', $grupo18283->periodo_id ?? '') == $periodo->id) ? 'selected' : '' }}>
                                        {{ $periodo->periodo }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('periodo_id')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la selección de periodos: {{ $message }}</p>
                                </ul>
                                @enderror
                                <div class="form-text">Seleccione el periodo</div>
                            </div>

                            <div class="mb-3">
                                <label for="materia_id" class="form-label">Materia</label>
                                <select name="materia_id" id="materia_id" class="form-control" {{$desabilitado}}>
                                    <option value="" disabled selected>Seleccione una materia</option>
                                    @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}"
                                        {{ (old('materia_id', $grupo18283->materia_id ?? '') == $materia->id) ? 'selected' : '' }}>
                                        {{ $materia->nombreMateria }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('materia_id')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la selección de materia: {{ $message }}</p>
                                </ul>
                                @enderror
                                <div class="form-text">Seleccione la materia</div>
                            </div>
                        </div>
                    </div>

                    @if ($accion != 'ver')
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    @endif
                </form>

                @if ($accion == 'ver')
                <a href="{{ route('grupos18283.index') }}" class="btn btn-primary">Regresar</a>
                @endif
            </div>
        </div>
    </div>

    @if ($accion == 'actualizar')
    <div class="col-lg-8">
        <div class="container">
            <div class="row">
                @foreach ($horas as $index => $horario)

                @php
                $horaLabel = $horario->hora_ini . ' - ' . $horario->hora_fin;
                // Obtenemos el contador de registros para esa hora
                $contador = $contadorRegistros[$horaLabel] ?? 0;
                @endphp
                <div class="col-md-6 mb-4">
                    <form method="POST" action="{{ $contador > 0 
                                                ? route('grupos18283.destroyHorario', ['grupoId' => $grupo18283->id, 'dia' => 'Lunes', 'hora' => $horaLabel]) 
                                                : route('grupos18283.storeHorario', $grupo18283->id) }}">
                        @csrf
                        @if ($contador > 0)
                        @method('DELETE') <!-- Método DELETE para eliminar -->
                        @endif
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">
                                    Grupo Horario {{ $index + 1 }}
                                </h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <!-- <label for="grupo18283_id_{{ $index }}" class="form-label">Grupo</label> -->
                                        <input
                                            type="hidden"
                                            class="form-control"
                                            value="{{ $grupo18283->grupo }}"
                                            readonly>
                                        <input
                                            type="hidden"
                                            name="grupo18283_id"
                                            value="{{ $grupo18283->id }}">
                                        @error('grupo18283_id')
                                        <ul class="list-unstyled text-danger">
                                            <p>Error en la selección de grupo: {{ $message }}</p>
                                        </ul>
                                        @enderror

                                        <div class="mb-3">
                                            <label for="lugar_id_{{ $index }}" class="form-label">Lugar</label>

                                            @if ($contador > 0)
                                            <!-- Si contador > 0, se muestra un input con el valor del lugar -->
                                            <input
                                                type="text"
                                                class="form-control"
                                                value="{{ $lugars->firstWhere('id', $lugaresAsociados[$horaLabel])->nombrelugar ?? 'Lugar no encontrado' }}"
                                                readonly>
                                            <input
                                                type="hidden"
                                                name="lugar_id"
                                                value="{{ $lugaresAsociados[$horaLabel] }}">
                                            @else
                                            <!-- Si contador <= 0, se muestra un select -->
                                            <select name="lugar_id" id="lugar_id_{{ $index }}" class="form-control" {{$desabilitado}}>
                                                <option value="" disabled selected>Seleccione lugar</option>
                                                @foreach ($lugars as $lugar)
                                                <option value="{{ $lugar->id }}"
                                                    {{ (old('lugar', $grupo18283->nombrelugar ?? 'No especificado') == $lugar->nombrelugar) ? 'selected' : '' }}>
                                                    {{ $lugar->nombrelugar }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @endif

                                            @error('lugar_id')
                                            <ul class="list-unstyled text-danger">
                                                <p>Error en la selección de lugar: {{ $message }}</p>
                                            </ul>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col">
                                        <!-- <label for="dia_{{ $index }}" class="form-label">Dia</label> -->
                                        <input type="hidden" name="dia" class="form-control" id="dia_{{ $index }}" value="Lunes" {{$desabilitado}} readonly>
                                        @error('dia')
                                        <ul class="list-unstyled text-danger">
                                            <p>Error en la selección de grupo: {{ $message }}</p>
                                        </ul>
                                        @enderror

                                        <!-- <label for="hora_{{ $index }}" class="form-label">Hora</label> -->
                                        <input
                                            type="hidden"
                                            name="hora"
                                            id="hora_{{ $index }}"
                                            class="form-control"
                                            value="{{ $horas[$index]->hora_ini . ' - ' . $horas[$index]->hora_fin }}"
                                            {{$desabilitado}}
                                            readonly>
                                        @error('hora')
                                        <ul class="list-unstyled text-danger">
                                            <p>Error en la descripción: {{ $message }}</p>
                                        </ul>
                                        @enderror


                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="checkbox_{{ $grupo18283->id }}"
                                        value="{{ $grupo18283->id }}"
                                        class="form-check-input"
                                        id="checkbox_{{ $grupo18283->id }}"
                                        onchange="enviar(this)"
                                        @if ($contador> 0) checked @endif>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>


    </div>
    @endif
</div>

<script>
    function enviar(chbox) {
        chbox.form.submit();
    }
</script>

@endsection