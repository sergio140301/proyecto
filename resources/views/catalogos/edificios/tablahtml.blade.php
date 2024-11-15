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
        <h1 class="custom-title">Motor de busqueda de Edificios</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('edificios.index') }}">
        <input class="form-control me-sm-2" type="text" name="txtBuscar" placeholder="Buscar edificio..." value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Buscar
        </button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de edificios!</h1>
    </div>

    <div class="text-responsive-md text-center">
        <a href="{{ route('edificios.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Edificio</th>
                    <th scope="col">Nombre Corto</th>
                    <th scope="col">Ver</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($edificios as $edificio)
                <tr>
                    <td scope="row">{{ $edificio->id }}</td>
                    <td>{{ $edificio->nombreedificio }}</td>
                    <td>{{ $edificio->nombrecorto }}</td>
                    
                    <td><a href="{{ route('edificios.show', $edificio->id) }}"> <img src="{{ asset('img/icono-ver.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('edificios.eliminar', $edificio->id) }}"> <img src="{{ asset('img/icono-delete.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('edificios.edit', $edificio->id) }}"> <img src="{{ asset('img/icono-editar.png') }}" width="50px"> </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $edificios->links() }}
    </div>
</div>