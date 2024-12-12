<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asesoria;
use App\Models\Lugar;
use App\Models\Periodo;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsesoriaController extends Controller
{
    public $periodo_id;

    function __construct()
    {
        if (request()->idperiodo) {
            $this->periodo_id = request()->idperiodo;
            session(['periodo_id' => request()->idperiodo]);
        } else {
            $this->periodo_id = (session()->exists('periodo_id') ? session('periodo_id') : "-1");
        }
    }

    public function index()
    {

        $periodos = Periodo::all();

        $asesorias = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->select(
                'r.id',
                'a.noctrl',
                'a.nombre',
                'a.apellidop',
                'a.apellidom',
                'c.nombreCarrera',
                't.semestreAlumno',
                'm.nombreMateria'
            )
            ->where('t.personal_id', 1)  // id tutor loggeado
            ->where('t.periodo_id', $this->periodo_id)
            ->where('r.asesoria', 1)
            ->get();


        return view('catalogos.asesorias.asesoriastutor', compact('periodos', 'asesorias'));
    }

    public function index2()
    {
        $asesorias = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->select(
                'r.id',
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

        $isAsesoriaRegistrada = DB::table('asesorias as ase')
            ->join('lugars as l', 'ase.lugar_id', '=', 'l.id')
            ->join('personals as d', 'ase.personal_id', '=', 'd.id')
            ->join('rendimientos as r', 'ase.rendimiento_id', '=', 'r.id')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('periodo_tutorias as pt', 'fa.periodo_tutoria_id', '=', 'pt.id')
            ->where('r.id', 35)
            ->count();



        return view('catalogos.asesorias.asesoriastutor', compact('asesorias', 'isAsesoriaRegistrada'));
    }


    public function store(Request $request)
    {
        Asesoria::create([
            'fecha' => $request->fecha,
            'horario' => $request->horario,
            'rendimiento_id' => $request->idrendimiento,
            'lugar_id' => $request->idlugar,
            'personal_id' => $request->idpersonal
        ]);

        return redirect()->route('asesorias.asesoriastutor')->with('success', 'Asesoría guardada exitosamente');
    }

    public function asignarAs($id, $noctrl)
    {
        $alumno = DB::table('alumnos as a')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->select(
                'a.id',
                'a.noctrl',
                'a.nombre',
                'a.apellidop',
                'a.apellidom',
                'c.nombreCarrera',
                't.semestreAlumno'
            )
            ->where('a.noctrl', $noctrl)
            ->first();

        $materiasAsesoria = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->select('m.nombreMateria', 'r.id', 'm.semestre')
            ->where('a.noctrl', $noctrl)
            ->where('r.id', $id)
            ->first();

        $personals = Personal::all();
        $lugars = Lugar::all();

        $isAsesoriaRegistrada = DB::table('asesorias as ase')
            ->join('lugars as l', 'ase.lugar_id', '=', 'l.id')
            ->join('personals as d', 'ase.personal_id', '=', 'd.id')
            ->join('rendimientos as r', 'ase.rendimiento_id', '=', 'r.id')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('periodo_tutorias as pt', 'fa.periodo_tutoria_id', '=', 'pt.id')
            ->where('r.id', $id)
            ->count();

        $asesoriaReg = DB::table('asesorias as ase')
            ->join('lugars as l', 'ase.lugar_id', '=', 'l.id')
            ->join('personals as d', 'ase.personal_id', '=', 'd.id')
            ->join('rendimientos as r', 'ase.rendimiento_id', '=', 'r.id')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('periodo_tutorias as pt', 'fa.periodo_tutoria_id', '=', 'pt.id')
            ->select(
                'r.id',
                'm.nombreMateria',
                'm.semestre',
                'ase.fecha',
                'ase.horario',
                'l.nombrelugar',
                'd.nombres',
                'd.apellidop',
                'd.apellidom'
            )
            ->where('r.id', $id)
            ->first();

        return view("catalogos.asesorias.verasesoriastutor", compact('alumno', 'materiasAsesoria', 'personals', 'lugars', 'isAsesoriaRegistrada', 'asesoriaReg'));
    }
}
