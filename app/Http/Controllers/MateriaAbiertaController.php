<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Periodo;
use Illuminate\Http\Request;
use App\Models\MateriaAbierta;



class MateriaAbiertaController extends Controller
{

    public $carrera;
    public $ma;
    public $periodo_id;
    public $carrera_id;

    function __construct()
    {
        if (request()->idperiodo) {
            $this->periodo_id = request()->idperiodo;
            session(['periodo_id' => request()->idperiodo]);
        } else {
            $this->periodo_id = (session()->exists('periodo_id') ? session('periodo_id') : "-1");
        }

        if (request()->idcarrera) {
            $this->carrera_id = request()->idcarrera;
            session(['carrera_id' => request()->idcarrera]);
        } else{
            $this->carrera_id = (session()->exists('carrera_id') ? session('carrera_id') : "-1");
        }

        $this->carrera = Carrera::with("reticulas.materias")->where('id', $this->carrera_id)->get();

        $this->ma = MateriaAbierta::where('periodo_id', $this->periodo_id)
            ->where('carrera_id', $this->carrera_id)
            ->get();
    }    

    public function index()
    {
        // return request()->all();
        $periodos = Periodo::get();
        $carreras = Carrera::get();
        
        return view("catalogos.materiasabiertas.index",
                                    ['periodos'=>$periodos,
                                    'carreras'=>$carreras,
                                    'carrera'=>$this->carrera,
                                    'ma'=>$this->ma
                                    ]);
    }

    public function store(Request $request)
    { 
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 1) == 'm') {
                $existe = $this->ma->firstWhere('materia_id', $request->$key);
                if (is_null($existe) and $this->periodo_id != "-1" and $this->carrera_id != "-1") {
                    MateriaAbierta::create([
                        'periodo_id' => $this->periodo_id,
                        'carrera_id' => $this->carrera_id,
                        'materia_id' => $value
                    ]);
                }
            }

            //return request()->eliminar; 
            if (request()->eliminar and request()->eliminar !="NOELIMINAR"){
                //return "entro";
                $existe = MateriaAbierta::where('materia_id', $request->eliminar)
                                    ->where('periodo_id',$this->periodo_id)
                                    ->delete();
                return redirect()->route('materiasabiertas.index');        
            }
        }
        return redirect()->route('materiasabiertas.index');
    }

    

}
