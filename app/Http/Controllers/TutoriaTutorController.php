<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\TutoriaTutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TutoriaTutorController extends Controller
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

        $tutordealumnos = DB::table('personals')
            ->select('id', 'nombres', 'apellidop', 'apellidom')
            ->where('id', 1) // ID del tutor loggeado
            ->first();

        $alumnostutorados = DB::table('tutorias as t')
            ->select(
                't.id',
                'a.noctrl',
                'a.nombre',
                'a.apellidop',
                'a.apellidom',
                'c.nombreCarrera',
                't.semestreAlumno',
                DB::raw("CASE
                WHEN a.noctrl IN (
                    SELECT a.noctrl
                    FROM rendimientos as r
                    INNER JOIN form_alumnos as fa ON r.form_alumno_id = fa.id
                    INNER JOIN periodo_tutorias as pt ON fa.periodo_tutoria_id = pt.id
                    INNER JOIN alumnos as a ON fa.alumno_id = a.id
                    WHERE pt.periodo_id = 2
                ) THEN 'Registrado'
                ELSE 'Pendiente'
            END AS RegistroRendimientos")
            )
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->join('personals as d', 't.personal_id', '=', 'd.id')
            ->where('d.id', 1) //id tutor loggeado
            ->where('t.periodo_id', $this->periodo_id)
            ->get();


        return view('catalogos.tutoriastutor.tablatutor', compact('periodos', 'tutordealumnos', 'alumnostutorados'));
    }

    public function store(Request $request) {}

    public function show($noctrl, $idperiodo)
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
            ->where('a.noctrl', $noctrl) // parametro num de control
            ->first(); // Se usa first para obtener un solo registro


        $rendimientos = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->select(
                'm.nombreMateria',
                'm.semestre',
                'r.temasEv',
                'r.resultado'
            )
            ->where('a.noctrl', $noctrl) // parametro num control
            ->where('t.periodo_id', $idperiodo) // parametro periodo
            ->get();

        $existenRendimientos = DB::table('rendimientos as r')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('carreras as c', 'a.carrera_id', '=', 'c.id')
            ->join('tutorias as t', 'a.id', '=', 't.alumno_id')
            ->where('a.noctrl', $noctrl)
            ->where('t.periodo_id', $idperiodo)
            ->count();


        return view("catalogos.tutoriastutor.verrendimientos", compact('alumno', 'rendimientos', 'existenRendimientos'));
    }

    public function generarExcel()
    {
        $fechaActual = now()->locale('es')->translatedFormat('d F Y');

        $tutor = DB::table('personals')
            ->select('id', 'nombres', 'apellidop', 'apellidom')
            ->where('id', 1) // ID del tutor loggeado
            ->first();

        $nombretutor = 'TUTOR: ' . $tutor->nombres . ' ' . $tutor->apellidop . ' ' . $tutor->apellidom;

        $periodo = DB::table('periodos')
            ->select('id', 'periodo')
            ->where('id', $this->periodo_id)
            ->first();

        $nomperiodo = 'PERIODO: ' . $periodo->periodo;

        $totalHombres = DB::table('personals as d')
            ->join('tutorias as t', 'd.id', '=', 't.personal_id')
            ->join('periodos as p', 't.periodo_id', '=', 'p.id')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->where('d.id', 1) // ID del tutor loggeado
            ->where('p.id', $this->periodo_id)
            ->where('a.sexo', 'M')
            ->count();

        $totalMujeres = DB::table('personals as d')
            ->join('tutorias as t', 'd.id', '=', 't.personal_id')
            ->join('periodos as p', 't.periodo_id', '=', 'p.id')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->where('d.id', 1)
            ->where('p.id', $this->periodo_id)
            ->where('a.sexo', 'F')
            ->count();

        $tutorados = DB::table('personals as d')
            ->join('tutorias as t', 'd.id', '=', 't.personal_id')
            ->join('periodos as p', 't.periodo_id', '=', 'p.id')
            ->join('alumnos as a', 't.alumno_id', '=', 'a.id')
            ->select('a.noctrl', 'a.nombre', 'a.apellidop', 'a.apellidom')
            ->where('d.id', 1) //ID TUTOR LOGGEADO
            ->where('p.id', $this->periodo_id)
            ->get();

        $materiasAsesorias = DB::table('asesorias as ase')
            ->join('rendimientos as r', 'ase.rendimiento_id', '=', 'r.id')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('grupos as g', 'm.id', '=', 'g.materia_id')
            ->join('personals as d', 'g.personal_id', '=', 'd.id')
            ->select(
                'm.nombreMateria',
                DB::raw("CONCAT(d.nombres, ' ', d.apellidop, ' ', d.apellidom) as docente")
            )
            ->where('g.periodo_id', $this->periodo_id)
            ->groupBy('m.nombreMateria', DB::raw("CONCAT(d.nombres, ' ', d.apellidop, ' ', d.apellidom)"))
            ->get();

        $requiereAs = DB::table('asesorias as ase')
            ->join('rendimientos as r', 'ase.rendimiento_id', '=', 'r.id')
            ->join('form_alumnos as fa', 'r.form_alumno_id', '=', 'fa.id')
            ->join('alumnos as a', 'fa.alumno_id', '=', 'a.id')
            ->join('materias as m', 'fa.materia_id', '=', 'm.id')
            ->join('grupos as g', 'm.id', '=', 'g.materia_id')
            ->join('personals as d', 'g.personal_id', '=', 'd.id')
            ->select(
                'r.problematica',
                'r.asesoria',
                DB::raw("CONCAT(a.apellidop, ' ', a.apellidom, ' ', a.nombre) as nomAlumno"),
                DB::raw("CONCAT(m.nombreMateria, '/', d.nombres, ' ', d.apellidop, ' ', d.apellidom) as MateriaAsesoria")
            )
            ->where('g.periodo_id', 2)
            ->get();

        $seguimientoActual = DB::table(DB::raw('(
                SELECT id, fecha_ini, fecha_fin,
                ROW_NUMBER() OVER (ORDER BY fecha_ini ASC) AS seguimiento_num
                FROM periodo_tutorias
                WHERE EXTRACT(YEAR FROM fecha_ini) = EXTRACT(YEAR FROM CURRENT_DATE) ) AS registros_ano_actual'))
            ->select(
                DB::raw("CONCAT('Seguimiento No. ', seguimiento_num) AS seguimiento")
            )
            ->whereRaw('CURRENT_DATE BETWEEN fecha_ini AND fecha_fin')
            ->first();


        // Ruta al archivo de la plantilla subida
        $filePath = storage_path('app/public/reporteSeguimiento.xlsx');

        // Cargar la plantilla
        $spreadsheet = IOFactory::load($filePath);

        // Obtener la hoja activa (puedes especificar la hoja si es necesario)
        $sheet = $spreadsheet->getActiveSheet();

        // Asignar valores a las celdas
        $sheet->setCellValue('A6', $seguimientoActual->seguimiento);
        $sheet->setCellValue('A7', $fechaActual);
        $sheet->setCellValue('A9', $nombretutor);
        $sheet->setCellValue('A10', $nomperiodo);
        $sheet->setCellValue('D39', $totalHombres);
        $sheet->setCellValue('G39', $totalMujeres);
        $sheet->setCellValue('B45', $tutor->nombres . ' ' . $tutor->apellidop . ' ' . $tutor->apellidom);

        //ALUMNOS TUTORADOS
        // Iniciar fila donde se enlistarán los alumnos
        $startRow = 13;
        // Recorrer los tutorados y escribirlos en la hoja
        foreach ($tutorados as $index => $tutorado) {
            $currentRow = $startRow + $index; // Incrementar fila para cada alumno
            // Escribir nombre completo del alumno en la columna B
            $sheet->setCellValue('B' . $currentRow, $tutorado->apellidop . ' ' . $tutorado->apellidom . ' ' . $tutorado->nombre);
        }

        //MATERIAS QUE REQUIEREN ASESORIA
        $startColumn = 'D'; // Columna inicial
        $currentColumn = $startColumn; // Empieza en la columna D

        // Recorrer los tutorados y escribirlos en la hoja
        foreach ($materiasAsesorias as $index => $materia) {
            // Escribir nombre completo del alumno en la columna correspondiente
            $sheet->setCellValue($currentColumn . '9', $materia->nombreMateria . '/' . $materia->docente);

            // Moverse a la siguiente columna
            $currentColumn++; // Avanzar a la siguiente columna
        }

        //BUSCAR COINCIDENCIAS PARA MARCAR X Y ASIGNAR VALORES A LAS COLUMNAS W Y X
        foreach ($requiereAs as $as) {
            // Buscar coincidencias en la columna B (fila 13 a 37)
            $nombreAlumno = $as->nomAlumno; // "CONCAT(a.apellidop, ' ', a.apellidom, ' ', a.nombre)"
            for ($row = 13; $row <= 37; $row++) {
                $cellValue = $sheet->getCell('B' . $row)->getValue();
                if (trim($cellValue) == trim($nombreAlumno)) {
                    // Si encuentra una coincidencia, buscar la materia en la fila 9 (de la columna D a U)
                    $materiaAsesoria = $as->MateriaAsesoria; // "CONCAT(m.nombreMateria, '/', d.nombres, ' ', d.apellidop, ' ', d.apellidom)"
                    for ($col = 'D'; $col <= 'U'; $col++) {
                        $cellValue = $sheet->getCell($col . '9')->getValue();
                        if (trim($cellValue) == trim($materiaAsesoria)) {
                            // Si encuentra la coincidencia, colocar "X" en la celda correspondiente
                            $sheet->setCellValue($col . $row, 'X');

                            // Si la asesoría es igual a 1, se marca la columna W con "X" y la columna X con vacio ""
                            if ($as->asesoria == 1) {
                                $sheet->setCellValue('W' . $row, 'X');
                                $sheet->setCellValue('X' . $row, ''); // Dejar vacía la columna X
                            }
                            // Si la asesoría es igual a 0, las columnas W y X quedan sin cambios
                            elseif ($as->asesoria == 0) {
                                // No se realiza ningún cambio en W y X
                            }

                            // Asignar el valor de la problemática a la columna V
                            $sheet->setCellValue('V' . $row, $as->problematica);
                        }
                    }
                }
            }
        }




        // Configurar el nombre del archivo para la descarga
        $fileName = 'Reporte_Seguimiento_' . $fechaActual . '.xlsx';

        // Guardar el archivo temporalmente y descargarlo
        $tempPath = storage_path('app/public/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        // Descargar el archivo
        return response()->download($tempPath)->deleteFileAfterSend(true);
    }
}
