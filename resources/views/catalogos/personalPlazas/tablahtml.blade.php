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
        <h1 class="custom-title">Motor de búsqueda de Personal Plazas</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('personalplazas.index') }}">
        <input
            class="form-control me-sm-2"
            type="text"
            name="txtBuscar"
            placeholder="Buscar Personal Plaza..."
            value="{{ request('txtBuscar') }}"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de Personal Plazas!</h1>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('personalplazas.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>
        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipo de Nombramiento</th>
                    <th scope="col">Nombre del Personal</th>
                    <th scope="col">Plaza</th>
                    <th scope="col">Creado</th>
                    <th scope="col">Actualizado</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personalplazas as $personalplaza)
                    <tr>
                        <td scope="row">{{ $personalplaza->id }}</td>
                        <td>{{ $personalplaza->tipoNombramiento }}</td>
                        <td>{{ $personalplaza->personal->nombres ?? 'Sin Personal' }}</td>
                        <td>{{ $personalplaza->plaza->nombreplaza ?? 'Sin Plaza' }}</td>
                        <td>{{ $personalplaza->created_at }}</td>
                        <td>{{ $personalplaza->updated_at }}</td>
                        <td><a href="{{ route('personalplazas.show', $personalplaza->id) }}"><img src="{{ asset('img/icono-ver.png') }}" width="50px"></a></td>
                        <td><a href="{{ route('personalplazas.eliminar', $personalplaza->id) }}"><img src="{{ asset('img/icono-delete.png') }}" width="50px"></a></td>
                        <td><a href="{{ route('personalplazas.edit', $personalplaza->id) }}"><img src="{{ asset('img/icono-editar.png') }}" width="50px"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $personalplazas->links() }}
    </div>
</div>
