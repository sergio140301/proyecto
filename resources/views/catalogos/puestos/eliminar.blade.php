@extends('inicio2')

@section('contenido2')
    @include('catalogos.puestos.tablahtml')
@endsection

@section('contenido4000')

    <div class="row justify-content-center bg-danger-40">
        <div class="col-md-8 col-lg-6">
            <div class="card" >
                <div class="card-header">
                    <h4 class="mb-0 text-danger">Eliminar Puesto</h4>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <!-- Mensaje de advertencia -->
                        <div class="alert alert-danger" role="alert">
                            Esta acción es irreparable. Toma en cuenta que se borrarán todos los datos...
                        </div>
                    <form action="{{ route('puestos.destroy', $puesto->id)  }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3 ">
                            <label for="nombrepuesto" class="form-label ">Nombre Puesto</label>
                            <input type="text" name="nombrepuesto" class="form-control" id="nombre"
                            value="{{$puesto->nombrepuesto}}" aria-describedby="nombreHelp" disabled>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">tipo puesto</label>
                            <input type="text" name="tipo" class="form-control" id="apellido"
                            value="{{$puesto->tipo}}"   aria-describedby="apellidoHelp" disabled>
                            <div class="form-text"></div>
                        </div>
                        <button type="submit" class="btn btn-danger">confirmar eliminacion?</button>
                        <a href="{{ ('puestos.index')}}" class="btn btn-primary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
