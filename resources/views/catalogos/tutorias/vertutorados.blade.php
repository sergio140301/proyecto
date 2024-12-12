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

    <div class="container text-center mt-5">
        <h1 class="custom-title">Coordinación de Tutorías</h1>
    </div>

    <div class="row">
        <div class="col">
            <label for="periodo">Periodo:</label>
            <input type="text" class="form-control" id="periodo" value="{{ $periodos->periodo }}" readonly>
            <input type="hidden" class="form-control" name="idperiodo" value="{{ $periodos->id }}" readonly>
        </div>
        <div class="col">
            <label for="tutor" class="form-label">Tutor Asignado</label>
            <input type="hidden" class="form-control" name="idpersonal" value="{{ $tutorias->first()->id }}" readonly>
            <input type="text" id="tutor" class="form-control" value="{{ $tutorias->first()->nombres }} {{ $tutorias->first()->apellidom }} {{ $tutorias->first()->apellidop }}" readonly>
        </div>
    </div>


    <!-- Tabla de Tutorados -->
    <div class="container text-center mt-5">
        <h4 class="custom-title">Alumnos Tutorados</h4>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover table-primary">
            <thead>
                <tr>
                    <th scope="col">Num Control</th>
                    <th scope="col">Alumno</th>
                    <th scope="col">Semestre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tutorias as $tutoria)
                <tr>
                    <td>{{ $tutoria->noctrl }}</td>
                    <td>{{ $tutoria->nombre }} {{ $tutoria->alumno_apellidop }} {{ $tutoria->alumno_apellidom }}</td>
                    <td>{{ $tutoria->semestreAlumno }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
