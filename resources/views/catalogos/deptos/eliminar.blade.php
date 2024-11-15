@extends('inicio2')

@section('contenido1')
    @include('catalogos/deptos/tablahtml')
@endsection

@section('contenido4000')

    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Departamento</h4>
                </div>
                <div class="card-body">
                    <!-- Mensaje de advertencia -->
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos del departamento...
                    </div>
                    <form action="{{ route('deptos.destroy', $depto->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="idDepto" class="form-label">ID del Departamento</label>
                            <input type="text" name="idDepto" class="form-control" id="idDepto"
                            value="{{ $depto->idDepto }}" aria-describedby="idDeptoHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nombreDepto" class="form-label">Nombre del Departamento</label>
                            <input type="text" name="nombreDepto" class="form-control" id="nombreDepto"
                            value="{{ $depto->nombreDepto }}" aria-describedby="nombreDeptoHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nombreMediano" class="form-label">Nombre Mediano</label>
                            <input type="text" name="nombreMediano" class="form-control" id="nombreMediano"
                            value="{{ $depto->nombreMediano }}" aria-describedby="nombreMedianoHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="nombreCorto" class="form-label">Nombre Corto</label>
                            <input type="text" name="nombreCorto" class="form-control" id="nombreCorto"
                            value="{{ $depto->nombreCorto }}" aria-describedby="nombreCortoHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('deptos.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
