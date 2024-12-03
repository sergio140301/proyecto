@extends('inicio2')

@section('contenido2')
    @include('catalogos.gruposhorarios18283.index18283')
@endsection

@section('contenido4000')
    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Grupo H</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos relacionados con este Grupo Horario...
                    </div>
                    <form action="{{ route('gruposhorarios18283.destroy', $grupoHorario18283->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="dia" class="form-label">Dia</label>
                            <input type="text" name="dia" class="form-control" id="dia"
                                value="{{ $grupoHorario18283->dia }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="text" name="hora" class="form-control" id="hora"
                                value="{{ $grupoHorario18283->hora }}" disabled>
                        </div>
                       
                        <div class="mb-3">
                            <label for="grupo18283_id" class="form-label">Grupo</label>
                            <input type="text" name="grupo18283_id" class="form-control" id="grupo18283_id"
                                value="{{ $grupoHorario18283->grupo18283->grupo ?? 'Sin grupo asignado' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="lugar_id" class="form-label">Lugar</label>
                            <input type="text" name="lugar_id" class="form-control" id="lugar_id"
                                value="{{ $grupoHorario18283->lugar->nombrelugar ?? 'Sin lugar asignado' }}" disabled>
                        </div>

                        <button type="submit" class="btn btn-danger">Confirmar eliminación</button>
                        <a href="{{ route('gruposhorarios18283.index') }}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
