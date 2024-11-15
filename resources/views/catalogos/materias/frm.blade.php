@extends('inicio2')

@section('contenido2')
@include('catalogos.materias.tablahtml')
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
                                {{ route('materias.store') }} 
                            @else 
                                {{ route('materias.update', $materia->id) }} 
                            @endif">

                    @csrf
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="mb-3">
                        <label for="idMateria" class="form-label">ID Materia</label>
                        <input type="text" name="idMateria" class="form-control" maxlength="15" id="idMateria" value="{{ old('idMateria', $materia->id ?? '') }}" {{$desabilitado}}>
                        @error('idMateria')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el ID Materia: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe el ID de la materia</div>
                    </div>

                    <div class="mb-3">
                        <label for="nombreMateria" class="form-label">Nombre de Materia</label>
                        <input type="text" name="nombreMateria" class="form-control" id="nombreMateria" value="{{ old('nombreMateria', $materia->nombreMateria ?? '') }}" {{$desabilitado}}>
                        @error('nombreMateria')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el nombre de la materia: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="semestre" class="form-label">Semestre</label>
                        <select name="semestre" class="form-control" id="semestre" {{$desabilitado}}>
                            <option value="" disabled selected>Selecciona un semestre</option>
                            @for ($i = 1; $i <= 9; $i++)
                                <option value="{{ $i }}" {{ old('semestre', $materia->semestre ?? '') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @error('semestre')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el semestre: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nombreMediano" class="form-label">Nombre Mediano</label>
                        <input type="text" name="nombreMediano" class="form-control" id="nombreMediano" value="{{ old('nombreMediano', $materia->nombreMediano ?? '') }}" {{$desabilitado}}>
                        @error('nombreMediano')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el nombre mediano: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nombreCorto" class="form-label">Nombre Corto</label>
                        <input type="text" name="nombreCorto" class="form-control" id="nombreCorto" value="{{ old('nombreCorto', $materia->nombreCorto ?? '') }}" {{$desabilitado}}>
                        @error('nombreCorto')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el nombre corto: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="modalidad" class="form-label">Modalidad</label>
                        <select name="modalidad" class="form-control" id="modalidad" {{$desabilitado}}>
                            <option value="" disabled selected>Selecciona una modalidad</option>
                            <option value="E" {{ old('modalidad', $materia->modalidad ?? '') == 'E' ? 'selected' : '' }}>En línea</option>
                            <option value="M" {{ old('modalidad', $materia->modalidad ?? '') == 'M' ? 'selected' : '' }}>Mixta</option>
                        </select>
                        @error('modalidad')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la modalidad: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nivel" class="form-label">Nivel</label>
                        <select name="nivel" class="form-control" id="nivel" {{$desabilitado}}>
                            <option value="" disabled selected>Selecciona un nivel</option>
                            <option value="S" {{ old('nivel', $materia->nivel ?? '') == 'S' ? 'selected' : '' }}>S</option>
                            <option value="L" {{ old('nivel', $materia->nivel ?? '') == 'L' ? 'selected' : '' }}>L</option>
                            <option value="F" {{ old('nivel', $materia->nivel ?? '') == 'F' ? 'selected' : '' }}>F</option>
                        </select>
                        @error('nivel')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el nivel: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="reticula_id" class="form-label">Retícula</label>
                        <select name="reticula_id" class="form-control" id="reticula_id" {{$desabilitado}}>
                            <option value="" disabled selected>Selecciona una retícula</option>
                            @foreach ($reticulas as $reticula)
                                <option value="{{ $reticula->id }}" {{ old('reticula_id', $materia->reticula_id ?? '') == $reticula->id ? 'selected' : '' }}>
                                    {{ $reticula->Descripcion }} 
                                </option>
                            @endforeach
                        </select>
                        @error('reticula_id')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la retícula: {{ $message }}</p>
                        </ul>
                        @enderror
                    </div>

                    @if ($accion != 'ver')
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                @endif
            </form>

            @if ($accion == 'ver')
                <a href="{{ route('materias.index') }}" class="btn btn-primary">Regresar</a>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection