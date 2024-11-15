@extends('inicio2')

@section('contenido2')
    @include('catalogos.edificios.index') 
@endsection

@section('contenido4000')

    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Edificio</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos relacionados con este edificio...
                    </div>
                    <form action="{{ route('edificios.destroy', $edificio->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="nombreedificio" class="form-label">Nombre del Edificio</label>
                            <input type="text" name="nombreedificio" class="form-control" id="nombreedificio"
                                value="{{ $edificio->nombreedificio }}" aria-describedby="nombreHelp" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="nombrecorto" class="form-label">Nombre Corto</label>
                            <input type="text" name="nombrecorto" class="form-control" id="nombrecorto"
                                value="{{ $edificio->nombrecorto }}" aria-describedby="apellidoHelp" disabled>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('edificios.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
