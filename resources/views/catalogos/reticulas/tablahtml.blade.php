<style>
    .custom-title {
        color: #343a40;
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
</style>

<div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container text-center mt-5">
        <h1 class="custom-title">Motor de busqueda de reticulas</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('reticulas.index') }}">
        <input class="form-control me-sm-2" type="text" name="txtBuscar" placeholder="Buscar reticula......" value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
        </button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de reticulas!</h1>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('reticulas.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">ID Retícula</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Nombre de la Carrera</th>
                    <th scope="col">Fecha en Vigor</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reticulas as $reticula)
                <tr>
                    <td scope="row">{{ $reticula->idReticula }}</td>
                    <td>{{ $reticula->Descripcion }}</td>
                    <td>{{ $reticula->carrera->nombreCarrera ?? 'Sin Carrera'}}</td>
                    <td>{{ $reticula->fechaEnVigor}}</td>
 
                    <td><a href="{{ route('reticulas.show', $reticula->id) }}"> <img src="{{ asset('img/icono-ver.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('reticulas.eliminar', $reticula->id) }}"> <img src="{{ asset('img/icono-delete.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('reticulas.edit', $reticula->id) }}"> <img src="{{ asset('img/icono-editar.png') }}" width="50px"> </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reticulas->links() }}
    </div>
</div>