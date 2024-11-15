
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
        <h1 class="custom-title">Motor de busqueda de Carreras</h1>
    </div>
    
    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('carreras.index') }}">
        <input
            class="form-control me-sm-2"
            type="text"
            name="txtBuscar"  
            placeholder="Buscar carrera......"
            value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
        </button>
    </form>
    

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de carreras!</h1>
    </div>
    
    <div class="text-center mt-3">
    <a href="{{ route('carreras.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">ID Carrera</th>
                    <th scope="col">Nombre Carrera</th>
                    <th scope="col">Nombre Mediano</th>
                    <th scope="col">Nombre Corto</th>
                    <th scope="col">Departamento</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carreras as $carrera)
                    <tr>
                        <td scope="row">{{ $carrera->idCarrera }}</td>
                        <td>{{ $carrera->nombreCarrera }}</td>
                        <td>{{ $carrera->nombreMediano }}</td>
                        <td>{{ $carrera->nombreCorto }}</td>
                        <td>{{ $carrera->depto->nombreDepto ?? 'Sin Departamento' }}</td>
                        
                        <td><a href="{{ route('carreras.show', $carrera->id) }}"><img src="{{ asset('img/icono-ver.png') }}" width="50px"></a></td>
                        <td><a href="{{ route('carreras.eliminar', $carrera->id) }}"><img src="{{ asset('img/icono-delete.png') }}" width="50px"></a></td>
                        <td><a href="{{ route('carreras.edit', $carrera->id) }}"><img src="{{ asset('img/icono-editar.png') }}" width="50px"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $carreras->links() }}
    </div>
</div>

