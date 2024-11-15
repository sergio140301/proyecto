@extends('inicio2')

@section('contenido1')
    @include('catalogos/carreras/tablahtml')
@endsection

@section('contenido4000')

    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Carrera</h4>
                </div>
                <div class="card-body">
                    <!-- Mensaje de advertencia -->
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos de la carrera...
                    </div>
                    <form action="{{ route('carreras.destroy', $carrera->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="idCarrera" class="form-label">ID de la Carrera</label>
                            <input type="text" name="idCarrera" class="form-control" id="idCarrera"
                            value="{{ $carrera->idCarrera }}" aria-describedby="idCarreraHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nombreCarrera" class="form-label">Nombre de la Carrera</label>
                            <input type="text" name="nombreCarrera" class="form-control" id="nombreCarrera"
                            value="{{ $carrera->nombreCarrera }}" aria-describedby="nombreCarreraHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nombreMediano" class="form-label">Nombre Mediano</label>
                            <input type="text" name="nombreMediano" class="form-control" id="nombreMediano"
                            value="{{ $carrera->nombreMediano }}" aria-describedby="nombreMedianoHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nombreCorto" class="form-label">Nombre Corto</label>
                            <input type="text" name="nombreCorto" class="form-control" id="nombreCorto"
                            value="{{ $carrera->nombreCorto }}" aria-describedby="nombreCortoHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('carreras.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
