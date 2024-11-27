<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;

class ReportController extends Controller
{ public function view(): \Illuminate\Contracts\View\View
    {
        // Retorna la vista con los datos que deseas exportar
        return view('exportar.reporte', [
            'data' => [
                ['No.' => 1, 'Materia' => 'Inteligencia Artificial', 'Maestro' => 'López Ramírez Tomas', 'Temas evaluados' => 4, 'Resultado' => 'P'],
                ['No.' => 2, 'Materia' => 'Programación Web II', 'Maestro' => 'Chávez Soto Antonio', 'Temas evaluados' => 3, 'Resultado' => 'R'],
                ['No.' => 3, 'Materia' => 'Programación Móvil Multiplataformas', 'Maestro' => 'Rodriguez Cervantes Rogelio Cesar', 'Temas evaluados' => 4, 'Resultado' => 'P'],
            ]
        ]);
    }
}
