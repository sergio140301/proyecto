<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Grupo;
use App\Models\Lugar;
use App\Models\Edificio;
use App\Models\Personal;
use App\Models\GrupoHorario;
use Illuminate\Http\Request;
use App\Models\MateriaAbierta;
use Illuminate\Support\Facades\Log;

class JsonController extends Controller
{
    /* Todo de MateriaAbierta */

    /* Periodo */
    public function periodos()
    {
        $periodos = MateriaAbierta::with(['periodo:id,periodo'])
        ->get(['id', 'materia_id', 'periodo_id', 'carrera_id'])
        ->unique('periodo.periodo');
        return $periodos;
    }

    /* Carrera */
    public function carreras()
    {
        $carreras = MateriaAbierta::with(['carrera:id,nombrecarrera'])
        ->get(['id', 'materia_id', 'periodo_id', 'carrera_id'])
        ->unique('carrera.nombrecarrera');
        return $carreras;
    }

    /* Semestre */
    public function semestres()
    {
        $semestres = MateriaAbierta::with(['materia:id,semestre'])
        ->get(['id', 'materia_id', 'periodo_id', 'carrera_id'])
        ->unique('materia.semestre');
        return $semestres;
    }
    
    /* Materia */
    public function materias()
    {
        $materias = MateriaAbierta::with(['materia:id,nombremateria'])
        ->get(['id', 'materia_id', 'periodo_id', 'carrera_id'])
        ->unique('materia.nombremateria');
        return $materias;
    }

    /* Depto */
    public function deptos() {
        $deptos = Depto::get();
        return $deptos;
    }

    /* Personal */
    public function personal() {
        $personal = Personal::get();
        return $personal;
    }

    /* Edificio */
    public function edificios() {
        $edificios = Edificio::get();
        return $edificios;
    }

    /* Lugar */
    public function lugar() {
        $lugar = Lugar::get();
        return $lugar;
    }

    /* Grupo */
    public function grupos() {
        $grupos = Grupo::get();
        return $grupos;
    }

    /* Insertar Grupo */
    public function insertarGrupo(Request $request)
    {
        try {
            Log::info('Datos recibidos:', $request->all());
    
            $validatedData = $request->validate([
                'grupo' => 'required|string|max:5',
                'descripcion' => 'required|string|max:200',
                'maxalumnos' => 'required|integer|min:1',
                'fecha' => 'required|date',
                'periodo_id' => 'required|integer',
                'materia_abierta_id' => 'required|exists:materia_abiertas,id',
                'personal_id' => 'nullable|exists:personals,id',
            ]);
    
            // Verificar si el grupo existe para actualizarlo
            $grupo = Grupo::where('grupo', $validatedData['grupo'])->first();
    
            if ($grupo) {
                // Si el grupo existe, actualízalo
                $grupo->update($validatedData);
            } else {
                // Si el grupo no existe, créalo
                $grupo = Grupo::create($validatedData);
            }
    
            return response()->json([
                'success' => true,
                'message' => $grupo->exists ? 'Grupo actualizado exitosamente' : 'Grupo creado exitosamente',
                'grupo' => $grupo,
            ], 200);
    
        } catch (\Exception $e) {
            Log::error('Error al insertar o actualizar el grupo:', ['message' => $e->getMessage()]);
    
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }    
    
    /* Insertar Grupo Horario*/
    public function insertarGrupoHorario(Request $request)
    {
        $validated = $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'lugar_id' => 'required|exists:lugars,id',
            'dia' => 'required|string|max:15',
            'hora' => 'required|string|max:10',
        ]);

        try {
            // Validación adicional para prevenir duplicados
            $exists = GrupoHorario::where('grupo_id', $validated['grupo_id'])
                ->where('dia', $validated['dia'])
                ->where('hora', $validated['hora'])
                ->where('lugar_id', $validated['lugar_id'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'El horario ya existe para este grupo en este lugar, día y hora.',
                ], 422);
            }

            $grupoHorario = GrupoHorario::create([
                'grupo_id' => $validated['grupo_id'],
                'lugar_id' => $validated['lugar_id'],
                'dia' => $validated['dia'],
                'hora' => $validated['hora'],
            ]);

            return response()->json([
                'message' => 'Horario del grupo insertado correctamente.',
                'data' => $grupoHorario,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al insertar el horario del grupo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    } 

    /* Eliminar Grupo Horario */
    public function eliminarGrupoHorario(Request $request)
    {
        $validated = $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'lugar_id' => 'required|exists:lugars,id',
            'dia' => 'required|string|max:15',
            'hora' => 'required|string|max:10',
        ]);

        try {
            $grupoHorario = GrupoHorario::where('grupo_id', $validated['grupo_id'])
                ->where('lugar_id', $validated['lugar_id'])
                ->where('dia', $validated['dia'])
                ->where('hora', $validated['hora'])
                ->first();

            if (!$grupoHorario) {
                return response()->json([
                    'message' => 'Horario no encontrado.',
                ], 404);
            }

            $grupoHorario->delete();

            return response()->json([
                'message' => 'Horario del grupo eliminado correctamente.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el horario del grupo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
