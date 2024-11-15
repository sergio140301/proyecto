
@extends('inicio2')

@section('contenido2')
    @include('catalogos.personal.tablahtml') <!-- Si tienes una tabla previa para mostrar los datos -->
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
                                {{ route('personal.store') }} 
                            @else 
                                {{ route('personal.update', $personal->id) }} 
                            @endif">

                    @csrf
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                        <div class="mb-3">
                            <label for="noTrabajador" class="form-label">No. Trabajador</label>
                            <input type="text" name="noTrabajador" class="form-control" id="noTrabajador"
                                value="{{ old('noTrabajador', $personal->noTrabajador ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('noTrabajador')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el Num. de trabajador.</div>
                        </div>

                        <div class="mb-3">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" name="rfc" class="form-control" maxlength="13" id="rfc"
                                value="{{ old('rfc', $personal->rfc ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('rfc')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                            <div class="form-text">Escribe el RFC del personal.</div>
                        </div>

                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" name="nombres" class="form-control" id="nombres"
                                value="{{ old('nombres', $personal->nombres ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('nombres')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="apellidop" class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellidop" class="form-control" id="apellidop"
                                value="{{ old('apellidop', $personal->apellidop ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('apellidop')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="apellidom" class="form-label">Apellido Materno</label>
                            <input type="text" name="apellidom" class="form-control" id="apellidom"
                                value="{{ old('apellidom', $personal->apellidom ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('apellidom')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="licenciatura" class="form-label">Licenciatura</label>
                            <input type="text" name="licenciatura" class="form-control" id="licenciatura"
                                value="{{ old('licenciatura', $personal->licenciatura ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('licenciatura')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="especializacion" class="form-label">Especialización</label>
                            <input type="text" name="especializacion" class="form-control" id="especializacion"
                                value="{{ old('especializacion', $personal->especializacion ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('especializacion')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="maestria" class="form-label">Maestría</label>
                            <input type="text" name="maestria" class="form-control" id="maestria"
                                value="{{ old('maestria', $personal->maestria ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('maestria')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="doctorado" class="form-label">Doctorado</label>
                            <input type="text" name="doctorado" class="form-control" id="doctorado"
                                value="{{ old('doctorado', $personal->doctorado ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('doctorado')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fechaIngSep" class="form-label">Fecha de Ingreso (SEP)</label>
                            <input type="date" name="fechaIngSep" class="form-control" id="fechaIngSep"
                                value="{{ old('fechaIngSep', $personal->fechaIngSep ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('fechaIngSep')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fechaIngIns" class="form-label">Fecha de Ingreso (Institución)</label>
                            <input type="date" name="fechaIngIns" class="form-control" id="fechaIngIns"
                                value="{{ old('fechaIngIns', $personal->fechaIngIns ?? '') }}" 
                                {{ $accion == 'ver' ? 'disabled' : '' }}>
                            @error('fechaIngIns')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="puesto_id" class="form-label">Puesto</label>
                            <select name="puesto_id" class="form-control" id="puesto_id" {{ $accion == 'ver' ? 'disabled' : '' }}>
                                @foreach ($puestos as $puesto)
                                    <option value="{{ $puesto->id }}"
                                        {{ old('puesto_id', $personal->puesto_id ?? '') == $puesto->id ? 'selected' : '' }}>
                                        {{ $puesto->nombrepuesto }}
                                    </option>
                                @endforeach
                            </select>
                            @error('puesto_id')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="depto_id" class="form-label">Departamento</label>
                            <select name="depto_id" class="form-control" id="depto_id" {{ $accion == 'ver' ? 'disabled' : '' }}>
                                <option value="" disabled selected>Selecciona un departamento</option>
                                @foreach ($depto as $deptos)
                                    <option value="{{ $deptos->id }}"
                                        {{ old('depto_id', $personal->depto_id ?? '') == $deptos->id ? 'selected' : '' }}>
                                        {{ $deptos->nombreDepto }}
                                    </option>
                                @endforeach
                            </select>
                            @error('depto_id')
                                <ul class="list-unstyled text-danger">
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </div>

                        @if ($accion != 'ver')
                            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                        @endif
                    </form>

                    @if ($accion == 'ver')
                        <a href="{{ route('personal.index') }}" class="btn btn-primary">Regresar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
