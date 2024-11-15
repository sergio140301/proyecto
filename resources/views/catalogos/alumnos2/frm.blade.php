@extends('inicio2')

@section('contenido2')
@include('catalogos.alumnos2.tablahtml')
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
                                {{ route('alumnos.store') }} 
                            @else 
                                {{ route('alumnos.update', $alumno->id) }} 
                            @endif">

                    @csrf
                    @if ($accion == 'eliminar')
                    @method('DELETE')
                    @endif

                    <div class="mb-3">
                        <label for="noctrl" class="form-label">No. de Control</label>
                        <input type="text" name="noctrl" class="form-control" maxlength="8" id="noctrl" value="{{ old('noctrl', $alumno->noctrl ?? '') }}" {{$desabilitado}}>
                        @error('noctrl')
                        <ul class="list-unstyled text-danger">
                            <p>error en el No. de Control {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe tu No. de Control</div>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre', $alumno->nombre) }}" aria-describedby="nombreHelp" {{$desabilitado}}>
                        @error('nombre')
                        <ul class="list-unstyled text-danger">
                            <p>error en el nombre {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe tu nombre</div>
                    </div>

                    <div class="mb-3">
                        <label for="apellidop" class="form-label">Apellido Paterno</label>
                        <input type="text" name="apellidop" class="form-control" id="apellidop" value="{{ old('apellidop', $alumno->apellidop) }}" aria-describedby="apellidoHelp" {{$desabilitado}}>
                        @error('apellidop')
                        <ul class="list-unstyled text-danger">
                            <p>error en el apellido {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe tu apellido paterno</div>
                    </div>

                    <div class="mb-3">
                        <label for="apellidom" class="form-label">Apellido Materno</label>
                        <input type="text" name="apellidom" class="form-control" id="apellidom" value="{{ old('apellidom', $alumno->apellidom ?? '') }}" {{$desabilitado}}>
                        @error('apellidom')
                        <ul class="list-unstyled text-danger">
                            <p>error en el apellido materno {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Escribe tu apellido materno</div>
                    </div>

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select name="sexo" class="form-control" id="sexo" {{$desabilitado}}>
                            <option value="M" {{ old('sexo', $alumno->sexo ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ old('sexo', $alumno->sexo ?? '') == 'F' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('sexo')
                        <ul class="list-unstyled text-danger">
                            <p>error en el sexo {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Selecciona tu sexo</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $alumno->email) }}" aria-describedby="emailHelp" {{$desabilitado}}>
                        @error('email')
                        <ul class="list-unstyled text-danger">
                            <p>error en el email {{ $message }}</p>
                        </ul>
                        @enderror
                        <div id="emailHelp" class="form-text">Escribe tu correo electrónico</div>
                    </div>

                    <div class="mb-3">
                        <label for="carrera_id" class="form-label">Carrera</label>
                        <select name="carrera_id" class="form-control" id="carrera_id" {{$desabilitado}}>
                            @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}" {{ old('carrera_id', $alumno->carrera_id ?? '') == $carrera->id ? 'selected' : '' }}>
                                {{ $carrera->nombreCarrera }}
                            </option>
                            @endforeach
                        </select>
                        @error('carrera_id')
                        <ul class="list-unstyled text-danger">
                            <p>error en la carrera {{ $message }}</p>
                        </ul>
                        @enderror
                        <div class="form-text">Selecciona tu carrera</div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection