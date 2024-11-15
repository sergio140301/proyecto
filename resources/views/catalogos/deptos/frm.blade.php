@extends('inicio2')

@section('contenido1')
@include('catalogos.deptos.tablahtml')
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
                <form method="POST" action="{{ $accion == 'crear' ? route('deptos.store') : route('deptos.update', $depto->id) }}">
                    @csrf
                    @if ($accion == 'actualizar')
                    @method('PUT')
                    @endif
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="mb-3">
                        <label for="idDepto" class="form-label">ID Depto</label>
                        <input type="text" name="idDepto" class="form-control" id="idDepto" maxlength="2" value="{{ old('idDepto', $depto->idDepto ?? '') }}" {{$desabilitado}}>
                        @error('idDepto')
                        <ul class="list-unstyled text-danger">
                            <p>error en el ID Depto {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe el ID del departamento *2 numeros*</div>
                    </div>

                    <div class="mb-3">
                        <label for="nombreDepto" class="form-label">Nombre del Departamento</label>
                        <input type="text" name="nombreDepto" class="form-control" id="nombreDepto" value="{{ old('nombreDepto', $depto->nombreDepto) }}" {{$desabilitado}}>
                        @error('nombreDepto')
                        <ul class="list-unstyled text-danger">
                            <p>error en el nombre del departamento {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe el nombre del departamento</div>
                    </div>

                    <div class="mb-3">
                        <label for="nombreMediano" class="form-label">Nombre Mediano</label>
                        <input type="text" name="nombreMediano" class="form-control" id="nombreMediano" maxlength="4" value="{{ old('nombreMediano', $depto->nombreMediano ?? '') }}" {{$desabilitado}}>
                        @error('nombreMediano')
                        <ul class="list-unstyled text-danger">
                            <p>error en el nombre mediano {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe el nombre mediano Maximo 4 letras</div>
                    </div>

                    <div class="mb-3">
                        <label for="nombreCorto" class="form-label">Nombre Corto</label>
                        <input type="text" name="nombreCorto" class="form-control" id="nombreCorto" maxlength="3" value="{{ old('nombreCorto', $depto->nombreCorto ?? '') }}" {{$desabilitado}}>
                        @error('nombreCorto')
                        <ul class="list-unstyled text-danger">
                            <p>error en el nombre corto {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe el nombre corto minimo 3</div>
                    </div>                  

                    @if ($accion != 'ver')
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    @endif
                </form>

                @if ($accion == 'ver')
                <a href="{{ route('deptos.index') }}" class="btn btn-primary">Regresar</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection