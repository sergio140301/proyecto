@extends('inicio2')

@section('contenido2')
    @include('catalogos.horas.index') 
@endsection

@section('contenido4000')
    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Hora</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos relacionados con esta hora...
                    </div>
                    <form action="{{ route('horas.destroy', $hora->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="hora_ini" class="form-label">Hora de Inicio</label>
                            <input type="text" name="hora_ini" class="form-control" id="hora_ini"
                                value="{{ $hora->hora_ini }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="hora_fin" class="form-label">Hora de Fin</label>
                            <input type="text" name="hora_fin" class="form-control" id="hora_fin"
                                value="{{ $hora->hora_fin }}" disabled>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('horas.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
