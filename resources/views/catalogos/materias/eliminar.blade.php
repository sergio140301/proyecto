@extends('inicio2')

@section('contenido2')
    @include('catalogos.materias.tablahtml') <!-- Asegúrate de que esta ruta sea correcta -->
@endsection

@section('contenido4000')

    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Materia</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos...
                    </div>
                    <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="idMateria" class="form-label">ID Materia</label>
                            <input type="text" name="idMateria" class="form-control" id="idMateria"
                                value="{{ $materia->idMateria }}" aria-describedby="nombreHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombreMateria" class="form-label">Nombre de la Materia</label>
                            <input type="text" name="nombreMateria" class="form-control" id="nombreMateria"
                                value="{{ $materia->nombreMateria }}" aria-describedby="apellidoHelp" disabled>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('materias.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
