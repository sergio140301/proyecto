@extends("inicio2")

@section("contenido2")
<div class="row">
    <div class="col-10">
        <h3>Apertura de Materias</h3>
    </div>
    <div class="col-2">
        <!-- Es opcional mostrar, pero se muestra solo para verificar qué valores arroja en los select -->
        {{ session("periodo_id") }} <!-- ESTOS 2 SON LOS FILTROS POR LOS QUE SE BUSCAN LAS MATERIAS -->
        {{ session('carrera_id') }} <!-- Se guardan en session en el controlador -->

        <!-- Todo lo que sea filtro, se encapsula en un form, por eso los select de periodo y carrera van en un mismo form -->
        <form action="{{ route('materiasabiertas.index') }}" method="get">
            <!-- Redirecciona a misma ruta index y con method GET porque es consulta -->
            <select name="idperiodo" id="idperiodo" onchange="this.form.submit()"> <!-- onchange manda datos en automático -->
                <option value="-1">Seleccione el periodo</option>
                @foreach ($periodos as $periodo)
                <option value="{{ $periodo->id }}" @if($periodo->id == session('periodo_id')) selected @endif>
                    {{ $periodo->id }} {{ $periodo->periodo }}
                </option>
                @endforeach
            </select><br>

            <select name="idcarrera" id="idcarrera" onchange="this.form.submit()">
                <option value="-1">Seleccione la carrera</option>
                @foreach ($carreras as $carr)
                <option value="{{ $carr->id }}" @if($carr->id == session('carrera_id')) selected @endif>
                    {{ $carr->nombreCarrera }}
                </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="row">
    <div class="col">
        <form action="{{ route('materiasabiertas.store') }}" method="post">
            @csrf
            <input type="hidden" name="eliminar" id="eliminar" value="NOELIMINAR">
            <button type="submit">Sem 1</button><br>
            @if($carrera->count() && session('periodo_id') != "-1") <!-- Estos son los 2 filtros que se usan -->
                @foreach ($carrera[0]->reticulas[0]->materias as $materia) <!-- Caminito para llegar a materias de esa carrera -->
                <input type="checkbox" name="m{{ $materia->id }}" value="{{ $materia->id }}" 
                       onchange="enviar(this)"
                       @if ($ma->firstWhere('materia_id', $materia['id'])) checked @endif>
                <!-- Si ya existe ese id de materia, está abierta y el checkbox queda marcado -->
                {{ $materia->nombreMateria }}<br>
                @endforeach
            @endif
        </form>
    </div>
</div> 

{{-- hola --}}

<a href="{{ route('aperturagrupo') }}">
    <h1>ABRIR GRUPO</h1>
</a><br>

<script>
    function enviar(chbox) {
        if (!chbox.checked) { // Si el checkbox no está marcado
            document.getElementById('eliminar').value = chbox.value; // Actualiza valor del input oculto con el valor del checkbox
        }
        chbox.form.submit(); // Envía el formulario
    }
</script>
@endsection
