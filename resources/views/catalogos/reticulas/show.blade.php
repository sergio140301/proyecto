@extends('inicio2')

@section('contenido1')
    @include('catalogos.reticulas.tablahtml')
@endsection

@section('contenido2')
<div class="card-header">
    <h4 class="mb-0">Ver todos los Datos de la Retícula</h4>
</div>
    <form method="get">
        @csrf
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" value="{{ $reticula->descripcion }}" name="descripcion" class="form-control" id="" aria-describedby="Descripcion" disabled>
            <div id="" class="form-text">Descripción de la retícula</div>
        </div>
        <div class="mb-3">
            <label for="carrera_id" class="form-label">ID Carrera</label>
            <input type="text" value="{{ $reticula->carrera_id }}" name="carrera_id" class="form-control" id="" aria-describedby="Carrera" disabled>
            <div id="" class="form-text">ID de la carrera asociada</div>
        </div>
        <a href="{{ route('reticulas.index') }}" class="btn btn-primary">Regresar</a>
    </form>
@endsection
