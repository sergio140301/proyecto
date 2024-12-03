@extends('inicio2')

@section('contenido1')
@include('catalogos.gruposhorarios18283.tablahtml18283')
@endsection

@section('contenido4000')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    @if ($accion == 'crear')
                    Insertar nuevo Grupo H
                    @elseif ($accion == 'actualizar')
                    Actualizar Grupo H
                    @elseif ($accion == 'ver')
                    Ver Grupo H
                    @endif
                </h4>
            </div>

            <div class="card-body">
                <form method="POST"
                    action="{{ $accion == 'crear' ? route('gruposhorarios18283.store') : route('gruposhorarios18283.update', $grupoHorario18283->id) }}">
                    @csrf
                    @if ($accion == 'actualizar')
                    @method('PUT')
                    @endif
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="mb-3">
                        <label for="dia" class="form-label">Dia</label>
                        <select name="dia" id="dia" class="form-control" {{$desabilitado}}>
                            <option value="" disabled selected>Seleccione un dia</option>
                            @foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'] as $dia)
                            <option value="{{ $dia }}"
                                {{ old('dia', $grupoHorario18283->dia ?? '') == $dia ? 'selected' : '' }}>
                                {{ $dia }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <select name="hora" id="hora" class="form-control" {{$desabilitado}}>
                            <option value="" disabled selected>Seleccione una hora</option>
                            @foreach ($horas as $horario)
                            <option value="{{ $horario->hora_ini . '-' . $horario->hora_fin }}"
                                {{ old('hora', $grupoHorario18283->hora ?? '') == $horario->hora_ini . '-' . $horario->hora_fin ? 'selected' : '' }}>
                                {{ $horario->hora_ini . ' - ' . $horario->hora_fin }}
                            </option>
                            @endforeach
                        </select>
                        @error('hora')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la descripcion: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="grupo18283_id" class="form-label">Grupo</label>
                        <select name="grupo18283_id" id="grupo18283_id" class="form-control" {{$desabilitado}}>
                            <option value="" disabled selected>Seleccione un grupo</option>
                            @foreach ($grupo18283s as $grupo)
                            <option value="{{ $grupo->id }}"
                                {{ (old('grupo18283_id', $grupoHorario18283->grupo18283_id ?? '') == $grupo->id) ? 'selected' : '' }}>
                                {{ $grupo->grupo }}
                            </option>
                            @endforeach
                        </select>
                        @error('grupo18283_id')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la selección de grupo: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lugar_id" class="form-label">Lugar</label>
                        <select name="lugar_id" id="lugar_id" class="form-control" {{$desabilitado}}>
                            <option value="" disabled selected>Seleccione un lugar</option>
                            @foreach ($lugars as $lugar)
                            <option value="{{ $lugar->id }}"
                                {{ (old('lugar_id', $grupoHorario18283->lugar_id ?? '') == $lugar->id) ? 'selected' : '' }}>
                                {{ $lugar->nombrelugar }}
                            </option>
                            @endforeach
                        </select>
                        @error('lugar_id')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la selección de lugar: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>



                    @if ($accion != 'ver')
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    @endif
                </form>

                @if ($accion == 'ver')
                <a href="{{ route('gruposhorarios18283.index') }}" class="btn btn-primary">Regresar</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection