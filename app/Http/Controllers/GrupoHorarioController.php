<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Lugar;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Edificio;
use App\Models\Personal;
use App\Models\GrupoHorario;
use App\Models\MateriaAbierta;
use Illuminate\Http\Request;

class GrupoHorarioController extends Controller
{
    public $lugars;
    public $edificio_id;
    public $validado;

    function __construct()
    {

        

        if (request()->edificio_id) {
            $this->edificio_id = request()->edificio_id;
            session(['edificio_id' => request()->edificio_id]);
        } else {
            $this->edificio_id = session()->exists('edificio_id') ? session('edificio_id') : "-1";
        }

        $this->lugars = Lugar::where('edificio_id', $this->edificio_id)->get();


        

        }
    public function index(Request $request)
    {
        $semestre = $request->input('semestre', session('semestre', -1));
        $edificio_id = $request->input('edificio_id', session('edificio_id', -1));
        $periodo_id = $request->input('periodo_id', session('periodo_id', -1));
        $carrera_id = $request->input('carrera_id', session('carrera_id', -1));

        // Guardar datos en la sesión
        $request->session()->put('fecha', $request->input('fecha', session('fecha')));
        $request->session()->put('personal', $request->input('personal', session('personal')));
        $request->session()->put('materia', $request->input('materia', session('materia')));
        $request->session()->put('grupo', $request->input('grupo', session('grupo')));
        $request->session()->put('maxAlumnos', $request->input('maxAlumnos', session('maxAlumnos')));
        $request->session()->put('edificio_id', $edificio_id);

        $request->session()->put('semestre', $semestre);
        $request->session()->put('periodo_id', $periodo_id);
        $request->session()->put('carrera_id', $carrera_id);
    
        // Filtrar materias abiertas según semestre, periodo y carrera
        $materiasAbiertas = MateriaAbierta::join('materias as m', 'materia_abiertas.materia_id', '=', 'm.id')
            ->join('periodos as p', 'materia_abiertas.periodo_id', '=', 'p.id')
            ->when($semestre != -1, function ($query) use ($semestre) {
                return $query->where('m.semestre', $semestre);
            })
            ->when($periodo_id != -1, function ($query) use ($periodo_id) {
                return $query->where('materia_abiertas.periodo_id', $periodo_id);
            })
            ->when($carrera_id != -1, function ($query) use ($carrera_id) {
                return $query->where('materia_abiertas.carrera_id', $carrera_id);
            })
            ->select('m.id', 'm.nombreMateria')
            ->get();
    
        // Obtener periodos y carreras
        $periodos = Periodo::all();
        $carreras = Carrera::all();
    
        // Obtener lugares filtrados por edificio
        $lugars = Lugar::when($edificio_id != -1, function ($query) use ($edificio_id) {
            return $query->where('edificio_id', $edificio_id);
        })->get();
    
        // Otros datos necesarios
        $personals = Personal::all();
        $edificios = Edificio::all();
    
        return view('catalogos.aperturagrupo.index', [
            'personals' => $personals,
            'edificios' => $edificios,
            'lugars' => $lugars,
            'materias' => $materiasAbiertas,
            'semestre' => $semestre,
            'periodos' => $periodos,
            'carreras' => $carreras,
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
        return redirect()->route('aperturagrupo.index')->with('success', 'Grupo creado exitosamente.');
    }
}