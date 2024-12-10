<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario Alumno</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .container {
            max-width: 100%;
            margin: 20px auto;
            padding: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            font-size: 20px;
            text-transform: uppercase;
            color: #003366;
        }
        header h2 {
            font-size: 18px;
            color: orange;
        }
        .table, .horario-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .table th, .table td, .horario-table th, .horario-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .table th, .horario-table th {
            background-color: #003366;
            color: #fff;
        }
        .total-creditos {
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Instituto Tecnológico de Piedras Negras</h1>
            <h2>Horario Alumno</h2>
        </header>
        <!-- Tabla de Información Básica -->
        <table class="table">
            <thead>
                <tr>
                    <th>No. Control TecNM</th>
                    <th>Nombre del Alumno</th>
                    <th>Semestre</th>
                    <th>Periodo Escolar</th>
                    <th>Prom. Acum.</th>
                </tr>
            </thead>
            <tbody>
                @php
        // Obtener el primer grupo y su período asociado
        $periodoEscolar = $grupoHorarios->first()->grupo->periodo ?? null;
    @endphp
                <tr>
                    <td>{{ $alumnoAuth->noctrl }}</td>
                    <td>{{ $alumnoAuth->nombre }} {{ $alumnoAuth->apellidop }} {{ $alumnoAuth->apellidom }}</td>
                    <td>{{ $alumnoAuth->semestre }}</td>
                    <td>{{ $periodoEscolar ?  $periodoEscolar->periodo  : 'Sin período' }}</td>
                    <td>---</td>
                </tr>
            </tbody>
        </table>
 
        <!-- Tabla de Carrera y Especialidad -->
        <table class="table">
            <thead>
                <tr>
                    <th>Carrera</th>
                    <th>Especialidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $alumnoAuth->carrera->nombrecarrera }}</td>
                    <td>DESARROLLO DE APLICACIONES</td>
                </tr>
            </tbody>
        </table>
 
     <!-- Tabla de Horarios -->
<table class="horario-table">
    <thead>
        <tr>
            <th>Materia</th>
            <th>Gpo</th>
            <th>Cr</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
        </tr>
    </thead>
    <tbody>
        <!-- Agrupación por Grupo -->
        @foreach ($grupoHorarios->groupBy('grupo_id') as $grupoId => $horarios)
            @php
                $firstHorario = $horarios->first(); // Usar el primer horario para datos generales
            @endphp
 
            <!-- Mostrar solo si el semestre coincide -->
            @if ($firstHorario->grupo->materiaAbierta->materia->semestre == $alumnoAuth->semestre)
                <tr>
                    <!-- Información General -->
                    <td>
                        {{ $firstHorario->grupo->materiaAbierta->materia->idmateria ?? '---' }} <br>
                        {{ $firstHorario->grupo->materiaAbierta->materia->nombremateria ?? 'Sin asignar' }} <br>
                        {{ $firstHorario->grupo->personal->nombres ?? '---' }}
                        {{ $firstHorario->grupo->personal->apellidop ?? '' }}
                        {{ $firstHorario->grupo->personal->apellidom ?? '' }}
                    </td>
                    <td>{{ $firstHorario->grupo->grupo ?? 'N/A' }}</td>
                    <td>{{ $firstHorario->grupo->materiaAbierta->materia->credito ?? '---' }}</td>
                    <!-- Mostrar los horarios por día -->
                    @foreach (['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'] as $dia)
                        <td>
                            @php
                                $horarioDia = $horarios->firstWhere('dia', $dia);
                            @endphp
                            @if ($horarioDia)
                                {{ $horarioDia->hora ?? 'Sin hora' }} <br>
                                {{ $horarioDia->lugar->nombrelugar ?? 'Sin lugar' }}
                            @else
                                ---
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
 
   
        <!-- Total Créditos -->
        <div class="total-creditos">
            Total Créditos:
            {{
                $grupoHorarios->groupBy(fn($horario) => $horario->grupo->id . '-' . $horario->grupo->materiaAbierta->materia->id)
                              ->sum(fn($horarios) => $horarios->first()->grupo->materiaAbierta->materia->credito ?? 0)
            }}
        </div>
       
    </div>
</body>
</html>