@extends('inicio2')

@section('contenido1')
    @include('plazas.tablahtml')
@endsection

@section('contenido2')
<div class="card-header">
    <h4 class="mb-0">Ver todos los Datos de la Plaza</h4>
</div>
    <form method="get">
        @csrf
        <div class="mb-3">
            <label for="idplaza" class="form-label">Nombre Plaza</label>
            <input type="text" value="{{$plaza->idplaza}}" name="idplaza" class="form-control" id="" aria-describedby="Nombre" disabled>
            <div id="" class="form-text">id del la plaza</div>
        </div>
        <div class="mb-3">
            <label for="nombreplaza" class="form-label">Nombre Plaza</label>
            <input type="text" value="{{$plaza->nombreplaza}}" name="nombreplaza" class="form-control" id="" aria-describedby="Nombre" disabled>
            <div id="" class="form-text">nombre del la plaza</div>
        </div>
        <div class="mb-3">
            <label for="nombreplaza" class="form-label">Nombre Plaza</label>
            <input type="text" value="{{$plaza->created_at}}" name="nombreplaza" class="form-control" id="" aria-describedby="Nombre" disabled>
            <div id="" class="form-text">creado</div>
        </div>
        <div class="mb-3">
            <label for="nombreplaza" class="form-label">Nombre Plaza</label>
            <input type="text" value="{{$plaza->updated_at}}" name="nombreplaza" class="form-control" id="" aria-describedby="Nombre" disabled>
            <div id="" class="form-text">actualizado</div>
        </div>

        <a href="{{ route('plazas.index')}}" class="btn btn-primary">Regresar</a>
    </form>
@endsection

