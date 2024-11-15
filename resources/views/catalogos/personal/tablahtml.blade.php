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
        <h1 class="custom-title">Motor de busqueda de personal</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('personal.index') }}">
        <input
            class="form-control me-sm-2"
            type="text"
            name="txtBuscar"
            placeholder="Buscar personal......"
            value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
        </button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de personal!</h1>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('personal.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">RFC</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Licenciatura</th>
                    <th scope="col">Especialización</th>
                    <th scope="col">Maestría</th>
                    <th scope="col">Doctorado</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Departamento</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($personals as $personal)
                <tr>
                    <td scope="row">{{ $personal->noTrabajador }}</td>
                    <td>{{ $personal->rfc }}</td>
                    <td>{{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}</td>
                    <td>{{ $personal->licenciatura }}</td>
                    <td>{{ $personal->especializacion }}</td>
                    <td>{{ $personal->maestria }}</td>
                    <td>{{ $personal->doctorado }}</td>
                    <td>{{ $personal->fechaIngSep }}</td>
                    <td>{{ $personal->puesto->nombrepuesto }}</td>
                    <td>{{ $personal->depto->nombreDepto }}</td>

                    <td><a href="{{ route('personal.show', $personal->id) }}"><img src="{{ asset('img/icono-ver.png') }}" width="50px"></a></td>
                    <td><a href="{{ route('personal.eliminar', $personal->id) }}"><img src="{{ asset('img/icono-delete.png') }}" width="50px"></a></td>
                    <td><a href="{{ route('personal.edit', $personal->id) }}"><img src="{{ asset('img/icono-editar.png') }}" width="50px"></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $personals->links() }}
    </div>
</div>