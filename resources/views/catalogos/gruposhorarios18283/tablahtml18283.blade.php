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

    <br>
    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('gruposhorarios18283.index') }}">
        <input
            class="form-control me-sm-2"
            type="text"
            name="txtBuscar"
            placeholder="Buscar Grupo Horario..."
            value="{{ request('txtBuscar') }}"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>

    <br>
    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de Grupos Horarios!</h1>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('gruposhorarios18283.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>
        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Lugar</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupohorario18283s as $grupohorario)
                    <tr>
                        <td scope="row">{{ $grupohorario->id }}</td>
                        <td>{{ $grupohorario->dia }}</td>
                        <td>{{ $grupohorario->hora }}</td>
                        <td>{{ $grupohorario->grupo18283->grupo ?? 'Sin Grupo'}}</td>
                        <td>{{ $grupohorario->lugar->nombrelugar ?? 'Sin Lugar'}}</td>

                        <td><a href="{{ route('gruposhorarios18283.show', $grupohorario->id) }}"><img src="{{ asset('img/icono-ver.png') }}" width="50px"></a></td>
                        <td><a href="{{ route('gruposhorarios18283.eliminar', $grupohorario->id) }}"><img src="{{ asset('img/icono-delete.png') }}" width="50px"></a></td>
                        <td><a href="{{ route('gruposhorarios18283.edit', $grupohorario->id) }}"><img src="{{ asset('img/icono-editar.png') }}" width="50px"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $grupohorario18283s->links() }}
    </div>
</div>