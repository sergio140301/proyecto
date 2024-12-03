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
        <h1 class="custom-title">Motor de búsqueda de Grupos</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('grupos18283.index') }}">
        <input
            class="form-control me-sm-2"
            type="text"
            name="txtBuscar"
            placeholder="Buscar Grupo..."
            value="{{ request('txtBuscar') }}"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de Grupos!</h1>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('grupos18283.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px" alt="Crear nuevo grupo">
        </a>
    </div>

    <table class="table table-primary mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Grupo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Máx. Alumnos</th>
                <th scope="col">Periodo</th>
                <th scope="col">Materia</th>
                <th scope="col">Docente</th>
                <th scope="col" colspan="3" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupo18283s as $grupo)
                <tr>
                    <td scope="row">{{ $grupo->id }}</td>
                    <td>{{ $grupo->grupo }}</td>
                    <td>{{ $grupo->descripcion }}</td>
                    <td>{{ $grupo->maxAlumnos }}</td>
                    <td>{{ $grupo->periodo->periodo ?? 'Sin Periodo' }}</td>
                    <td>{{ $grupo->materia->nombreMateria ?? 'Sin Materia' }}</td>
                    <td>{{ $grupo->personal->nombres ?? 'SIN NOMBRE' }} {{ $grupo->personal->apellidop ?? 'SIN APELLIDO' }} {{ $grupo->personal->apellidom ?? 'SIN APELLIDO' }}</td>
                    <td class="text-center">
                        <a href="{{ route('grupos18283.show', $grupo->id) }}">
                            <img src="{{ asset('img/icono-ver.png') }}" width="50px" alt="Ver grupo">
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('grupos18283.eliminar', $grupo->id) }}">
                            <img src="{{ asset('img/icono-delete.png') }}" width="50px" alt="Eliminar grupo">
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('grupos18283.edit', $grupo->id) }}">
                            <img src="{{ asset('img/icono-editar.png') }}" width="50px" alt="Editar grupo">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $grupo18283s->links() }}
    </div>
</div>