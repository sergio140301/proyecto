@extends('inicio2')

@section('contenido2')
    @include('catalogos.personalplazas.index') 
@endsection

@section('contenido4000')
    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Personal Plaza</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos relacionados con este Personal Plaza...
                    </div>
                    <form action="{{ route('personalplazas.destroy', $personalplaza->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="tipoNombramiento" class="form-label">Tipo de Nombramiento</label>
                            <input type="text" name="tipoNombramiento" class="form-control" id="tipoNombramiento"
                                value="{{ $personalplaza->tipoNombramiento }}" aria-describedby="tipoNombramientoHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="personal" class="form-label">Personal</label>
                            <input type="text" name="personal" class="form-control" id="personal"
                                value="{{ $personalplaza->personal->nombre ?? 'Sin Personal asignado' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="plaza" class="form-label">Plaza</label>
                            <input type="text" name="plaza" class="form-control" id="plaza"
                                value="{{ $personalplaza->plaza->nombre ?? 'Sin Plaza asignada' }}" disabled>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('personalplazas.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
