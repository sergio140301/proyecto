@extends('inicio2')

@section('contenido2')
    @include('catalogos.lugares.index') 
@endsection

@section('contenido4000')
    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Lugar</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos relacionados con este lugar...
                    </div>
                    <form action="{{ route('lugares.destroy', $lugar->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="nombrelugar" class="form-label">Nombre del Lugar</label>
                            <input type="text" name="nombrelugar" class="form-control" id="nombrelugar"
                                value="{{ $lugar->nombrelugar }}" aria-describedby="nombreHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombrecorto" class="form-label">Nombre Corto</label>
                            <input type="text" name="nombrecorto" class="form-control" id="nombrecorto"
                                value="{{ $lugar->nombrecorto }}" aria-describedby="nombreCortoHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="edificio" class="form-label">Edificio Asociado</label>
                            <input type="text" name="edificio" class="form-control" id="edificio"
                                value="{{ $lugar->edificio->nombreedificio ?? 'Sin edificio asignado' }}" disabled>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('lugares.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
