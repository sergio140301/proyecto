@extends('inicio2')

@section('contenido1')
    @include('alumnos2/tablahtml')
@endsection

@section('contenido2')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Ver todos los Datos del Alumno</h4>
                </div>
                <div class="card-body">
                    <form method="get">
                        @csrf
                        <div class="mb-3">
                            <label for="noctrl" class="form-label">No. de Control</label>
                            <input type="text" name="noctrl" class="form-control" id="noctrl"
                            value="{{ $alumno->noctrl }}" aria-describedby="noctrlHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre"
                            value="{{ $alumno->nombre }}" aria-describedby="nombreHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="apellidop" class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellidop" class="form-control" id="apellidop"
                            value="{{ $alumno->apellidop }}" aria-describedby="apellidoHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="apellidom" class="form-label">Apellido Materno</label>
                            <input type="text" name="apellidom" class="form-control" id="apellidom"
                            value="{{ $alumno->apellidom }}" aria-describedby="apellidomHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <input type="text" name="sexo" class="form-control" id="sexo"
                            value="{{ $alumno->sexo }}" aria-describedby="sexoHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                            value="{{ $alumno->email }}" aria-describedby="emailHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="carrera" class="form-label">Carrera</label>
                            <input type="text" name="carrera" class="form-control" id="carrera"
                            value="{{ $alumno->carrera->nombreCarrera ?? 'Sin Carrera' }}" aria-describedby="carreraHelp" disabled>
                        </div>

                        <a href="{{ route('alumnos.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
          
