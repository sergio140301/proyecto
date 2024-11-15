@extends('inicio2')

@section('contenido2')
    @include('catalogos.alumnos2.index')
@endsection

@section('contenido4000')

    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Alumno</h4>
                </div>
                <div class="card-body">
                    <!-- Mensaje de advertencia -->
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos del alumno...
                    </div>
                    <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="noctrl" class="form-label">No. de Control</label>
                            <input type="text" name="noctrl" class="form-control" id="noctrl"
                            value="{{ $alumno->noctrl }}" aria-describedby="noctrlHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre"
                            value="{{ $alumno->nombre }}" aria-describedby="nombreHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="apellidop" class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellidop" class="form-control" id="apellidop"
                            value="{{ $alumno->apellidop }}" aria-describedby="apellidopHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="apellidom" class="form-label">Apellido Materno</label>
                            <input type="text" name="apellidom" class="form-control" id="apellidom"
                            value="{{ $alumno->apellidom }}" aria-describedby="apellidomHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <input type="text" name="sexo" class="form-control" id="sexo"
                            value="{{ $alumno->sexo }}" aria-describedby="sexoHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                            value="{{ $alumno->email }}" aria-describedby="emailHelp" disabled>
                            <div id="emailHelp" class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="carrera" class="form-label">Carrera</label>
                            <input type="text" name="carrera" class="form-control" id="carrera"
                            value="{{ $alumno->carrera->nombreCarrera ?? 'Sin Carrera' }}" aria-describedby="carreraHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('alumnos.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
