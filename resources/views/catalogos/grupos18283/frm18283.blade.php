@extends('inicio2')

@section('contenido1')
@include('catalogos.grupos18283.tablahtml18283')
@endsection

@section('contenido4000')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    @if ($accion == 'crear')
                    Insertar nuevo Grupo
                    @elseif ($accion == 'actualizar')
                    Actualizar Grupo
                    @elseif ($accion == 'ver')
                    Ver Grupo
                    @endif
                </h4>
            </div>

            <div class="card-body">
                <form method="POST"
                    action="{{ $accion == 'crear' ? route('grupos18283.store') : route('grupos18283.update', $grupo18283->id) }}">
                    @csrf
                    @if ($accion == 'actualizar')
                    @method('PUT')
                    @endif
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="mb-3">
                        <label for="grupo" class="form-label">Grupo</label>
                        <input type="text" name="grupo" class="form-control" id="grupo"
                            value="{{ old('grupo', $grupo18283->grupo ?? '') }}" {{$desabilitado}}>
                        @error('grupo')
                        <ul class="list-unstyled text-danger">
                            <p>Error en el grupo: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Ingrese el grupo</div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" id="descripcion"
                            value="{{ old('descripcion', $grupo18283->descripcion ?? '') }}" {{$desabilitado}}>
                        @error('descripcion')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la descripcion: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Ingrese la descripcion</div>
                    </div>

                    <div class="mb-3">
                        <label for="maxAlumnos" class="form-label">Máximo de Alumnos</label>
                        <input type="text" name="maxAlumnos" class="form-control" id="maxAlumnos"
                            value="{{ old('maxAlumnos', $grupo18283->maxAlumnos ?? '') }}" {{$desabilitado}}>
                        @error('maxAlumnos')
                        <ul class="list-unstyled text-danger">
                            <p>Error en maxAlumnos: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Ingrese el máximo de Alumnos permitidos</div>
                    </div>

                    <div class="mb-3">
                        <label for="periodo_id" class="form-label">Periodo</label>
                        <select name="periodo_id" id="periodo_id" class="form-control" {{$desabilitado}}>
                            <option value="" disabled selected>Seleccione un periodo</option>
                            @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}"
                                {{ (old('periodo_id', $grupo18283->periodo_id ?? '') == $periodo->id) ? 'selected' : '' }}>
                                {{ $periodo->periodo }}
                            </option>
                            @endforeach
                        </select>
                        @error('periodo_id')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la selección de periodos: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Seleccione el periodo</div>
                    </div>

                    <div class="mb-3">
                        <label for="personal_id" class="form-label">Docente</label>
                        <select name="personal_id" id="personal_id" class="form-control" {{$desabilitado}}>
                            <option value="" disabled selected>Seleccione un docente</option>
                            @foreach ($personals as $personal)
                            <option value="{{ $personal->id }}"
                                {{ (old('personal_id', $grupo18283->personal_id ?? '') == $personal->id) ? 'selected' : '' }}>
                                {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                            </option>
                            @endforeach
                        </select>
                        @error('personal_id')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la selección de personal: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Seleccione el docente</div>
                    </div>

                    <div class="mb-3">
                        <label for="materia_id" class="form-label">Materia</label>
                        <select name="materia_id" id="materia_id" class="form-control" {{$desabilitado}}>
                            <option value="" disabled selected>Seleccione una materia</option>
                            @foreach ($materias as $materia)
                            <option value="{{ $materia->id }}"
                                {{ (old('materia_id', $grupo18283->materia_id ?? '') == $materia->id) ? 'selected' : '' }}>
                                {{ $materia->nombreMateria }}
                            </option>
                            @endforeach
                        </select>
                        @error('materia_id')
                        <ul class="list-unstyled text-danger">
                            <p>Error en la selección de materia: {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Seleccione la materia</div>
                    </div>



                    @if ($accion != 'ver')
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                    @endif
                </form>

                @if ($accion == 'ver')
                <a href="{{ route('grupos18283.index') }}" class="btn btn-primary">Regresar</a>
                @endif
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card">
            
        </div>
    </div>
</div>
@endsection