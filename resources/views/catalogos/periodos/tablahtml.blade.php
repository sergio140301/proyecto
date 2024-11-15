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
        <h1 class="custom-title">Motor de busqueda de periodos</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('periodos.index') }}">
        <input 
            class="form-control me-sm-2"  
            type="text" name="txtBuscar" 
            placeholder="Buscar periodo..."
            value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Buscar
        </button>
    </form>

    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de periodos!</h1>
    </div>

    <div class="text-responsive-md text-center">
        <a href="{{ route('periodos.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Periodo</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Descripción Corta</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Fin</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periodos as $periodo)
                    <tr>
                        <td scope="row">{{ $periodo->id }}</td>
                        <td>{{ $periodo->idPeriodo }}</td>
                        <td>{{ $periodo->periodo }}</td>
                        <td>{{ $periodo->desCorta }}</td>
                        <td>{{ $periodo->fechaIni }}</td>
                        <td>{{ $periodo->fechaFin }}</td>
                        
                        <td><a href="{{ route('periodos.show', $periodo->id) }}"> <img src="{{ asset('img/icono-ver.png') }}" width="50px"> </a></td>
                        <td><a href="{{ route('periodos.eliminar', $periodo->id) }}"> <img src="{{ asset('img/icono-delete.png') }}" width="50px"> </a></td>
                        <td><a href="{{ route('periodos.edit', $periodo->id) }}"> <img src="{{ asset('img/icono-editar.png') }}" width="50px"> </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $periodos->links() }}
    </div>
</div>
