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
        <h1 class="custom-title">Motor de busqueda de puestos</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('puestos.index') }}">
        <input class="form-control me-sm-2" type="text" name="txtBuscar" placeholder="Buscar puesto..."
            value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Buscar
        </button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de puestos!</h1>
    </div>

    <div class="text-responsive-md text-center">
        <a href="{{ route('puestos.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre Puesto</th>
                    <th scope="col">tipo</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($puestos as $puesto)
                    <tr>
                        <td scope="row">{{ $puesto->id }}</td>
                        <td>{{ $puesto->idpuesto }}</td>
                        <td>{{ $puesto->nombrepuesto }}</td>
                        <td>{{ $puesto->tipo }}</td>

                        <td><a href="{{ route('puestos.show', $puesto->id) }}"> <img
                                    src="{{ asset('img/icono-ver.png') }}" width="50px"> </a></td>
                        <td><a href="{{ route('puestos.eliminar', $puesto->id) }}"> <img
                                    src="{{ asset('img/icono-delete.png') }}" width="50px"> </a></td>
                        <td><a href="{{ route('puestos.edit', $puesto->id) }}"> <img
                                    src="{{ asset('img/icono-editar.png') }}" width="50px"> </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $puestos->links() }}
    </div>
</div>
