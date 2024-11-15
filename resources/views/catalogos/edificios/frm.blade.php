@extends('inicio2')

@section('contenido1')
@include('catalogos.edificios.tablahtml')
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
                <form method="POST" action="{{ $accion == 'crear' ? route('edificios.store') : route('edificios.update', $edificio->id) }}">
                    @csrf
                    @if ($accion == 'actualizar')
                    @method('PUT')
                    @endif
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="mb-3">
                        <label for="nombreedificio" class="form-label">Nombre del Edificio</label>
                        <input type="text" name="nombreedificio" class="form-control" id="nombreedificio" value="{{ old('nombreedificio', $edificio->nombreedificio ?? '') }}" {{$desabilitado}}>
                        @error('nombreedificio')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el nombre del edificio: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe el nombre completo del edificio</div>
                    </div>

                    <div class="mb-3">
                        <label for="nombrecorto" class="form-label">Nombre Corto</label>
                        <input type="text" name="nombrecorto" class="form-control" id="nombrecorto" value="{{ old('nombrecorto', $edificio->nombrecorto ?? '') }}" {{$desabilitado}}>
                        @error('nombrecorto')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el nombre corto: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe un nombre corto para el edificio (opcional)</div>
                    </div>

                    @if ($accion != 'ver')
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    @endif
                </form>

                @if ($accion == 'ver')
                <a href="{{ route('edificios.index') }}" class="btn btn-primary">Regresar</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection