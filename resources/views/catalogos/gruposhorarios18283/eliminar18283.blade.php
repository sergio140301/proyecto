@extends('inicio2')

@section('contenido1')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">¿Estás seguro de que deseas eliminar el grupo?</h4>
                </div>

                <div class="card-body">
                    <p>Estás a punto de eliminar el grupo: <strong>{{ $grupo18283->nombregrupo }}</strong>.</p>
                    <form method="POST" action="{{ route('gruposhorarios18283.destroy', $grupo18283->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <a href="{{ route('gruposhorarios18283.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
