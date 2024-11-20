{{-- @extends("inicio2")

@section("contenido2")
<div class="row">
    <div class="col-10">
        <h3>Apertura de Materias</h3>
    </div>
    <div class="col-2">       
        {{session("periodo_id")}}
        {{session('carrera_id')}}
        
        <form action="{{route('materiasabiertas.index')}}" method="get">
            <select name="idperiodo" id="idperiodo" onchange="this.form.submit()">
                <option value="-1">Seleccione el periodo</option>
                @foreach ($periodos as $periodo )
                <option value="{{$periodo->id}}" @if($periodo->id == session('periodo_id'))
                    {{ "selected" }}
                    @endif
                    >{{$periodo->id}} {{ $periodo->periodo }}</option>
                @endforeach

            </select><br>
            <select name="idcarrera" id="idcarrera" onchange="this.form.submit()">
                <option value="-1">Seleccione la carrera</option>
                @foreach ($carreras as $carr )
                <option value="{{$carr->id}}" @if($carr->id == session('carrera_id'))
                    {{ "selected" }}
                    @endif
                    >{{$carr->nombreCarrera }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <form action="{{route('materiasabiertas.store')}}" method="post">
            @csrf
            <input type="hidden" name="eliminar" id="eliminar" value="NOELIMINAR">
            <button>Sem 1</button><br>
            @if($carrera->count() and session('periodo_id') != "-1")
            @foreach ( $carrera[0]->reticulas[0]->materias as $materia )
            <input type="checkbox" 
                    name="m{{$materia->id}}" 
                    value="{{$materia->id}}" 
                    onchange="enviar(this)"
                    @if ( $ma->firstWhere('materia_id',$materia['id']))
                        {{"checked"}}
                    @endif>
   
            {{$materia->nombreMateria}}<br>
            @endforeach
            @endif
        </form> 
    </div>
</div>


<a href="{{ route('aperturagrupo') }}">
    <h1>ABRIR GRUPO</h1>
</a><br>

<script>

    function enviar(chbox){
        if (!chbox.checked){
            document.getElementById('eliminar').value = chbox.value;
        }
        chbox.form.submit();    
        }
</script>
@endsection --}}










@extends("inicio2")

@section("contenido2")
<div class="row">
    <div class="col-10">
        <h3>Apertura de Materias</h3>
    </div>
    <div class="col-2">
        {{ session("periodo_id") }}
        {{ session('carrera_id') }}
        
        <form action="{{ route('materiasabiertas.index') }}" method="get">
            <select name="idperiodo" id="idperiodo" onchange="this.form.submit()">
                <option value="-1">Seleccione el periodo</option>
                @foreach ($periodos as $periodo)
                <option value="{{ $periodo->id }}" 
                        @if($periodo->id == session('periodo_id')) selected @endif>
                    {{ $periodo->id }} {{ $periodo->periodo }}
                </option>
                @endforeach
            </select><br>
            
            <select name="idcarrera" id="idcarrera" onchange="this.form.submit()">
                <option value="-1">Seleccione la carrera</option>
                @foreach ($carreras as $carr)
                <option value="{{ $carr->id }}" 
                        @if($carr->id == session('carrera_id')) selected @endif>
                    {{ $carr->nombreCarrera }}
                </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

@if($carrera->count() && session('periodo_id') != "-1")
<div class="row mt-3">
    @foreach(range(1, 9) as $semestre)
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Semestre {{ $semestre }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('materiasabiertas.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="eliminar" id="eliminar" value="NOELIMINAR">
                    
                    @php
                        $materiasPorSemestre = $carrera[0]->reticulas[0]->materias->where('semestre', $semestre);
                    @endphp
                    
                    @if($materiasPorSemestre->count())
                        @foreach ($materiasPorSemestre as $materia)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="m{{ $materia->id }}" 
                                   value="{{ $materia->id }}" 
                                   onchange="enviar(this)" 
                                   @if($ma->firstWhere('materia_id', $materia->id)) checked @endif>
                            <label class="form-check-label">
                                {{ $materia->nombreMateria }}
                            </label>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted">No hay materias disponibles para este semestre.</p>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

<a href="{{ route('aperturagrupo') }}">
    <h1>ABRIR GRUPO</h1>
</a><br>

<script>
    function enviar(chbox) {
        if (!chbox.checked) {
            document.getElementById('eliminar').value = chbox.value;
        }
        chbox.form.submit();    
    }
</script>
@endsection



