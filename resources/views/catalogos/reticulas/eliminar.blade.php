@extends('inicio2')

@section('contenido2')
    @include('catalogos.reticulas.tablahtml')
@endsection

@section('contenido4000')

    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Retícula</h4>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <!-- Mensaje de advertencia -->
                        <div class="alert alert-danger" role="alert">
                            Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos...
                        </div>
                    <form action="{{ route('reticulas.destroy', $reticula->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" name="Descripcion" class="form-control" id="descripcion"
                            value="{{ $reticula->Descripcion }}" aria-describedby="descripcionHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="carrera_id" class="form-label">ID Carrera</label>
                            <input type="text" name="carrera_id" class="form-control" id="carrera_id"
                            value="{{ $reticula->carrera_id }}" aria-describedby="carreraHelp" disabled>
                            <div class="form-text"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-danger">Confirmar eliminación?</button>
                        <a href="{{ route('reticulas.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
