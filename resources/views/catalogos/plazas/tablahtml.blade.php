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
        <h1 class="custom-title">Motor de búsqueda de plazas</h1>
    </div>

    <form class="d-flex my-2 my-lg-0" method="GET" action="{{ route('plazas.index') }}">
        <input class="form-control me-sm-2" type="text" name="txtBuscar" placeholder="Buscar plaza..."
            value="{{ request('txtBuscar') }}" />

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Buscar
        </button>
    </form>


    <div class="text-center mt-3">
        <h1 class="custom-title">¡Bienvenido a la página de plazas!</h1>
    </div>


    <div class="table-responsive-md text-center">
        <a href="{{ route('plazas.create') }}">
            <img src=" {{ asset('img\icono-nuevo.png') }}" width="50px">
        </a>

        <table class="table table-primary mt-3">
            <thead>
                <tr>
                    <th scope="col"># Plaza</th>
                    <th scope="col">ID Plaza</th>
                    <th scope="col">Nombre Plaza</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($plazas as $plaza)
                    <tr class="">
                        <td scope="row">{{ $plaza->id }}</td>
                        <td scope="row">{{ $plaza->idplaza }}</td>
                        <td>{{ $plaza->nombreplaza }}</td>

                        <td><a href=" {{ route('plazas.show', $plaza->id) }}"> <img src=" {{ asset('img\icono-ver.png') }}" width="50px"> </a></td>
                        <td><a href="{{ route('plazas.eliminar', $plaza->id) }}"> <img src=" {{ asset('img\icono-delete.png') }}" width="50px"> </a></td>
                        <td><a href="{{ route('plazas.edit', $plaza->id) }}"> <img src=" {{ asset('img\icono-editar.png') }}" width="50px"> </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $plazas->links() }}
    </div>
</div>
