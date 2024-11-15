@extends('inicio2')

@section('esquema_apertura_materias')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col text-center">
                <h3>Apertura de Materias 2023</h3>
            </div>

            <div class="col">
                <div class="mb-3">
                    {{-- creamos un formulario dirigido a index --}}
                    {{-- {!!dd(request()->all())!!} --}}
                    {{ session('periodo_id') }}
               
                    {{ session('materia_id') }}
                    <form action="{{ route('materiasabiertas.index') }}" method="get">
                        <select name="idperiodo" id="idperiodo" onchange="this.form.submit()">
                            <option value="-1">Seleccione el periodo</option>
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id }}"
                                    @if ($periodo->id == session('periodo_id')) {{ 'selected' }} @endif>{{ $periodo->id }}
                                    {{ $periodo->periodo }}</option>
                            @endforeach

             

        <div class="row">
            <div class="col">
                <form action="{{ route('materiasabiertas.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="eliminar" id="eliminar" value="NOELIMINAR">
                    <button>Sem 1</button><br>
                    @if ($carrera->count() and session('periodo_id') != '-1')
                        @foreach ($carrera[0]->reticulas[0]->materias as $materia)
                            <input type="checkbox" name="m{{ $materia->id }}" value="{{ $materia->id }}"
                                onchange="enviar(this)" @if ($ma->firstWhere('materia_id', $materia['id'])) {{ 'checked' }} @endif>
                            {{ $materia->id }}
                            {{ $materia->nombrecorto
                             }}<br>
                        @endforeach
                    @endif
                </form>
            </div>
        </div>
        <script>
            function enviar(chbox) {
                if (!chbox.checked) {
                    document.getElementById('eliminar').value = chbox.value;
                }
                chbox.form.submit();
            }
        </script>


    </div>
@endsection
