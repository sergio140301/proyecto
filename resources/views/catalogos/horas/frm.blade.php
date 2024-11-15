@extends('inicio2')

@section('contenido1')
@include('catalogos.horas.tablahtml')
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
                <form method="POST" action="{{ $accion == 'crear' ? route('horas.store') : route('horas.update', $hora->id) }}">
                    @csrf
                    @if ($accion == 'actualizar')
                    @method('PUT')
                    @endif
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="mb-3">
                        <label for="hora_ini" class="form-label">Hora de Inicio</label>
                        <input type="time" name="hora_ini" class="form-control" id="hora_ini" value="{{ old('hora_ini', $hora->hora_ini ?? '') }}" {{ $desabilitado }}>
                        @error('hora_ini')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la hora de inicio: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Especifica la hora de inicio</div>
                    </div>

                    <div class="mb-3">
                        <label for="hora_fin" class="form-label">Hora de Fin</label>
                        <input type="time" name="hora_fin" class="form-control" id="hora_fin" value="{{ old('hora_fin', $hora->hora_fin ?? '') }}" {{ $desabilitado }}>
                        @error('hora_fin')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la hora de fin: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Especifica la hora de fin</div>
                    </div>

                    @if ($accion != 'ver')
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    @endif
                </form>

                @if ($accion == 'ver')
                <a href="{{ route('horas.index') }}" class="btn btn-primary">Regresar</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection