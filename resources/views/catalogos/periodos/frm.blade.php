@extends('inicio2')

@section('contenido1')
    @include('catalogos.periodos.tablahtml')
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
                        action="{{ $accion == 'crear' ? route('periodos.store') : route('periodos.update', $periodo->id) }}">
                        @csrf
                        @if ($accion == 'actualizar')
                            @method('PUT')
                        @endif
                        @if ($accion == 'eliminar')
                            @method('DELETE')
                        @endif
                        
                        <div class="mb-3">
                            <label for="idPeriodo" class="form-label">ID Periodo</label>
                            <input type="text" name="idPeriodo" class="form-control" maxlength="15" id="idPeriodo"
                                value="{{ old('idPeriodo', $periodo->idPeriodo ?? '') }}" {{ $desabilitado }}>
                            @error('idPeriodo')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en el ID Periodo: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el ID del periodo</div>
                        </div>

                        <div class="mb-3">
                            <label for="periodo" class="form-label">Periodo</label>
                            <input type="text" name="periodo" class="form-control" id="periodo"
                                value="{{ old('periodo', $periodo->periodo ?? '') }}" {{ $desabilitado }}>
                            @error('periodo')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en el periodo: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe un nuevo periodo</div>
                        </div>

                        <div class="mb-3">
                            <label for="desCorta" class="form-label">Descripción Corta</label>
                            <input type="text" name="desCorta" class="form-control" id="desCorta"
                                value="{{ old('desCorta', $periodo->desCorta ?? '') }}" {{ $desabilitado }}>
                            @error('desCorta')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la descripción corta: {{ $message }}</p>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe una descripción corta del periodo</div>
                        </div>

                        <div class="mb-3">
                            <label for="fechaIni" class="form-label">Fecha Inicio</label>
                            <input type="date" name="fechaIni" class="form-control" id="fechaIni"
                                value="{{ old('fechaIni', $periodo->fechaIni ?? '') }}" {{ $desabilitado }}>
                            @error('fechaIni')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la fecha de inicio: {{ $message }}</p>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fechaFin" class="form-label">Fecha Fin</label>
                            <input type="date" name="fechaFin" class="form-control" id="fechaFin"
                                value="{{ old('fechaFin', $periodo->fechaFin ?? '') }}" {{ $desabilitado }}>
                            @error('fechaFin')
                                <ul class="list-unstyled text-danger">
                                    <p>Error en la fecha de fin: {{ $message }}</p>
                                </ul>
                            @enderror
                        </div>

                        @if ($accion != 'ver')
                            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                        @endif
                    </form>

                    @if ($accion == 'ver')
                        <a href="{{ route('periodos.index') }}" class="btn btn-primary">Regresar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
