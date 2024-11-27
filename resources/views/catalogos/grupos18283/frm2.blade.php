<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    @if ($accion == 'crear')
                        Insertar nuevo Hora Grupo
                    @elseif ($accion == 'actualizar')
                        Actualizar Hora Grupo
                    @elseif ($accion == 'ver')
                        Ver Hora Grupo
                    @endif
                </h4>
            </div>

            <div class="card-body">
                <form method="POST"
                    action="{{ $accion == 'crear' ? route('gruposhorarios18283.store') : route('gruposhorarios18283.update', $grupohorario18283->id) }}">
                    @csrf
                    @if ($accion == 'actualizar')
                        @method('POST')
                    @endif
                    @if ($accion == 'eliminar')
                        @method('DELETE')
                    @endif

                    <!-- Campo Día -->
                    <div class="mb-3">
                        <label for="dia" class="form-label">Día</label>
                        <input type="text" name="dia" class="form-control" id="dia"
                            value="{{ old('dia', $grupohorario18283->dia ?? '') }}" {{ $desabilitado }}>
                        @error('dia')
                            <ul class="list-unstyled text-danger">
                                <p>Error en el día: {{ $message }}</p>
                            </ul>
                        @enderror
                        <div class="form-text">Ingrese el día (Ejemplo: lunes, martes, etc.)</div>
                    </div>

                    <!-- Campo Hora -->
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="text" name="hora" class="form-control" id="hora"
                            value="{{ old('hora', $grupohorario18283->hora ?? '') }}" {{ $desabilitado }}>
                        @error('hora')
                            <ul class="list-unstyled text-danger">
                                <p>Error en la hora: {{ $message }}</p>
                            </ul>
                        @enderror
                        <div class="form-text">Ingrese la hora de la clase (Ejemplo: 14:30)</div>
                    </div>

                    <!-- Campo Grupo -->
                    <div class="mb-3">
                        <label for="grupo_id" class="form-label">Grupo</label>
                        <select name="grupo_id" id="grupo_id" class="form-control" {{ $desabilitado }}>
                            <option value="" disabled selected>Seleccione un grupo</option>
                            @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->id }}"
                                    {{ old('grupo_id', $grupohorario18283->grupo_id ?? '') == $grupo->id ? 'selected' : '' }}>
                                    {{ $grupo->nombregrupo }}
                                </option>
                            @endforeach
                        </select>
                        @error('grupo_id')
                            <ul class="list-unstyled text-danger">
                                <p>Error en la selección del grupo: {{ $message }}</p>
                            </ul>
                        @enderror
                        <div class="form-text">Seleccione el grupo asociado.</div>
                    </div>

                    <!-- Campo Lugar -->
                    <div class="mb-3">
                        <label for="lugar_id" class="form-label">Lugar</label>
                        <select name="lugar_id" id="lugar_id" class="form-control" {{ $desabilitado }}>
                            <option value="" disabled selected>Seleccione un lugar</option>
                            @foreach ($lugars as $lugar)
                                <option value="{{ $lugar->id }}"
                                    {{ old('lugar_id', $grupohorario18283->lugar_id ?? '') == $lugar->id ? 'selected' : '' }}>
                                    {{ $lugar->nombrelugar }}
                                </option>
                            @endforeach
                        </select>
                        @error('lugar_id')
                            <ul class="list-unstyled text-danger">
                                <p>Error en la selección del lugar: {{ $message }}</p>
                            </ul>
                        @enderror
                        <div class="form-text">Seleccione el lugar para este grupo.</div>
                    </div>

                    <!-- Botón de acción -->
                    @if ($accion != 'ver')
                        <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    @endif
                </form>

                <!-- Botón regresar si está en modo ver -->
                @if ($accion == 'ver')
                    <a href="{{ route('grupos18283.index') }}" class="btn btn-primary">Regresar</a>
                @endif
            </div>
        </div>
    </div>
</div>