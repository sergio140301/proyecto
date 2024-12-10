<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Alumno;
use App\Models\GrupoHorario;
use Illuminate\Http\Request;
use App\Models\Documentacion;
use App\Models\HorarioAlumno;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class HorarioAlumnoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
     
        // Buscar el alumno asociado al usuario autenticado
        $alumnoAuth = Alumno::where('nombre', $user->name)->first();
     
        if ($alumnoAuth) {
            // Filtrar los horarios para que solo incluyan materias del mismo semestre
            $horarioAlumnos = HorarioAlumno::with(['grupoHorario.grupo.materiaAbierta.materia'])
                ->where('alumno_id', $alumnoAuth->id)
                ->whereHas('grupoHorario.grupo.materiaAbierta.materia', function ($query) use ($alumnoAuth) {
                    $query->where('semestre', $alumnoAuth->semestre);
                })
                ->paginate(10);
     
            // Fetch associated documentation
            $documentacion = Documentacion::where('alumno_id', $alumnoAuth->id)->first();
     
            return view('horario_alumnos.index', compact('horarioAlumnos', 'alumnoAuth', 'documentacion'));
        }
     
        // Si no se encuentra un alumno, mostrar un error
        return view('horario_alumnos.index')->with('error', 'No se encontró un alumno asociado a este usuario.');
    }

    public function pdf()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
       
        // Buscar el alumno asociado al usuario autenticado
        $alumnoAuth = Alumno::where('nombre', $user->name)->first();
       
        if (!$alumnoAuth) {
            dd('Alumno no encontrado: ', $user->name);
        }
       
        // Obtener todos los IDs de grupos relacionados con el alumno
        $grupoIds = HorarioAlumno::where('alumno_id', $alumnoAuth->id)
            ->join('grupo_horarios', 'horario_alumnos.grupo_horario_id', '=', 'grupo_horarios.id')
            ->pluck('grupo_horarios.grupo_id')
            ->unique()
            ->toArray();
     
        if (empty($grupoIds)) {
            dd('No se encontraron grupos para el alumno.');
        }
     
        // Cargar los horarios de los grupos y filtrar por semestre
        $grupoHorarios = GrupoHorario::with([
            'lugar',
            'grupo.materiaAbierta.materia',
            'grupo.personal',
            'grupo.periodo'
        ])
        ->whereIn('grupo_id', $grupoIds)
        ->get();
     
        // Filtrar las materias que correspondan al semestre del alumno
        $grupoHorarios = $grupoHorarios->filter(function ($grupoHorario) use ($alumnoAuth) {
            return $grupoHorario->grupo->materiaAbierta->materia->semestre == $alumnoAuth->semestre;
        });
     
        // Verificar los datos recuperados
        if ($grupoHorarios->isEmpty()) {
            dd('No se encontraron horarios para los grupos en este semestre.');
        }
       
        // Generar el PDF
        $pdf = Pdf::loadView('horario_alumnos.pdf', compact('grupoHorarios', 'alumnoAuth'))
                  ->setPaper('a4', 'landscape'); // Orientación horizontal
     
        return $pdf->stream('horario_alumno.pdf');
    }
    
    public function create()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Buscar el alumno asociado
        $alumnoAuth = Alumno::where('nombre', $user->name)->first();

        // Verificar si se encontró un alumno
        if (!$alumnoAuth) {
            return redirect()->route('horario_alumnos.index')->with('error', 'No se encontró un alumno asociado al usuario.');
        }

        // Obtener los horarios ya asignados al alumno
        $horariosAsignados = HorarioAlumno::with('grupoHorario.grupo.materiaAbierta.materia')
            ->where('alumno_id', $alumnoAuth->id)
            ->get()
            ->pluck('grupoHorario.grupo.materiaAbierta.materia.nombremateria')
            ->toArray();

        // Cargar los horarios disponibles agrupados
        $grupoHorarios = GrupoHorario::with(['grupo.materiaAbierta.materia'])->get();

        // Validar que los objetos requeridos no sean nulos antes de agrupar
        $grupoHorariosAgrupados = $grupoHorarios->filter(function ($horario) {
            return $horario->grupo && $horario->grupo->materiaAbierta && $horario->grupo->materiaAbierta->materia;
        })->groupBy(function ($horario) {
            return $horario->grupo->id . '-' . $horario->grupo->personal_id;
        })->map(function ($horarios) {
            return [
                'id' => $horarios->first()->id,
                'grupo' => $horarios->first()->grupo->grupo ?? 'No definido',
                'semestre' => $horarios->first()->grupo->materiaAbierta?->materia?->semestre,
                'materia' => $horarios->first()->grupo->materiaAbierta?->materia?->nombremateria ?? 'No asignada',
                'credito' => $horarios->first()->grupo->materiaAbierta?->materia?->credito ?? 0,
                'docente' => $horarios->first()->grupo->personal?->nombres . ' ' . 
                            $horarios->first()->grupo->personal?->apellidop . ' ' . 
                            $horarios->first()->grupo->personal?->apellidom ?? 'Sin Asignar Docente',
                // Usar directamente el valor del campo `dia` de la base de datos
                'dias' => $horarios->map(function ($horario) {
                    return $horario->dia ?? 'Día no definido'; // Usar directamente el valor de `dia`
                })->unique()->join(', '),
                'hora' => $horarios->first()->hora ?? 'No definida',
                'salon' => $horarios->first()->lugar->nombrecorto ?? 'No definido',
            ];
        });
        
        // Pasar las variables necesarias a la vista
        return view('horario_alumnos.frm', compact('alumnoAuth', 'grupoHorarios', 'grupoHorariosAgrupados', 'horariosAsignados'))->with('accion', 'C');
    }
    
    public function store(Request $request)
    {
        // Obtener el alumno autenticado
        $alumnoAuth = Alumno::where('nombre', Auth::user()->name)->first();

        // Validar que exista un alumno asociado al usuario autenticado
        if (!$alumnoAuth) {
            return redirect()->route('horario_alumnos.index')->with('error', 'No se encontró un alumno asociado al usuario.');
        }

        // Validar los datos de entrada
        $request->validate([
            'grupo_horario_id' => 'required|array',
            'grupo_horario_id.*' => 'exists:grupo_horarios,id',
        ]);

        // Crear los registros de horarios para el alumno autenticado
        foreach ($request->grupo_horario_id as $grupoHorarioId) {
            HorarioAlumno::create([
                'alumno_id' => $alumnoAuth->id,
                'grupo_horario_id' => $grupoHorarioId,
            ]);
        }

        return redirect()->route('horario_alumnos.index')->with('mensaje', 'Horario registrado con éxito.');
    }

    public function edit(HorarioAlumno $horarioAlumno)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        $alumnoAuth = Alumno::where('nombre', $user->name)->first();

        $grupoHorarios = GrupoHorario::all();
        return view('horario_alumnos.frm', compact('horarioAlumno', 'alumnoAuth', 'grupoHorarios'))->with('accion', 'E');
    }

    public function update(Request $request, HorarioAlumno $horarioAlumno)
    {
        // Obtener el alumno autenticado
        $alumnoAuth = Alumno::where('nombre', Auth::user()->name)->first();

        // Validar que exista un alumno asociado al usuario autenticado
        if (!$alumnoAuth) {
            return redirect()->route('horario_alumnos.index')->with('error', 'No se encontró un alumno asociado al usuario.');
        }

        // Validar los datos de entrada
        $request->validate([
            'grupo_horario_id' => 'required|exists:grupo_horarios,id',
        ]);

        // Actualizar el horario con el alumno autenticado
        $horarioAlumno->update([
            'alumno_id' => $alumnoAuth->id,
            'grupo_horario_id' => $request->grupo_horario_id,
        ]);

        return redirect()->route('horario_alumnos.index')->with('mensaje', 'Horario actualizado con éxito.');
    }

    public function destroy(HorarioAlumno $horarioAlumno)
    {
        $horarioAlumno->delete();
        return redirect()->route('horario_alumnos.index')->with('mensaje', 'Registro eliminado con éxito.');
    }
}