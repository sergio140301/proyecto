@extends('inicio2')

@section('contenido2')
    @include('catalogos.personal.index') {{-- Incluye la lista de Personal si corresponde --}}
@endsection

@section('contenido4000')
    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Personal</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos relacionados con este Personal...
                    </div>
                    <form action="{{ route('personal.destroy', $personal->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="noTrabajador" class="form-label">No. Trabajador</label>
                            <input type="text" name="noTrabajador" class="form-control" id="noTrabajador"
                                value="{{ $personal->noTrabajador }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" name="rfc" class="form-control" id="rfc"
                                value="{{ $personal->rfc }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" name="nombres" class="form-control" id="nombres"
                                value="{{ $personal->nombres }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="apellidop" class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellidop" class="form-control" id="apellidop"
                                value="{{ $personal->apellidop }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="apellidom" class="form-label">Apellido Materno</label>
                            <input type="text" name="apellidom" class="form-control" id="apellidom"
                                value="{{ $personal->apellidom }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="puesto" class="form-label">Puesto</label>
                            <input type="text" name="puesto" class="form-control" id="puesto"
                                value="{{ $personal->puesto->nombrePuesto ?? 'Sin puesto asignado' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="depto" class="form-label">Departamento</label>
                            <input type="text" name="depto" class="form-control" id="depto"
                                value="{{ $personal->depto->nombreDepto ?? 'Sin departamento asignado' }}" disabled>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('personal.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
