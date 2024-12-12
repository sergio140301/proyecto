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

        $materias = DB::table('materias as m')
            ->select('m.id', 'm.idMateria', 'm.nombreMateria', 'm.semestre', 'pe.nombres', 'pe.apellidop', 'pe.apellidom')
            ->join('grupos as g', 'm.id', '=', 'g.materia_id')
            ->join('personals as pe', 'g.personal_id', '=', 'pe.id')
            ->join('horario_alumnos as ha', 'g.id', '=', 'ha.grupo_id')
            ->join('alumnos as a', 'ha.alumno_id', '=', 'a.id')
            ->join('periodos as p', 'g.periodo_id', '=', 'p.id')
            ->where('p.id', '=', $periodos->id)
            ->where('a.id', '=', $alumno->id)
            ->get();



        $tutor = DB::table('tutorias as t')
            ->join('personals as p', 't.personal_id', '=', 'p.id')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->select('p.id', 'p.nombres', 'p.apellidop', 'p.apellidom')
            ->where('a.id', $alumno->id)  // Se asume que es el ID del alumno
            ->where('t.periodo_id', $periodos->id)
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

    public function index2()
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
            ->where('a.id', 22) // Filtro por ID de alumno
            ->get();

        return view('catalogos.formAlumnos.asesoriasalumno', compact('periodos', 'asesorias'));
    }


    public function store(Request $request)
    {

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
                'seguimiento' =>  $request->numSeguimiento,
                'form_alumno_id' => $formAlumno->id, // Usar el ID del FormAlumno recién creado
            ]);
        }

        return redirect()->route('formalumnos')->with('success', 'Seguimiento guardado correctamente.');
    }

    public function generaReporte()
    {
        $periodoActual = DB::table('periodos')
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



        $fechaRendimiento = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('periodo_tutorias as pt', 'fa.periodo_tutoria_id', '=', 'pt.id')
            ->select(DB::raw("DATE_FORMAT(r.created_at, '%d-%m-%Y') AS fechaR"))
            ->where('fa.alumno_id', 22) //id alumno loggeado
            ->where('pt.periodo_id', $periodoActual->id)
            ->orderBy('r.created_at', 'ASC')
            ->first();



        $infoTutorado = DB::table('tutorias as t')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->join('personals as d', 't.personal_id', '=', 'd.id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->select(
                'c.nombreCarrera',
                DB::raw("CONCAT(a.nombre, ' ', a.apellidop, ' ', a.apellidom) as nombreAlumno"),
                'a.noctrl',
                DB::raw("CONCAT(d.nombres, ' ', d.apellidop, ' ', d.apellidom) as docente")
            )
            ->where('a.id', 22) //id alumno loggeado
            ->where('t.periodo_id', $periodoActual->id)
            ->first();


        $materias = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('grupos as g', 'm.id', '=', 'g.materia_id')
            ->join('personals as d', 'g.personal_id', '=', 'd.id')
            ->select(
                'm.nombreMateria',
                DB::raw("CONCAT(d.nombres, ' ', d.apellidop, ' ', d.apellidom) as maestro"),
                'r.temasEv',
                'r.resultado'
            )
            ->where('fa.alumno_id', 22) //id alumno loggeado
            ->where('g.periodo_id', $periodoActual->id)
            ->get();


        $templateProcessor = new TemplateProcessor(storage_path('app/public/formatoSeguimiento.docx'));

        //marcadores
        $templateProcessor->setValue('${fecha}', $fechaRendimiento->fechaR);

        $templateProcessor->setValue('${nomcarrera}', $infoTutorado->nombreCarrera);
        $templateProcessor->setValue('${nombretutorado}', $infoTutorado->nombreAlumno);
        $templateProcessor->setValue('${numcontrol}', $infoTutorado->noctrl);
        $templateProcessor->setValue('${nombretutor}', $infoTutorado->docente);
        $templateProcessor->setValue('${firmatutorado}', $infoTutorado->nombreAlumno);
        $templateProcessor->setValue('${firmatutor}', $infoTutorado->docente);

        $templateProcessor->cloneRow('n', count($materias));
        foreach ($materias as $index => $materia) {
            $rowIndex = $index + 1;

            $templateProcessor->setValue("n#{$rowIndex}", $rowIndex);
            $templateProcessor->setValue("materia#{$rowIndex}", $materia->nombreMateria);
            $templateProcessor->setValue("maestro#{$rowIndex}", $materia->maestro);
            $templateProcessor->setValue("tem#{$rowIndex}", $materia->temasEv);
            $templateProcessor->setValue("res#{$rowIndex}", $materia->resultado);
        }


        $fileName = 'Seguimiento_Tutorias_' . $infoTutorado->noctrl . '.docx';
        $templateProcessor->saveAs(storage_path('app/public/' . $fileName));

        return response()->download(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);
    }

    public function generaReporteAsesoria()
    {
        $periodoActual = DB::table('periodos')
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



        $fechaRendimiento = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('periodo_tutorias as pt', 'fa.periodo_tutoria_id', '=', 'pt.id')
            ->select(DB::raw("DATE_FORMAT(r.created_at, '%d-%m-%Y') AS fechaR"))
            ->where('fa.alumno_id', 22) //id alumno loggeado
            ->where('pt.periodo_id', $periodoActual->id)
            ->orderBy('r.created_at', 'ASC')
            ->first();



        $infoTutorado = DB::table('tutorias as t')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->join('personals as d', 't.personal_id', '=', 'd.id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->select(
                'c.nombreCarrera',
                DB::raw("CONCAT(a.nombre, ' ', a.apellidop, ' ', a.apellidom) as nombreAlumno"),
                'a.noctrl',
                DB::raw("CONCAT(d.nombres, ' ', d.apellidop, ' ', d.apellidom) as docente")
            )
            ->where('a.id', 22) //id alumno loggeado
            ->where('t.periodo_id', $periodoActual->id)
            ->first();


        $materias = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('grupos as g', 'm.id', '=', 'g.materia_id')
            ->join('personals as d', 'g.personal_id', '=', 'd.id')
            ->select(
                'm.nombreMateria',
                DB::raw("CONCAT(d.nombres, ' ', d.apellidop, ' ', d.apellidom) as maestro"),
                'r.temasEv',
                'r.resultado'
            )
            ->where('fa.alumno_id', 22) //id alumno loggeado
            ->where('g.periodo_id', $periodoActual->id)
            ->get();

        $asesoriaReg = DB::table('asesorias as ase')
            ->join('lugars as l', 'ase.lugar_id', '=', 'l.id')
            ->join('personals as d', 'ase.personal_id', '=', 'd.id')
            ->join('rendimientos as r', 'ase.rendimiento_id', '=', 'r.id')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('periodo_tutorias as pt', 'fa.periodo_tutoria_id', '=', 'pt.id')
            ->select(
                'r.problematica',
                'm.nombreMateria',
                'm.semestre',
                'ase.fecha',
                'ase.horario',
                'l.nombrelugar',
                'd.nombres',
                'd.apellidop',
                'd.apellidom'
            )
            ->where('a.id', 22)
            ->where('pt.periodo_id', $periodoActual->id)
            ->get();


        $templateProcessor = new TemplateProcessor(storage_path('app/public/formatoSeguimiento.docx'));

        //marcadores
        $templateProcessor->setValue('${fecha}', $fechaRendimiento->fechaR);

        $templateProcessor->setValue('${nomcarrera}', $infoTutorado->nombreCarrera);
        $templateProcessor->setValue('${nombretutorado}', $infoTutorado->nombreAlumno);
        $templateProcessor->setValue('${numcontrol}', $infoTutorado->noctrl);
        $templateProcessor->setValue('${nombretutor}', $infoTutorado->docente);
        $templateProcessor->setValue('${firmatutorado}', $infoTutorado->nombreAlumno);
        $templateProcessor->setValue('${firmatutor}', $infoTutorado->docente);

        $templateProcessor->cloneRow('n', count($materias));
        foreach ($materias as $index => $materia) {
            $rowIndex = $index + 1;

            $templateProcessor->setValue("n#{$rowIndex}", $rowIndex);
            $templateProcessor->setValue("materia#{$rowIndex}", $materia->nombreMateria);
            $templateProcessor->setValue("maestro#{$rowIndex}", $materia->maestro);
            $templateProcessor->setValue("tem#{$rowIndex}", $materia->temasEv);
            $templateProcessor->setValue("res#{$rowIndex}", $materia->resultado);
        }

        $templateProcessor->cloneRow('lblmat', count($asesoriaReg));
        foreach ($asesoriaReg as $index => $asesoria) {
            $rowIndex = $index + 1;

            $templateProcessor->setValue("lblmat#{$rowIndex}", "Materia:");
            $templateProcessor->setValue("materiaProb#{$rowIndex}", $asesoria->nombreMateria);

            $templateProcessor->setValue("lblprob#{$rowIndex}", "Problemática:");
            $templateProcessor->setValue("problematica#{$rowIndex}", $asesoria->problematica);

            $templateProcessor->setValue("lblreq#{$rowIndex}", "Requiere Asesoría:");
            $templateProcessor->setValue("requiere#{$rowIndex}", "Sí");

            $templateProcessor->setValue("canalizo#{$rowIndex}", "Se canalizó con:");
            $templateProcessor->setValue("asesor#{$rowIndex}", "Asesor: " . $asesoria->nombres . ' ' . $asesoria->apellidop . ' ' . $asesoria->apellidom);
            $templateProcessor->setValue("lugar#{$rowIndex}", "Lugar: " . $asesoria->nombrelugar);
            $templateProcessor->setValue("fechaAs#{$rowIndex}", "Fecha: " . $asesoria->fecha);
            $templateProcessor->setValue("horarioas#{$rowIndex}", "Horario: " . $asesoria->horario);
        }


        $fileName = 'Seguimiento_Tutorias_' . $infoTutorado->noctrl . '.docx';
        $templateProcessor->saveAs(storage_path('app/public/' . $fileName));

        return response()->download(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);
    }
}
