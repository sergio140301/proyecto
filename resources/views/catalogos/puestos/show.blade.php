@extends('inicio2')

@section('contenido1')
    @include('puestos.tablahtml')
@endsection

@section('contenido2')
<div class="card-header">
    <h4 class="mb-0">Ver todos los Datos del Puesto</h4>
</div>
    <form method="get">
        @csrf
        <div class="mb-3">
            <label for="nombrepuesto" class="form-label">Nombre Puesto</label>
            <input type="text" value="{{$puesto->nombrepuesto}}" name="nombrepuesto" class="form-control" id="" aria-describedby="Nombre" disabled>
            <div id="" class="form-text">nombre del puesto</div>
        </div>
        <div class="mb-3">
            <select class="form-select" name="selecciona" aria-label="Default select example" disabled>
                <option selected >{{$puesto->tipo}}</option>
                <option></option>
            </select>
        </div>
        <a href="{{ route('puestos.index')}}" class="btn btn-primary">Regresar</a>
    </form>
@endsection

