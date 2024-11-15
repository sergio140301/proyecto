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
        <h1 class="custom-title">Motor de busqueda de lugares</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('lugares.index') }}">
        <input class="form-control me-sm-2" type="text" name="txtBuscar" placeholder="Buscar lugar......" value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
        </button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de lugares!</h1>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('lugares.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Lugar</th>
                    <th scope="col">Nombre Corto</th>
                    <th scope="col">Edificio</th>
                    <th scope="col">Ver</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($lugares as $lugar)
                <tr>
                    <td scope="row">{{ $lugar->id }}</td>
                    <td>{{ $lugar->nombrelugar }}</td>
                    <td>{{ $lugar->nombrecorto }}</td>
                    <td>{{ $lugar->edificio ? $lugar->edificio->nombreedificio : 'Sin Edificio' }}</td>

                    <td><a href="{{ route('lugares.show', $lugar->id) }}"><img src="{{ asset('img/icono-ver.png') }}" width="50px"></a></td>
                    <td><a href="{{ route('lugares.eliminar', $lugar->id) }}"><img src="{{ asset('img/icono-delete.png') }}" width="50px"></a></td>
                    <td><a href="{{ route('lugares.edit', $lugar->id) }}"><img src="{{ asset('img/icono-editar.png') }}" width="50px"></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $lugares->links() }}
    </div>
</div>