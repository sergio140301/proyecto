@extends('inicio2')

@section('contenido1')
    @include('deptos/tablahtml')
@endsection

@section('contenido2')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Ver todos los Datos del Departamento</h4>
                </div>
                <div class="card-body">
                    <form method="get">
                        @csrf
                        <div class="mb-3">
                            <label for="idDepto" class="form-label">ID del Departamento</label>
                            <input type="text" name="idDepto" class="form-control" id="idDepto"
                            value="{{ $departamento->idDepto }}" aria-describedby="idDeptoHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombreDepto" class="form-label">Nombre del Departamento</label>
                            <input type="text" name="nombreDepto" class="form-control" id="nombreDepto"
                            value="{{ $departamento->nombreDepto }}" aria-describedby="nombreDeptoHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombreMediano" class="form-label">Nombre Mediano</label>
                            <input type="text" name="nombreMediano" class="form-control" id="nombreMediano"
                            value="{{ $departamento->nombreMediano }}" aria-describedby="nombreMedianoHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombreCorto" class="form-label">Nombre Corto</label>
                            <input type="text" name="nombreCorto" class="form-control" id="nombreCorto"
                            value="{{ $departamento->nombreCorto }}" aria-describedby="nombreCortoHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="created_at" class="form-label">Creado</label>
                            <input type="text" name="created_at" class="form-control" id="created_at"
                            value="{{ $departamento->created_at }}" aria-describedby="createdAtHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="updated_at" class="form-label">Actualizado</label>
                            <input type="text" name="updated_at" class="form-control" id="updated_at"
                            value="{{ $departamento->updated_at }}" aria-describedby="updatedAtHelp" disabled>
                        </div>

                        <a href="{{ route('deptos.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
