@extends('inicio2')

@section('contenido2')
    @include('catalogos.plazas.tablahtml')
@endsection

@section('contenido4000')

    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Plaza</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos...
                    </div>
                    <form action="{{ route('plazas.destroy', $plaza->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="idplaza" class="form-label">ID Plaza</label>
                            <input type="text" name="idplaza" class="form-control" id="idplaza"
                                value="{{ $plaza->idplaza }}" aria-describedby="nombreHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombreplaza" class="form-label">Nombre de la Plaza</label>
                            <input type="text" name="nombreplaza" class="form-control" id="nombreplaza"
                                value="{{ $plaza->nombreplaza }}" aria-describedby="apellidoHelp" disabled>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('plazas.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
