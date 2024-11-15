@extends('inicio2')

@section('contenido1')
    @include('catalogos.periodos.tablahtml') 
@endsection

@section('contenido2')
<div class="card-header">
    <h4 class="mb-0">Ver todos los Datos del Periodo</h4>
</div>
    <form method="get">
        @csrf
        <div class="mb-3">
            <label for="idPeriodo" class="form-label">ID Periodo</label>
            <input type="text" value="{{ $periodo->idPeriodo }}" name="idPeriodo" class="form-control" id="idPeriodo" aria-describedby="idPeriodo" disabled>
            <div id="" class="form-text">ID del periodo</div>
        </div>
        <div class="mb-3">
            <label for="periodo" class="form-label">Nombre del Periodo</label>
            <input type="text" value="{{ $periodo->periodo }}" name="periodo" class="form-control" id="periodo" aria-describedby="periodo" disabled>
            <div id="" class="form-text">Nombre del periodo</div>
        </div>
        <div class="mb-3">
            <label for="desCorta" class="form-label">Descripción Corta</label>
            <input type="text" value="{{ $periodo->desCorta }}" name="desCorta" class="form-control" id="desCorta" aria-describedby="desCorta" disabled>
            <div id="" class="form-text">Descripción corta del periodo</div>
        </div>
        <div class="mb-3">
            <label for="fechaIni" class="form-label">Fecha Inicio</label>
            <input type="date" value="{{ $periodo->fechaIni }}" name="fechaIni" class="form-control" id="fechaIni" aria-describedby="fechaIni" disabled>
            <div id="" class="form-text">Fecha de inicio del periodo</div>
        </div>
        <div class="mb-3">
            <label for="fechaFin" class="form-label">Fecha Fin</label>
            <input type="date" value="{{ $periodo->fechaFin }}" name="fechaFin" class="form-control" id="fechaFin" aria-describedby="fechaFin" disabled>
            <div id="" class="form-text">Fecha de fin del periodo</div>
        </div>

        <a href="{{ route('periodos.index') }}" class="btn btn-primary">Regresar</a>
    </form>
@endsection
