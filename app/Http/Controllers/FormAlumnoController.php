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



        return view('catalogos.formAlumnos.index', compact('materias', 'alumno', 'seguimientoActual', 'tutor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'materias' => 'required|array',
            'materias.*.id' => 'required|exists:materias,id',
            'alumno_id' => 'required|exists:alumnos,id',
            'periodo_tutoria_id' => 'required|exists:periodo_tutorias,id',

            'materias.*.temasEv' => 'required|integer|min:1|max:7',
            'materias.*.resultado' => 'required|string|in:A,NA,P',
            'materias.*.problematica' => 'nullable|string',
            'materias.*.asesoria' => 'boolean'
        ]);

        $fechaActual = now()->locale('es')->translatedFormat('d F Y');


        foreach ($request->materias as $materia) {
            $formAlumno = FormAlumno::create([
                'materia_id' => $materia['id'],
                'alumno_id' => $request->alumno_id,
                'periodo_tutoria_id' => $request->periodo_tutoria_id,
            ]);

            Rendimiento::create([
                'temasEv' => $materia['temasEv'],
                'resultado' => $materia['resultado'],
                'asesoria' => isset($materia['asesoria']) ? 1 : 0,
                'problematica' => $materia['problematica'] ?? null,
                'form_alumno_id' => $formAlumno->id

            ]);
        } 

        // Cargar la plantilla 
        $templateProcessor = new TemplateProcessor(storage_path('app/public/formatoSeguimiento.docx'));
 
        // Reemplazar los marcadores con los valores 
        $templateProcessor->setValue('{{carrera}}', $request->carrera_id); 
        $templateProcessor->setValue('{{nombreAlumno}}', $request->alumnoName); 
        $templateProcessor->setValue('{{noControl}}', $request->noCtrl); 
        $templateProcessor->setValue('{{nombreTutor}}', $request->tutorName); 
        $templateProcessor->setValue('{{fechaActual}}', $fechaActual); 
        $templateProcessor->setValue('{{firmaTutorado}}', $request->alumnoName);
        $templateProcessor->setValue('{{firmaTutor}}', $request->tutorName);
        $templateProcessor->setValue('{{s1}}', $request->numSeguimiento);
        // Agrega más reemplazos según sea necesario 
        // Guardar el archivo resultante 
        $fileName = 'Seguimiento_Tutorias_' . $request->noCtrl . '.docx'; 
        $templateProcessor->saveAs(storage_path('app/public/' . $fileName)); 
        // Descargar el archivo 
        return response()->download(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);



        return redirect()->route('formalumnos.index')->with('success', 'Seguimiento guardado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(FormAlumno $formAlumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormAlumno $formAlumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormAlumno $formAlumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormAlumno $formAlumno)
    {
        //
    }
}