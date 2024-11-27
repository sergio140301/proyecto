@extends('inicio2')

@section('contenido1')
    @include('catalogos.grupos18283.tablahtml18283') 
@endsection

@section('contenido4000')
<div class="row justify-content-center bg-danger-40">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 text-danger">Eliminar Grupo</h4>
            </div>
            <div class="card-body">
                <!-- Mensaje de advertencia -->
                <div class="alert alert-danger" role="alert">
                    Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos del grupo...
                </div>
                <form action="{{ route('grupos18283.destroy', $grupo18283->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    
                    <div class="mb-3">
                        <label for="grupo" class="form-label">Grupo</label>
                        <input type="text" name="grupo" class="form-control" id="grupo"
                            value="{{ $grupo18283->grupo }}" aria-describedby="grupoHelp" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" id="descripcion"
                            value="{{ $grupo18283->descripcion }}" aria-describedby="descripcionHelp" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="maxAlumnos" class="form-label">Max Alumnos</label>
                        <input type="text" name="maxAlumnos" class="form-control" id="maxAlumnos"
                            value="{{ $grupo18283->maxAlumnos }}" aria-describedby="maxAlumnosHelp" disabled>
                    </div>

                    <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                    <a href="{{ route('grupos18283.index') }}" class="btn btn-primary">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection