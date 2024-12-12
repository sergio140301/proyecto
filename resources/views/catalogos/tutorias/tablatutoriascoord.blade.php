@extends('inicio2')

@section('contenido2')

<style>
    .custom-title {
        color: #343a40;
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .table-primary thead th {
        text-align: center;
        vertical-align: middle;
    }

    .table-primary tbody td {
        text-align: center;
    }
</style>

<div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container text-center mt-5">
        <h1 class="custom-title">Coordinación de Tutorías</h1>
    </div>

    <!-- Botón para agregar nuevo período -->
    <div class="text-center mt-3">
        <a href="{{ route('tutorias.create') }}">
            <img src="{{ asset('img/icono-nuevo.png') }}" width="50px" alt="Agregar nueva tutoria">
        </a>
    </div>

    <!-- Tabla de Períodos -->
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Tutor</th>
                    <th scope="col">Ver Tutorados</th>
                    <th scope="col">Descargar Reporte</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tutorias as $tutoria)
                    <tr>
                        <td>{{ $tutoria->id }}</td>
                        <td>{{ $tutoria->periodo }}</td>
                        <td>{{ $tutoria->nombres }} {{ $tutoria->apellidop }} {{ $tutoria->apellidom }}</td>
                        <td>
                            <a href="{{ route('tutorias.show', ['iddocente' => $tutoria->id, 'periodo' => $tutoria->periodo]) }}">
                                <img src="{{ asset('img/icono-ver.png') }}" width="50px" alt="Ver tutorados">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('tutorias.reporte', ['iddocente' => $tutoria->id, 'periodo' => $tutoria->periodo]) }}">
                                <img src="{{ asset('img/downloading.png') }}" width="50px" alt="Descargar Reporte">
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
