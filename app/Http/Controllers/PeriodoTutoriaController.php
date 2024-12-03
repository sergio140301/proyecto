<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\PeriodoTutoria;
use Illuminate\Http\Request;

class PeriodoTutoriaController extends Controller
{
    public $periodo_id;

    public $pt;
 
    function __construct()
    {
        if (request()->idperiodo) {
            $this->periodo_id = request()->idperiodo;
            session(['periodo_id' => request()->idperiodo]);
        } else {
            $this->periodo_id = (session()->exists('periodo_id') ? session('periodo_id') : "-1");
        }


        $this->pt = PeriodoTutoria::where('periodo_id', $this->periodo_id)->get();
    }

    public function index()
    {
        $periodos = Periodo::get();

        return view(
            'catalogos.periodosTutorias.index',
            [
                'periodos' => $periodos,
                'pt' => $this->pt
            ]
        );
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
        // Iterar sobre todos los posibles índices para procesar solo los seleccionados
        foreach ($request->all() as $key => $value) {
            // Verifica si el checkbox correspondiente está seleccionado
            if (strpos($key, 'checkbox_') === 0) {
                // Extraer el índice del checkbox (ej. checkbox_0, checkbox_1, ...)
                $index = substr($key, 9); // Elimina 'checkbox_' del nombre

                // Verificar si la fecha de inicio y fin también están presentes
                $fecha_ini = $request->input("fecha_ini_{$index}");
                $fecha_fin = $request->input("fecha_fin_{$index}");

                if ($fecha_ini && $fecha_fin) {

                    $existe = PeriodoTutoria::where('periodo_id', $this->periodo_id)
                        ->where('fecha_ini', $fecha_ini)
                        ->where('fecha_fin', $fecha_fin)
                        ->first();

                    if (is_null($existe)) {
                        PeriodoTutoria::create([
                            'periodo_id' => $this->periodo_id,
                            'fecha_ini' => $fecha_ini,
                            'fecha_fin' => $fecha_fin,
                        ]);
                    }
                }
           
            }

            if (request()->eliminar and request()->eliminar != "NOELIMINAR") {
                $fechas = explode('|', $request->eliminar); 
                $fecha_ini = $fechas[0]; 
                $fecha_fin = $fechas[1];

                PeriodoTutoria::where('periodo_id', $this->periodo_id) 
                ->where('fecha_ini', $fecha_ini) 
                ->where('fecha_fin', $fecha_fin) 
                ->delete();

                return redirect()->route('periodotutorias.index');
            }

            
        }

        return redirect()->route('periodotutorias.index')->with('success', 'Periodo Tutorías guardadas exitosamente');
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