<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\PeriodoTutoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodoTutoriaController extends Controller
{

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

        $seguimientosAbiertos = DB::table('periodo_tutorias as pt')
            ->join('periodos as p', 'pt.periodo_id', '=', 'p.id')
            ->select('pt.fecha_ini', 'pt.fecha_fin')
            ->where('p.id', $periodos->id)
            ->get();

        $existenSeguimientos = DB::table('periodo_tutorias as pt')
            ->join('periodos as p', 'pt.periodo_id', '=', 'p.id')
            ->where('p.id', 2)
            ->count();



        return view('catalogos.periodosTutorias.index', compact('periodos', 'seguimientosAbiertos', 'existenSeguimientos'));
    }

    public function create() {}

    public function store(Request $request)
    {
        $periodo_id = $request->input('idperiodo');
        $cantidad_seguimientos = $request->input('cantidad_seguimientos');

        // Recorrer cada seguimiento para insertar en la base de datos
        for ($i = 1; $i <= $cantidad_seguimientos; $i++) {
            $fecha_ini = $request->input("fecha_ini_$i");
            $fecha_fin = $request->input("fecha_fin_$i");

            // Solo guardar si ambas fechas están presentes
            if ($fecha_ini && $fecha_fin) {
                // Crear un nuevo registro en la tabla PeriodoTutoria
                PeriodoTutoria::create([
                    'periodo_id' => $periodo_id,
                    'fecha_ini' => $fecha_ini,
                    'fecha_fin' => $fecha_fin,
                ]);
            }
        }

        // Redirigir con mensaje de éxito
        return redirect()->route('periodotutorias')->with('success', 'Seguimientos abiertos correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PeriodoTutoria $periodoTutoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeriodoTutoria $periodoTutoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PeriodoTutoria $periodoTutoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeriodoTutoria $periodoTutoria)
    {
        //
    }
}