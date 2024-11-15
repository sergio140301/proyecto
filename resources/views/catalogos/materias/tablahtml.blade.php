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
        <h1 class="custom-title">Motor de busqueda de materias</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('materias.index') }}">
        <input class="form-control me-sm-2" type="text" name="txtBuscar" placeholder="Buscar materia......" value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
        </button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de materias!</h1>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('materias.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Materia</th>
                    <th scope="col">Semestre</th>
                    <th scope="col">Nombre Materia</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Nombre Mediano</th>
                    <th scope="col">Nombre Corto</th>
                    <th scope="col">Modalidad</th>
                    <th scope="col">Carrera</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($materias as $materia)
                <tr>
                    <td scope="row">{{ $materia->id }}</td>
                    <td>{{ $materia->idMateria }}</td>
                    <td>{{ $materia->semestre }}</td>
                    <td>{{ $materia->nombreMateria }}</td>
                    <td>{{ $materia->nivel }}</td>
                    <td>{{ $materia->nombreMediano }}</td>
                    <td>{{ $materia->nombreCorto }}</td>
                    <td>{{ $materia->modalidad }}</td>
                    <td>{{ $materia->reticula->carrera->nombreCarrera }}</td>

                    <td><a href="{{ route('materias.show', $materia->id) }}"> <img src="{{ asset('img/icono-ver.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('materias.eliminar', $materia->id) }}"> <img src="{{ asset('img/icono-delete.png') }}" width="50px"> </a></td>
                    <td><a href="{{ route('materias.edit', $materia->id) }}"> <img src="{{ asset('img/icono-editar.png') }}" width="50px"> </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $materias->links() }}
    </div>
</div>