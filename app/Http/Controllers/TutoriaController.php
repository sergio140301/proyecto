<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Depto;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\Tutoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutoriaController extends Controller
{
    public $depto_id;
    public $carrera_id;
    public $periodo_id;

    function __construct()
    {
        if (request()->iddepto) {
            $this->depto_id = request()->iddepto;
            session(['depto_id' => request()->iddepto]);
        } else {
            $this->depto_id = (session()->exists('depto_id') ? session('depto_id') : "-1");
        }

        if (request()->idcarrera) {
            $this->carrera_id = request()->idcarrera;
            session(['carrera_id' => request()->idcarrera]);
        } else {
            $this->carrera_id = (session()->exists('carrera_id') ? session('carrera_id') : "-1");
        }

        if (request()->idperiodo) {
            $this->periodo_id = request()->idperiodo;
            session(['periodo_id' => request()->idperiodo]);
        } else {
            $this->periodo_id = (session()->exists('periodo_id') ? session('periodo_id') : "-1");
        }
    }

    public function index()
    {
        $tutorias = DB::table('personals as d')
            ->join('tutorias as t', 'd.id', '=', 't.personal_id')
            ->join('periodos as p', 'p.id', '=', 't.periodo_id')
            ->select('d.id', 'p.periodo', 'd.nombres', 'd.apellidop', 'd.apellidom')
            ->groupBy('d.id', 'p.periodo', 'd.nombres', 'd.apellidop', 'd.apellidom')
            ->get();



        return view('catalogos.tutorias.tablatutorias', compact('tutorias'));
    }

    public function index2()
    {
        $periodos = Periodo::all();

        $tutordealumnos = DB::table('personals')
            ->select('id', 'nombres', 'apellidop', 'apellidom')
            ->where('id', 11) // ID del tutor loggeado
            ->first();

        $alumnostutorados = DB::table('tutorias as t')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->join('personals as d', 't.personal_id', '=', 'd.id')
            ->select(
                't.id',
                'a.noctrl',
                'a.nombre',
                'a.apellidop',
                'a.apellidom',
                'c.nombreCarrera',
                't.semestreAlumno'
            )
            ->where('d.id', 11) // ID del tutor loggeado
            ->where('t.periodo_id', $this->periodo_id)
            ->get();


        return view('catalogos.tutores.tablatutor', compact('periodos', 'tutordealumnos', 'alumnostutorados'));
    }

    public function index3()
    {
        $periodos = Periodo::all();

        $asesorias = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->select(
                'a.noctrl',
                'a.nombre',
                'a.apellidop',
                'a.apellidom',
                'c.nombreCarrera',
                't.semestreAlumno'
            )
            ->where('t.personal_id', 1)  // id tutor loggeado
            ->where('t.periodo_id', $this->periodo_id)
            ->where('r.asesoria', 1)
            ->get();


        return view('catalogos.tutores.asesorias', compact('periodos', 'asesorias'));
    }

    public function create()
    {
        $departamentos = Depto::all();

        $personals = Personal::where('depto_id', $this->depto_id)->get();

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

        $carreras = Carrera::all();

        $alumnos = DB::table('alumnos as a')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->select(
                'a.id',
                'a.noctrl',
                'a.nombre',
                'a.apellidop',
                'a.apellidom',
                DB::raw("
            CASE 
                WHEN MONTH(CURDATE()) BETWEEN 1 AND 7 THEN (YEAR(CURDATE()) % 100 - SUBSTRING(a.noctrl, 1, 2)) * 2
                ELSE (YEAR(CURDATE()) % 100 - SUBSTRING(a.noctrl, 1, 2)) * 2 + 1
            END AS semestre")
            )
            ->where('c.id', $this->carrera_id)
            ->get();

            return view("catalogos.tutorias.frm", compact("departamentos", "personals", "periodos", "carreras", 'alumnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumnos' => 'required|array',
            'alumnos.*.id' => 'required|exists:alumnos,id',
            'alumnos.*.semestre' => 'required|integer',
            'periodo_id' => 'required|exists:periodos,id',
            'personal_id' => 'required|exists:personals,id',
        ]);

        foreach ($request->alumnos as $alumno) {
            Tutoria::create([
                'alumno_id' => $alumno['id'],
                'semestreAlumno' => $alumno['semestre'],
                'periodo_id' => $request->periodo_id,
                'personal_id' => $request->personal_id,
            ]);
        }

        return redirect()->route('tablatutorias')->with('success', 'Alumnos guardados exitosamente');
    }


    public function show($id, $periodo)
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
        
        $tutorias = DB::table('personals as d')
            ->join('tutorias as t', 'd.id', '=', 't.personal_id')
            ->join('periodos as p', 't.periodo_id', '=', 'p.id')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->select(
                'd.id',
                'p.periodo',
                'd.nombres',
                'd.apellidop',
                'd.apellidom',
                'a.noctrl',
                'a.nombre',
                'a.apellidop as alumno_apellidop',
                'a.apellidom as alumno_apellidom',
                't.semestreAlumno'
            )
            ->where('d.id', $id) // Filtro por el id del tutor
            ->where('p.periodo', $periodo) // Filtro por el id del periodo
            ->get();

            return view("catalogos.tutorias.vertutorados", compact("periodos","tutorias"));

    }


    public function show2(){
        
    }

    public function edit(Tutoria $tutoria)
    {
       
    }


    public function update(Request $request, Tutoria $tutoria)
    {
       
    }


    public function destroy(Tutoria $tutoria)
    {
        
    }
}