@extends('inicio2')

@section('contenido2')
@include('catalogos.lugares.tablahtml')
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
                <form method="POST" action="@if ($accion == 'crear') 
                                {{ route('lugares.store') }} 
                            @else 
                                {{ route('lugares.update', $lugar->id) }} 
                            @endif">

                    @csrf
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="mb-3">
                        <label for="nombrelugar" class="form-label">Nombre del Lugar</label>
                        <input type="text" name="nombrelugar" class="form-control" id="nombrelugar" value="{{ old('nombrelugar', $lugar->nombrelugar ?? '') }}" {{$desabilitado}}>
                        @error('nombrelugar')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el nombre del lugar: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe el nombre completo del lugar</div>
                    </div>

                    <div class="mb-3">
                        <label for="nombrecorto" class="form-label">Nombre Corto</label>
                        <input type="text" name="nombrecorto" class="form-control" id="nombrecorto" value="{{ old('nombrecorto', $lugar->nombrecorto ?? '') }}" {{$desabilitado}}>
                        @error('nombrecorto')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el nombre corto: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe un nombre corto para el lugar (opcional)</div>
                    </div>

                    <div class="mb-3">
                        <label for="edificio_id" class="form-label">Edificio Asociado</label>
                        <select name="edificio_id" id="edificio_id" class="form-control" {{$desabilitado}}>
                            @foreach ($edificios as $edificio)
                            <option value="{{ $edificio->id }}" {{ (old('edificio_id', $lugar->edificio_id ?? '') == $edificio->id) ? 'selected' : '' }}>
                                {{ $edificio->nombreedificio }}
                            </option>
                            @endforeach
                        </select>
                        @error('edificio_id')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el edificio asociado: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Selecciona el edificio al que pertenece el lugar</div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>

                    <!--@if ($accion != 'ver')
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    @endif-->
                </form>

                <!--@if ($accion == 'ver')
                <a href="{{ route('lugares.index') }}" class="btn btn-primary">Regresar</a>
                @endif-->
            </div>
        </div>
    </div>
</div>
@endsection