<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\FormAlumno;
use App\Models\Materia;
use App\Models\Rendimiento;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

class FormAlumnoController extends Controller
{

    public function index()
    {
        $alumno = DB::table('alumnos as a')
            ->select(
                'a.id',
                'a.noctrl',
                'a.nombre',
                'a.apellidop',
                'a.apellidom',
                'c.nombreCarrera',
                DB::raw('CASE 
                        WHEN MONTH(CURDATE()) BETWEEN 1 AND 7 THEN (YEAR(CURDATE()) % 100 - SUBSTRING(a.noctrl, 1, 2)) * 2
                        ELSE (YEAR(CURDATE()) % 100 - SUBSTRING(a.noctrl, 1, 2)) * 2 + 1
                    END AS semestre')
            )
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->where('a.id', 22) /* se supone debe traerse el id del alumno loggeado (session) */
            ->first();

        $materias = DB::table('materias as m')
            ->select('m.id', 'm.idMateria', 'm.nombreMateria', 'm.semestre', 'pe.nombres', 'pe.apellidop', 'pe.apellidom')
            ->join('grupos as g', 'm.id', '=', 'g.materia_id')
            ->join('personals as pe', 'g.personal_id', '=', 'pe.id')
            ->join('horario_alumnos as ha', 'g.id', '=', 'ha.grupo_id')
            ->join('alumnos as a', 'ha.alumno_id', '=', 'a.id')
            ->join('periodos as p', 'g.periodo_id', '=', 'p.id')
            ->whereRaw('RIGHT(p.periodo, 2) = RIGHT(YEAR(CURDATE()), 2)')
            ->where('a.id', '=', $alumno->id)
            ->get();

        $seguimientoActual = DB::table(DB::raw('( 
                    SELECT id, fecha_ini, fecha_fin, 
                    ROW_NUMBER() OVER (ORDER BY fecha_ini ASC) AS seguimiento_num 
                    FROM periodo_tutorias 
                    WHERE EXTRACT(YEAR FROM fecha_ini) = EXTRACT(YEAR FROM CURRENT_DATE) ) AS registros_ano_actual'))
            ->select(
                'id',
                'fecha_ini',
                'fecha_fin',
                DB::raw("CONCAT(seguimiento_num) AS seguimiento")
            )
            ->whereRaw('CURRENT_DATE BETWEEN fecha_ini AND fecha_fin')
            ->first();

        $tutor = DB::table('tutorias as t')
            ->join('personals as p', 't.personal_id', '=', 'p.id')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->select('p.id', 'p.nombres', 'p.apellidop', 'p.apellidom')
            ->where('a.id', $alumno->id)  // Se asume que es el ID del alumno
            ->first();

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

        $materiasRegSeguimiento = DB::table('rendimientos as r')
            ->select(
                'm.id',
                'm.idMateria',
                'm.nombreMateria',
                'm.semestre',
                'd.nombres',
                'd.apellidop',
                'd.apellidom',
                'r.temasEv',
                'r.resultado',
                'r.asesoria',
                'r.problematica'
            )
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('grupos as g', 'm.id', '=', 'g.materia_id')
            ->join('personals as d', 'g.personal_id', '=', 'd.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->join('periodos as p', 't.periodo_id', '=', 'p.id')
            ->join('periodo_tutorias as pt', 'p.id', '=', 'pt.periodo_id')
            ->where('a.id', '=', $alumno->id)
            ->where('t.periodo_id', '=', $periodos->id)
            ->where('pt.id', '=', $seguimientoActual->id)
            ->get();

        $existeRegistroSeguimiento = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('grupos as g', 'm.id', '=', 'g.materia_id')
            ->join('personals as d', 'g.personal_id', '=', 'd.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->join('periodos as p', 't.periodo_id', '=', 'p.id')
            ->join('periodo_tutorias as pt', 'p.id', '=', 'pt.periodo_id')
            ->where('a.id', '=', $alumno->id)
            ->where('t.periodo_id', '=', $periodos->id)
            ->where('pt.id', '=', $seguimientoActual->id)
            ->count();





        return view('catalogos.formAlumnos.index', compact('materias', 'alumno', 'seguimientoActual', 'tutor', 'periodos', 'materiasRegSeguimiento', 'existeRegistroSeguimiento'));
    }

  public function index2(){
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

        $asesorias = DB::table('asesorias as ase')
            ->join('lugars as l', 'ase.lugar_id', '=', 'l.id')
            ->join('personals as d', 'ase.personal_id', '=', 'd.id')
            ->join('rendimientos as r', 'ase.rendimiento_id', '=', 'r.id')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('periodo_tutorias as pt', 'fa.periodo_tutoria_id', '=', 'pt.id')
            ->select(
                'm.nombreMateria',
                'ase.fecha',
                'ase.horario',
                'l.nombrelugar',
                'd.nombres',
                'd.apellidop',
                'd.apellidom'
            )
            ->where('pt.periodo_id', $periodos->id) // Filtro por periodo
            ->where('a.id', 21) // Filtro por ID de alumno
            ->get();

            return view('catalogos.formAlumnos.tablaalumnos', compact('periodos', 'asesorias'));
    }

  
  }

    public function create()
    {
        
    }


    public function store(Request $request)
    {

        $fechaActual = now()->locale('es')->translatedFormat('d F Y');

        foreach ($request->materias as $materiaId => $materiaData) {
            // Crear registros en una tabla intermedia o relacionada 
            $formAlumno = FormAlumno::create([
                'alumno_id' => $request->alumno_id,
                'periodo_tutoria_id' => $request->periodo_tutoria_id,
                'materia_id' => $materiaId,

            ]);

            // Insertar en la tabla Rendimiento
            Rendimiento::create([
                'temasEv' => $materiaData['temasEv'],
                'resultado' => $materiaData['resultado'],
                'asesoria' => isset($materiaData['asesoria']) ? 1 : 0,
                'problematica' => $materiaData['problematica'] ?? null,
                'form_alumno_id' => $formAlumno->id, // Usar el ID del FormAlumno recién creado
            ]);
        }

        // Cargar la plantilla 
        /* $templateProcessor = new TemplateProcessor(storage_path('app/public/formatoSeguimiento.docx'));

        // Reemplazar los marcadores con los valores 
        $templateProcessor->setValue('{{nomcarrera}}', $request->carrera_id);
        $templateProcessor->setValue('{{fechaactual}}', $fechaActual);
        $templateProcessor->setValue('{{nomtutorado}}', $request->alumnoName);
        $templateProcessor->setValue('{{numcontrol}}', $request->noCtrl);
        $templateProcessor->setValue('{{nomtutor}}', $request->tutorName);

        $templateProcessor->setValue('x1', '✅');
        $templateProcessor->setValue('x2', '❌');
        $templateProcessor->setValue('x3', '❌');
        $templateProcessor->setValue('x4', '❌');

        $templateProcessor->setValue('{{firman}}', $request->alumnoName);
        $templateProcessor->setValue('{{firmat}}', $request->tutorName);

        $templateProcessor->setValue('{{m1}}', 'Materia 1');
        $templateProcessor->setValue('{{m2}}', 'Materia 2');
        $templateProcessor->setValue('{{m3}}', 'Materia 3');
        $templateProcessor->setValue('{{m4}}', 'Materia 4');
        $templateProcessor->setValue('{{m5}}', 'Materia 5');
        $templateProcessor->setValue('{{m6}}', 'Materia 6');
        $templateProcessor->setValue('{{m7}}', 'Materia 7');

        $templateProcessor->setValue('{{d1}}', 'Docente 1');
        $templateProcessor->setValue('{{d2}}', 'Docente 2');
        $templateProcessor->setValue('{{d3}}', 'Docente 3');
        $templateProcessor->setValue('{{d4}}', 'Docente 4');
        $templateProcessor->setValue('{{d5}}', 'Docente 5');
        $templateProcessor->setValue('{{d6}}', 'Docente 6');
        $templateProcessor->setValue('{{d7}}', 'Docente 7');

        $templateProcessor->setValue('{{t1}}', '7');
        $templateProcessor->setValue('{{t2}}', '6');
        $templateProcessor->setValue('{{t3}}', '5');
        $templateProcessor->setValue('{{t4}}', '4');
        $templateProcessor->setValue('{{t5}}', '3');
        $templateProcessor->setValue('{{t6}}', '2');
        $templateProcessor->setValue('{{t7}}', '1');

        $templateProcessor->setValue('{{r1}}', 'A');
        $templateProcessor->setValue('{{r2}}', 'NA');
        $templateProcessor->setValue('{{r3}}', 'A');
        $templateProcessor->setValue('{{r4}}', 'P');
        $templateProcessor->setValue('{{r5}}', 'P');
        $templateProcessor->setValue('{{r6}}', 'NA');
        $templateProcessor->setValue('{{r7}}', 'A');

        $templateProcessor->setValue('{{mp1}}', 'MATERIA PROB 1');
        $templateProcessor->setValue('{{prob1}}', 'PROBLEMATICA 1');
        $templateProcessor->setValue('{{s1}}', '✅');
        $templateProcessor->setValue('{{n1}}', '❌');

        $templateProcessor->setValue('{{mp2}}', 'MATERIA PROB 2');
        $templateProcessor->setValue('{{prob2}}', 'PROBLEMATICA 2');
        $templateProcessor->setValue('{{s2}}', '❌');
        $templateProcessor->setValue('{n2}}', '✅');



        // Agrega más reemplazos según sea necesario 
        // Guardar el archivo resultante 
        $fileName = 'Seguimiento_Tutorias_' . $request->noCtrl . '.docx';
        $templateProcessor->saveAs(storage_path('app/public/' . $fileName));
        // Descargar el archivo 
        return response()->download(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true); */



        return redirect()->route('formalumnos.index')->with('success', 'Seguimiento guardado exitosamente');
    }

    public function show(FormAlumno $formAlumno)
    {
        
    }


    public function edit(FormAlumno $formAlumno)
    {
        
    }


    public function update(Request $request, FormAlumno $formAlumno)
    {
        
    }

    public function destroy(FormAlumno $formAlumno)
    {
        
    }
}