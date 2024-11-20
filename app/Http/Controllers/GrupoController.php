<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Periodo;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public $carrera;
    public $grupo;
    public $periodo_id;
    public $carrera_id;

    public function __construct()
    {
        if (request()->idperiodo) {
            $this->periodo_id = request()->idperiodo;
            session(['periodo_id' => request()->idperiodo]);
        } else {
            $this->periodo_id = (session()->exists('periodo_id') ? session('periodo_id') : "-1");
        }

        if (request()->idcarrera) {
            $this->carrera_id = request()->idcarrera;
            session(['carrera_id' => request()->idcarrera]);
        } else {
            $this->carrera_id = (session()->exists('carrera_id') ? session('carrera_id') : "-1");
        }

        $this->carrera = Carrera::with('reticulas.materias')->where('id', $this->carrera_id)->get();
        
        // Se filtran los grupos por periodo y carrera
        $this->grupo = Grupo::where('periodo_id', $this->periodo_id)
                            ->where('carrera_id', $this->carrera_id)
                            ->get();
    }

    public function index()
    {
        // Obtener los periodos y carreras disponibles
        $periodos = Periodo::get();
        $carreras = Carrera::get();

        return view("grupos.index", [
            'periodos' => $periodos,
            'carreras' => $carreras,
            'carrera' => $this->carrera,
            'grupos' => $this->grupo
        ]);
    }

    public function create()
    {
        // Obtener los periodos y carreras para mostrar en el formulario
        $periodos = Periodo::get();
        $carreras = Carrera::get();

        return view('grupos.create', [
            'periodos' => $periodos,
            'carreras' => $carreras
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'personal_id' => 'required|exists:personals,id',
            'materia_id' => 'required|exists:materias,id',
            'grupo' => 'required|string|max:255',
            'maxAlumnos' => 'required|integer',
            'periodo_id' => 'required|exists:periodos,id',
            'carrera_id' => 'required|exists:carreras,id',
            'descripcion' => 'nullable|string|max:255',
        ]);

        // Crear un nuevo grupo con los datos validados
        Grupo::create([
            'fecha' => $validatedData['fecha'],
            'personal_id' => $validatedData['personal_id'],
            'materia_id' => $validatedData['materia_id'],
            'grupo' => $validatedData['grupo'],
            'maxAlumnos' => $validatedData['maxAlumnos'],
            'periodo_id' => $validatedData['periodo_id'],
            'carrera_id' => $validatedData['carrera_id'],
            'descripcion' => $validatedData['descripcion'],
        ]);

        // Redirigir a la página de inicio con un mensaje de éxito
        return redirect()->route('grupos.index')->with('success', 'Grupo creado exitosamente.');
    }

    public function show(Grupo $grupo)
    {
        // Mostrar los detalles de un grupo específico
        return view('grupos.show', compact('grupo'));
    }

    public function edit(Grupo $grupo)
    {
        // Obtener los periodos y carreras para mostrar en el formulario de edición
        $periodos = Periodo::get();
        $carreras = Carrera::get();

        return view('grupos.edit', [
            'grupo' => $grupo,
            'periodos' => $periodos,
            'carreras' => $carreras
        ]);
    }

    public function update(Request $request, Grupo $grupo)
    {
        // Validar y actualizar los datos del grupo
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'personal_id' => 'required|exists:personals,id',
            'materia_id' => 'required|exists:materias,id',
            'grupo' => 'required|string|max:255',
            'maxAlumnos' => 'required|integer',
            'periodo_id' => 'required|exists:periodos,id',
            'carrera_id' => 'required|exists:carreras,id',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $grupo->update($validatedData);

        // Redirigir a la página de inicio con un mensaje de éxito
        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado exitosamente.');
    }

    public function destroy(Grupo $grupo)
    {
        // Eliminar el grupo
        $grupo->delete();

        // Redirigir a la página de inicio con un mensaje de éxito
        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
