@extends('inicio2')

@section('contenido2')
    @include('catalogos.puestos.tablahtml')
@endsection

@section('contenido4000')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        @if ($accion == 'crear')
                            Insertando datos nuevos
                        @elseif ($accion == 'actualizar')
                            Actualizando datos
                        @elseif ($accion == 'ver')
                            Ver datos
                        @endif
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ $accion == 'crear' ? route('puestos.store') : route('puestos.update', $puesto->id) }}">
                        @csrf
                        @if ($accion == 'actualizar')
                            @method('PUT')
                        @endif
                        @if ($accion == 'eliminar')
                            @method('DELETE')
                        @endif

                        <div class="mb-3">
                            <label for="idpuesto" class="form-label">ID Puesto</label>
                            <input type="text" name="idpuesto" class="form-control" maxlength="10" id="idpuesto"
                                value="{{ old('idpuesto', $puesto->idpuesto ?? '') }}" {{ $desabilitado }}>
                            @error('idpuesto')
                                <ul class="list-unstyled text-danger">
                                    <p>error en el ID Puesto {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el ID del puesto</div>
                        </div>

                        <div class="mb-3">
                            <label for="nombrepuesto" class="form-label">Nombre del Puesto</label>
                            <input type="text" name="nombrepuesto" class="form-control" id="nombrepuesto"
                                value="{{ old('nombrepuesto', $puesto->nombrepuesto ?? '') }}" {{ $desabilitado }}>
                            @error('nombrepuesto')
                                <ul class="list-unstyled text-danger">
                                    <p>error en el nombre del puesto {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el nombre del puesto</div>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select name="tipo" class="form-control" id="tipo" {{ $desabilitado }}>
                                <option value="Docente"
                                    {{ old('tipo', $puesto->tipo ?? '') == 'Docente' ? 'selected' : '' }}>Docente</option>
                                <option value="No Docente"
                                    {{ old('tipo', $puesto->tipo ?? '') == 'No Docente' ? 'selected' : '' }}>No Docente
                                </option>
                                <option value="Administrativo"
                                    {{ old('tipo', $puesto->tipo ?? '') == 'Administrativo' ? 'selected' : '' }}>
                                    Administrativo</option>
                                <option value="Director"
                                    {{ old('tipo', $puesto->tipo ?? '') == 'Director' ? 'selected' : '' }}>Director
                                </option>
                                <option value="Auxiliar"
                                    {{ old('tipo', $puesto->tipo ?? '') == 'Auxiliar' ? 'selected' : '' }}>Auxiliar
                                </option>
                            </select>
                            @error('tipo')
                                <ul class="list-unstyled text-danger">
                                    <p>error en el tipo {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Selecciona el tipo de puesto</div>
                        </div>

                        @if ($accion != 'ver')
                            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                        @endif
                    </form>

                    @if ($accion == 'ver')
                        <a href="{{ route('puestos.index') }}" class="btn btn-primary">Regresar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
