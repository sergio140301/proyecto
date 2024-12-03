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
    }

    public function index()
    {
        $departamentos = Depto::all();

        $personals = Personal::where('depto_id', $this->depto_id)->get();

        $periodos = Periodo::whereIn('id', function ($query) {
            $query
                ->select('p.id')
                ->from('periodo_tutorias as pt')
                ->join('periodos as p', 'pt.periodo_id', '=', 'p.id')
                ->groupBy('p.id');
        })->get(['id', 'periodo']);

        $carreras = Carrera::all();

        /* $alumnos = Alumno::where('carrera_id', $this->carrera_id)->get(); */
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



        return view('catalogos.tutorias.index', compact('departamentos', 'personals', 'periodos', 'carreras', 'alumnos'));
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

        return redirect()->route('tutorias.index')->with('success', 'Alumnos guardados exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tutoria $tutoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tutoria $tutoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tutoria $tutoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutoria $tutoria)
    {
        //
    }
}