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
        <h1 class="custom-title">Motor de busqueda de horas</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('horas.index') }}">
        <input class="form-control me-sm-2" type="text" name="txtBuscar" placeholder="Buscar hora..." value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Buscar
        </button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de horas!</h1>
    </div>

    <div class="text-responsive-md text-center">
        <a href="{{ route('horas.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hora Inicio</th>
                    <th scope="col">Hora Fin</th>

                    <th scope="col">Ver</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($horas as $hora)
                <tr>
                    <td scope="row">{{ $hora->id }}</td>
                    <td>{{ $hora->hora_ini }}</td>
                    <td>{{ $hora->hora_fin }}</td>

                    <td><a href="{{ route('horas.show', $hora->id) }}"> <img src="{{ asset('img/icono-ver.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('horas.eliminar', $hora->id) }}"> <img src="{{ asset('img/icono-delete.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('horas.edit', $hora->id) }}"> <img src="{{ asset('img/icono-editar.png') }}" width="50px"> </a></td>                  
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $horas->links() }}
    </div>
</div>