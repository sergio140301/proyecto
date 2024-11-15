@extends('inicio2')

@section('contenido4000')
<div class="row justify-content-center bg-danger-40">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 text-danger">Eliminar Periodo</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos...
                </div>
                <form action="{{ route('periodos.destroy', $periodo->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label for="idPeriodo" class="form-label">ID Periodo</label>
                        <input type="text" name="idPeriodo" class="form-control" id="idPeriodo"
                               value="{{ $periodo->idPeriodo }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="periodo" class="form-label">Periodo</label>
                        <input type="text" name="periodo" class="form-control" id="periodo"
                               value="{{ $periodo->periodo }}" disabled>
                    </div>

                    <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                    <a href="{{ route('periodos.index') }}" class="btn btn-primary">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
