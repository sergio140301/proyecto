<?php

namespace App\Http\Controllers;

use App\Models\Hora;
use App\Models\Grupo;
use App\Models\Lugar;
use App\Models\Carrera;
use App\Models\MateriaAbierta;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Edificio;
use App\Models\Personal;
use App\Models\GrupoHorario;
use App\Models\HorarioMaestro;
use App\Models\HorarioMaestroGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GrupoHorarioController extends Controller
{
    public $periodo_id;
    public $carrera_id;
    public $semestre;

    public $carrera;
    public $ma;

    public $validado;

    public $edificio_id;
    public $lugars;


    function __construct()
    {
        $this->validado = [
            'grupo' => 'required|string|max:255|unique:grupos,grupo',
            'maxAlumnos' => 'required|string|max:255',
            'materia_id' => 'required|exists:materias,id',
            'personal_id' => 'required|exists:personals,id'
        ];

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

        if (request()->sem) {
            $this->semestre = request()->sem;
            session(['semestre' => request()->sem]);
        } else {
            $this->semestre = (session()->exists('semestre') ? session('semestre') : "-1");
        }

        if (request()->idedificio) {
            $this->edificio_id = request()->idedificio;
            session(['edificio_id' => request()->idedificio]);
        } else {
            $this->edificio_id = (session()->exists('edificio_id') ? session('edificio_id') : "-1");
        }


        $this->carrera = Carrera::with(['reticulas.materias' => function ($query) {
            $query
                ->where('semestre', $this->semestre);
        }])
            ->where('id', $this->carrera_id)->get();


        $this->ma = MateriaAbierta::where('periodo_id', $this->periodo_id)
            ->where('carrera_id', $this->carrera_id)
            ->get();

        $this->lugars = Lugar::where('edificio_id', $this->edificio_id)->get();

    }

    public function index(Request $request)
    {
        $periodos = Periodo::get();
        $carreras = Carrera::get();

        $personals = Personal::get();

        $edificios = Edificio::get();

        $horas = Hora::get();

        return view(
            "catalogos.aperturagrupo.index",
            [
                'periodos' => $periodos,
                'carreras' => $carreras,
                'carrera' => $this->carrera,
                'ma' => $this->ma,
                'personals' => $personals,
                'edificios' => $edificios,
                'lugars' => $this->lugars,
                'horas' => $horas
            ]
        );
    }

    public function store(Request $request)
    {
        $validado = $request->validate($this->validado);

        if ($this->periodo_id != "-1" and $this->carrera_id != "-1" and $this->semestre != "-1") {
            DB::beginTransaction();

            try {
                $grupo = Grupo::create([
                    'grupo' => $validado['grupo'],
                    'maxAlumnos' => $validado['maxAlumnos'],
                    'periodo_id' => $this->periodo_id,
                    'materia_id' => $validado['materia_id'],
                    'personal_id' => $validado['personal_id']

                ]);

                $horario_maestros = HorarioMaestro::create([
                    'fecha' => $request->fecha,
                    'personal_id' => $request->personal_id,
                    'periodo_id' => $this->periodo_id
                ]);

                HorarioMaestroGrupo::create([
                    'horario_maestro_id' => $horario_maestros->id,
                    'grupo_id' => $grupo->id
                ]);

                $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];

                foreach ($dias as $dia) {
                    // Obtener los horarios seleccionados para el día actual
                    $horarios = $request->input("horarios.$dia", []);  // Default vacío si no hay selección

                    // Si se seleccionaron horarios, insertarlos en la base de datos
                    foreach ($horarios as $hora) {
                        // Crear un nuevo registro para cada horario
                        GrupoHorario::create([
                            'dia' => $dia,  // El día de la semana (lunes, martes, etc.)
                            'hora' => $hora,
                            'grupo_id' => $grupo->id,
                            'lugar_id' => $request->idlugar
                        ]);
                        
                    }
                }

                DB::commit();

                return redirect()->route('aperturagrupo.index')->with('success', 'Datos insertados correctamente.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('aperturagrupo.index')->with('error', 'Ocurrió un error al insertar los datos: ' . $e->getMessage());
            }
        }
    }
}