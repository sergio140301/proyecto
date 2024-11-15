@extends('inicio2')

@section('contenido2')
    @include('catalogos.reticulas.tablahtml')
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
                        action="@if ($accion == 'crear') {{ route('reticulas.store') }} 
                            @else 
                                {{ route('reticulas.update', $reticula->id) }} @endif">

                        @csrf
                        @if ($accion == 'eliminar')
                            @method('DELETE')
                        @endif

                        <div class="mb-3">
                            <label for="idReticula" class="form-label">ID Retícula</label>
                            <input type="text" name="idReticula" class="form-control" maxlength="15" id="idReticula"
                                value="{{ old('idReticula', $reticula->idReticula ?? '') }}" {{ $desabilitado }}>
                            @error('idReticula')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en el ID Retícula: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el ID de la retícula</div>
                        </div>

                        <div class="mb-3">
                            <label for="Descripcion" class="form-label">Descripción</label>
                            <input type="text" name="Descripcion" class="form-control" id="Descripcion"
                                value="{{ old('Descripcion', $reticula->Descripcion ?? '') }}" {{ $desabilitado }}>
                            @error('Descripcion')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la descripción: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe la descripción de la retícula</div>
                        </div>

                        <div class="mb-3">
                            <label for="carrera_id" class="form-label">Carrera</label>
                            <select name="carrera_id" class="form-control" id="carrera_id" {{ $desabilitado }}>
                                <option value="" disabled selected>Selecciona una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        {{ old('carrera_id', $reticula->carrera_id ?? '') == $carrera->id ? 'selected' : '' }}>
                                        {{ $carrera->nombreCarrera }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrera_id')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la carrera: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Selecciona la carrera asociada</div>
                        </div>

                        <div class="mb-3">
                            <label for="fechaEnVigor" class="form-label">Fecha en Vigor</label>
                            <input type="date" name="fechaEnVigor" class="form-control" id="fechaEnVigor"
                                value="{{ old('fechaEnVigor', $reticula->fechaEnVigor ?? '') }}" {{ $desabilitado }}>
                            @error('fechaEnVigor')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la fecha en vigor: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe la fecha en vigor de la retícula</div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
