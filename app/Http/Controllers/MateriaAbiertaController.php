<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Materia;
use App\Models\MateriaAbierta;
use App\Models\Periodo;
use Illuminate\Http\Request;

class MateriaAbiertaController extends Controller
{

    //4 VARIABLES EN INDEX Y STORE TENER PRESENTES

    public $ma;
    public $periodo_id;
    public $carrera_id;

    //creamos constructor
    function __construct()
    {

        //if para periodo, se envio id periodo?, esdecir
        //el usuario selecciono el periodo?
        if (request()->idperiodo) {

            $this->periodo_id = request()->idperiodo;

            //lo guardas en una variable session
            session(['periodo_id' => request()->idperiodo]);

        } else {

            //if es ? y else :
            $this->periodo_id = (session()->exists('periodo_id') ? session('periodo_id') : "-1");

        }


        // if (request()->idcarrera) {

        //     $this->carrera_id = request()->idcarrera;

        //     session(['carrera_id' => request()->idcarrera]);

        // } else {

        //     $this->carrera_id = (session()->exists('carrera_id') ? session('carrera_id') : "-1");

        // }

        //me traigo 1 carrera por eso en singular

    //     $this->carrera = Carrera::with("reticulas.materias")->where('id', $this->carrera_id)->get();

    //    //voy a traerme a todas la materias abiertas que correspone al periodo
    //     $this->ma = MateriaAbierta::where('periodo_id', $this->periodo_id)

    //         ->where('carrera_id', $this->carrera_id)

    //         ->get();

    }

    public function index()
    {

        $periodos = Periodo::get(); // Obtener todos los periodos
        // $carreras = Carrera::all(); // Obtener todas las carreras
       
        

        return view("catalogos.materiasabiertas.index", 
        [

            // 'carreras' => $carreras,
            
            'periodos' => $periodos,
            
            // 'carrera' => $this->carrera,
            
            'ma' => $this->ma
            
        ]);
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
        foreach ($request->all() as $key => $value) {

            if (substr($key, 0, 1) == 'm') {

                $existe = $this->ma->firstWhere('materia_id', $request->$key);

                if ($this->periodo_id == $existe) {

                    MateriaAbierta::create([

                        'periodo_id' => $this->periodo_id,

                        // 'carrera_id' => $this->carrera_id,

                        'materia_id' => $value

                    ]);

                }

            }


            if (request()->eliminar and request()->eliminar != "NOELIMINAR") {

                $existe = $this->ma->firstWhere('materia_id', $request->eliminar);

                $existe->delete();

                return redirect()->route('materiasabiertas.index');

            }

        }

        return redirect()->route('materiasabiertas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MateriaAbierta $materiaAbierta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MateriaAbierta $materiaAbierta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MateriaAbierta $materiaAbierta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MateriaAbierta $materiaAbierta)
    {
        //
    }
}
