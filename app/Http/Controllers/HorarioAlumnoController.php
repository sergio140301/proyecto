<?php

namespace App\Http\Controllers;

use App\Models\HorarioAlumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioAlumnoController extends Controller
{

    public $sem;
    public $grupo_id;

    function __construct()
    {
        if (request()->semestre) {
            $this->sem = request()->semestre;
            session(['sem' => request()->semestre]);
        } else {
            $this->sem = (session()->exists('sem') ? session('sem') : "-1");
        }

        if (request()->idgrupo) {
            $this->grupo_id = request()->idgrupo;
            session(['grupo_id' => request()->idgrupo]);
        } else {
            $this->grupo_id = (session()->exists('grupo_id') ? session('grupo_id') : "-1");
        }
    }

    public function index()
    {
        $periodos = DB::table('periodos')
            ->select('*') // Selecciona todos los campos de la tabla periodos
            ->whereRaw("
            (CASE
                WHEN periodo LIKE 'Ene-Jun%' AND MONTH(CURDATE()) BETWEEN 1 AND 6 THEN 1
                WHEN periodo LIKE 'Ago-Dic%' AND MONTH(CURDATE()) BETWEEN 8 AND 12 THEN 1
                ELSE 0
            END) = 1
        ")
            ->whereRaw("RIGHT(periodo, 2) = RIGHT(YEAR(CURDATE()), 2)")
            ->first();

        $grupos = DB::table('grupos as g')
            ->join('materias as m', 'g.materia_id', '=', 'm.id')
            ->select('g.id', 'g.grupo')
            ->where('g.periodo_id', $periodos->id)
            ->where('m.semestre', $this->sem)
            ->get();

        $existegrupos = DB::table('grupos as g')
            ->join('materias as m', 'g.materia_id', '=', 'm.id')
            ->select('g.id', 'g.grupo')
            ->where('g.periodo_id', $periodos->id)
            ->where('m.semestre', $this->sem)
            ->count();

        // Inicializar todas las variables
        $infoGrupo = null;
        $alumnos = collect();
        $horarios = collect();
        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
        $tablaHorarios = [];
        $existeHorario = 0;
        $alumnosHorario = collect();

        if ($this->grupo_id !== null) {
            $infoGrupo = DB::table('grupos as g')
                ->join('materias as m', 'g.materia_id', '=', 'm.id')
                ->join('personals as d', 'g.personal_id', '=', 'd.id')
                ->join('reticulas as r', 'm.reticula_id', '=', 'r.id')
                ->join('carreras as c', 'r.carrera_id', '=', 'c.id')
                ->select('g.id', 'c.id as idc', 'c.nombreCarrera', 'm.nombreMateria', 'g.maxAlumnos', DB::raw("CONCAT(d.nombres, ' ', d.apellidop, ' ', d.apellidom) as docente"))
                ->where('g.id', $this->grupo_id)
                ->first();

            if ($infoGrupo !== null) {
                $alumnos = DB::table('alumnos as a')
                    ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
                    ->select('a.id', 'a.noctrl', 'a.nombre', 'a.apellidop', 'a.apellidom')
                    ->where('c.id', $infoGrupo->idc)
                    ->get();

                $horarios = DB::table('grupo_horarios')
                    ->select('dia', 'hora')
                    ->where('grupo_id', $this->grupo_id)
                    ->get();

                // Agrupar horarios por día y concatenar horarios consecutivos
                foreach ($dias as $dia) {
                    $horas = $horarios->where('dia', $dia)->pluck('hora')->sort()->values();
                    $horasAgrupadas = [];
                    $inicio = null;
                    $fin = null;

                    foreach ($horas as $hora) {
                        [$horaInicio, $horaFin] = explode('-', $hora);

                        if ($inicio === null) {
                            $inicio = $horaInicio;
                            $fin = $horaFin;
                        } elseif ($horaInicio === $fin) {
                            $fin = $horaFin;
                        } else {
                            $horasAgrupadas[] = "$inicio-$fin";
                            $inicio = $horaInicio;
                            $fin = $horaFin;
                        }
                    }

                    if ($inicio !== null) {
                        $horasAgrupadas[] = "$inicio-$fin";
                    }

                    $tablaHorarios[$dia] = $horasAgrupadas;
                }

                $existeHorario = DB::table('horario_alumnos')
                    ->where('grupo_id', $this->grupo_id)
                    ->count();

                $alumnosHorario = DB::table('horario_alumnos as ha')
                    ->join('alumnos as a', 'ha.alumno_id', '=', 'a.id')
                    ->select('a.noctrl', DB::raw("CONCAT(a.nombre, ' ', a.apellidop, ' ', a.apellidom) as nomalumno"))
                    ->where('ha.grupo_id', $this->grupo_id)
                    ->get();
            }
        }

        return view('catalogos.horarioalumnos.index', compact('periodos', 'grupos', 'existegrupos', 'infoGrupo', 'alumnos', 'horarios', 'dias', 'tablaHorarios', 'existeHorario', 'alumnosHorario'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alumnos' => 'required|array',
            'alumnos.*.id' => 'required|exists:alumnos,id'
        ]);

        foreach ($request->alumnos as $alumno) {
            HorarioAlumno::create([
                'alumno_id' => $alumno['id'],
                'grupo_id' => $this->grupo_id
            ]);
        }

        return redirect()->route('horarioalumnos')->with('success', 'Horario Creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(HorarioAlumno $horarioAlumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HorarioAlumno $horarioAlumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HorarioAlumno $horarioAlumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HorarioAlumno $horarioAlumno)
    {
        //
    }
}
