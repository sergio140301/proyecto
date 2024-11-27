@extends("inicio2")

@section("contenido2")
<div class="row">
    <div class="col-4 d-flex align-items-center">
        <h2>Apertura de Materias</h2>
    </div>

    <div class="col-4">
        <form action="{{ route('materiasabiertas.index') }}" method="get">
            <br>
            <select name="idperiodo" id="idperiodo" onchange="this.form.submit()" class="form-select mb-2">
                <option value="-1">Seleccione el periodo</option>
                @foreach ($periodos as $periodo)
                <option value="{{ $periodo->id }}" @if($periodo->id == session('periodo_id')) selected @endif>
                    {{ $periodo->periodo }}
                </option>
                @endforeach
            </select>

            <select name="idcarrera" id="idcarrera" onchange="this.form.submit()" class="form-select">
                <option value="-1">Seleccione la carrera</option>
                @foreach ($carreras as $carr)
                <option value="{{ $carr->id }}" @if($carr->id == session('carrera_id')) selected @endif>
                    {{ $carr->nombreCarrera }}
                </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="col-4 d-flex align-items-center justify-content-end">
        <a href="{{ route('aperturagrupo') }}" class="btn btn-success">
            <h5>ABRIR GRUPO</h5>
        </a>
    </div>
</div>

<hr />

<div class="row">
    <form action="{{ route('materiasabiertas.store') }}" method="post">
        @csrf
        <input type="hidden" name="eliminar" id="eliminar" value="NOELIMINAR">

        @if($carrera->count() && session('periodo_id') != "-1")
        @foreach ($carrera[0]->reticulas[0]->materias->groupBy('semestre') as $semestre => $materias)
        @if($loop->index % 3 == 0)
        <div class="row mb-3">
            @endif
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header text-center bg-primary">
                        <h5 class="text-white fw-bold">Semestre {{ $semestre }}</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($materias as $materia)
                        <div class="form-check">
                            <input
                                type="checkbox"
                                name="m{{ $materia->id }}"
                                value="{{ $materia->id }}"
                                class="form-check-input"
                                id="materia_{{ $materia->id }}"
                                onchange="enviar(this)"
                                @if ($ma->firstWhere('materia_id', $materia['id'])) checked @endif>
                            <label class="form-check-label" for="materia_{{ $materia->id }}">
                                {{ $materia->nombreMateria }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if($loop->iteration % 3 == 0 || $loop->last)
        </div>
        @endif
        @endforeach
        @endif
    </form>

</div>



<script>
    function enviar(chbox) {
        if (!chbox.checked) {
            document.getElementById('eliminar').value = chbox.value;
        }
        chbox.form.submit();
    }
</script>
@endsection