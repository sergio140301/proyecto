<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Depto;
use App\Models\Lugar;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\Tutoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

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



        return view('catalogos.tutorias.tablatutoriascoord', compact('tutorias'));
    }

    public function create()
    {
        $departamentos = Depto::all();

        $personals = Personal::where('depto_id', $this->depto_id)->get();

        $periodos = DB::table('periodos')
            ->select('*')
            ->whereRaw("(CASE
                            WHEN periodo LIKE 'Ene-Jun%' AND MONTH(CURDATE()) BETWEEN 1 AND 6 THEN 1
                            WHEN periodo LIKE 'Ago-Dic%' AND MONTH(CURDATE()) BETWEEN 8 AND 12 THEN 1
                            ELSE 0
                        END) = 1")
            ->whereRaw("RIGHT(periodo, 2) = RIGHT(YEAR(CURDATE()), 2)")
            ->first();

        $carreras = Carrera::all();

        //esta consulta mostrará en el select solo los alumnos que no tengan un tutor asignado en el periodo actual
        $alumnos = DB::table('alumnos as a')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->select(
                'a.id',
                'a.noctrl',
                'a.nombre',
                'a.apellidop',
                'a.apellidom',
                DB::raw("CASE
                WHEN MONTH(CURDATE()) BETWEEN 1 AND 7 THEN (YEAR(CURDATE()) % 100 - SUBSTRING(a.noctrl, 1, 2)) * 2
                ELSE (YEAR(CURDATE()) % 100 - SUBSTRING(a.noctrl, 1, 2)) * 2 + 1
                END AS semestre")
            )
            ->where('c.id', '=', $this->carrera_id)
            ->whereNotIn('a.id', function ($query) {
                $query->select('alumno_id')
                    ->from('tutorias')
                    ->where('periodo_id', '=', $this->periodo_id);
            })
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

        return redirect()->route('tutorias.tablatutoriascoord')->with('success', 'Alumnos guardados exitosamente');
    }


    public function show($iddocente, $periodo)
    {
        $periodos = DB::table('periodos')
            ->select('id', 'periodo')
            ->where('periodo', $periodo)
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
            ->where('d.id', $iddocente) // parametro id personal
            ->where('p.periodo', $periodo) // parametro periodo
            ->get();

        return view("catalogos.tutorias.vertutorados", compact("periodos", "tutorias"));
    }

    public function generaReporte($iddocente, $periodo)
    {
        $infoTutor = DB::table('tutorias as t')
                    ->join('personals as d', 't.personal_id', '=', 'd.id')
                    ->join('deptos as de', 'd.depto_id', '=', 'de.id')
                    ->join('puestos as pu', 'd.puesto_id', '=', 'pu.id')
                    ->join('periodos as per', 't.periodo_id', '=', 'per.id')
                    ->select(
                        DB::raw("DATE_FORMAT(t.created_at, '%d-%m-%Y') AS creacionTutoria"),
                        'd.nombres',
                        'd.apellidop',
                        'd.apellidom',
                        'pu.tipo',
                        'de.nombreDepto'
                    )
                    ->where('d.id', $iddocente)
                    ->where('per.periodo', $periodo)
                    ->orderBy('t.created_at', 'ASC')
                    ->limit(1)
                    ->get();

        $totalTutorados = DB::table('personals as d')
                    ->join('tutorias as t', 'd.id', '=', 't.personal_id')
                    ->join('periodos as p', 't.periodo_id', '=', 'p.id')
                    ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
                    ->where('d.id', $iddocente)
                    ->where('p.periodo', $periodo)
                    ->count();

        $totalHombres = DB::table('personals as d')
                    ->join('tutorias as t', 'd.id', '=', 't.personal_id')
                    ->join('periodos as p', 't.periodo_id', '=', 'p.id')
                    ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
                    ->where('d.id', $iddocente)
                    ->where('p.periodo', $periodo)
                    ->where('a.sexo', 'M')
                    ->count();

        $totalMujeres = DB::table('personals as d')
                    ->join('tutorias as t', 'd.id', '=', 't.personal_id')
                    ->join('periodos as p', 't.periodo_id', '=', 'p.id')
                    ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
                    ->where('d.id', $iddocente)
                    ->where('p.periodo', $periodo)
                    ->where('a.sexo', 'F')
                    ->count();

        $fechasSeguimientos = DB::table('periodo_tutorias as pt')
                    ->join('periodos as p', 'pt.periodo_id', '=', 'p.id')
                    ->select(
                        DB::raw("CONCAT(DAY(pt.fecha_ini), ' al ', DAY(pt.fecha_fin), ' de ',
                            CASE MONTH(pt.fecha_ini)
                                WHEN 1 THEN 'enero'
                                WHEN 2 THEN 'febrero'
                                WHEN 3 THEN 'marzo'
                                WHEN 4 THEN 'abril'
                                WHEN 5 THEN 'mayo'
                                WHEN 6 THEN 'junio'
                                WHEN 7 THEN 'julio'
                                WHEN 8 THEN 'agosto'
                                WHEN 9 THEN 'septiembre'
                                WHEN 10 THEN 'octubre'
                                WHEN 11 THEN 'noviembre'
                                WHEN 12 THEN 'diciembre'
                            END, ' ', YEAR(pt.fecha_ini)) AS rango_fechas"
                        )
                    )
                    ->where('p.periodo', $periodo)
                    ->get();

        $tutorados = DB::table('personals as d')
                ->join('tutorias as t', 'd.id', '=', 't.personal_id')
                ->join('periodos as p', 't.periodo_id', '=', 'p.id')
                ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
                ->select('a.noctrl', 'a.nombre', 'a.apellidop', 'a.apellidom')
                ->where('d.id', $iddocente)
                ->where('p.periodo', $periodo)
                ->get();


        //plantilla
        $templateProcessor = new TemplateProcessor(storage_path('app/public/reporteTutores.docx'));

        //marcadores
        $templateProcessor->setValue('${fechacreaciontutoria}', $infoTutor[0]->creacionTutoria );

        $tutor = $infoTutor[0]->nombres . ' ' . $infoTutor[0]->apellidop . ' ' . $infoTutor[0]->apellidom;
        $templateProcessor->setValue('${nombretutor}', $tutor );
        $templateProcessor->setValue('${tipopuesto}', $infoTutor[0]->tipo );
        $templateProcessor->setValue('${depto}', $infoTutor[0]->nombreDepto );

        $templateProcessor->setValue('${totalalumnos}', $totalTutorados );
        $templateProcessor->setValue('${numm}', $totalMujeres);
        $templateProcessor->setValue('${numh}', $totalHombres );
        $templateProcessor->setValue('${periodo}', $periodo );

        $templateProcessor->setValue('${seg1}', $fechasSeguimientos[0]->rango_fechas );
        $templateProcessor->setValue('${seg2}', $fechasSeguimientos[1]->rango_fechas );
        $templateProcessor->setValue('${seg3}', $fechasSeguimientos[2]->rango_fechas );
        $templateProcessor->setValue('${seg4}', $fechasSeguimientos[3]->rango_fechas );

        $templateProcessor->cloneRow('noctrl', count($tutorados));
        foreach ($tutorados as $index => $tutorado) {
            $rowIndex = $index + 1;
            $templateProcessor->setValue("noctrl#{$rowIndex}", $tutorado->noctrl);
            $nombreCompleto = $tutorado->nombre . ' ' . $tutorado->apellidop . ' ' . $tutorado->apellidom;
            $templateProcessor->setValue("nomalumno#{$rowIndex}", $nombreCompleto);

        }

        //guardar
        $fileName = 'Lista_Tutores_'. $iddocente . ' ' . $periodo .'.docx';
        $templateProcessor->saveAs(storage_path('app/public/' . $fileName));

        // Descargar el archivo
        return response()->download(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);
    }


}
