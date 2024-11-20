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
        //verifica si se seleccionó algun periodo en el select y se trae el id
        //en caso de que sí, se guarda en sesion
        //si no, asigna un -1
        if (request()->idperiodo) {
            $this->periodo_id = request()->idperiodo;
            session(['periodo_id' => request()->idperiodo]);
        } else {
            $this->periodo_id = (session()->exists('periodo_id') ? session('periodo_id') : "-1");
        }

        //verifica si se seleccionó alguna carrera en el select y se trae el id
        //si sí, se guarda en sesion
        //si no, asigna un -1
        if (request()->idcarrera) {
            $this->carrera_id = request()->idcarrera;
            session(['carrera_id' => request()->idcarrera]);
        } else{
            $this->carrera_id = (session()->exists('carrera_id') ? session('carrera_id') : "-1");
        }

        //hace la consulta que trae el nombre de la carrera, las reticulas de esa carrera y
        //las materias de esa reticula (inner join)
        //las carreras se cargan en el select
        //dependiendo de la carrera que se seleccione, se busca por idcarrera 
        //y carga las materias en los checkbox
        //ese 'id' es de la tabla Carreras
        $this->carrera = Carrera::with("reticulas.materias")->where('id', $this->carrera_id)->get();

        //consulta todas las materias que se abrieron (cuando ya se insertaron datos en tabla materias_abiertas)
        //las filtra por periodo y por carrera con los select y sus ids
        $this->ma = MateriaAbierta::where('periodo_id', $this->periodo_id)
                                    ->where('carrera_id', $this->carrera_id)
                                    ->get();
    }    

    public function index()
    {
        //¿que tablas 'principales' se consultan en esta vista?
        //necesitamos informacion de Periodo y Carrera en esta vista
        //no es necesario escribir las tablas de reticulas y materias, 
        //porque ya tenemos esa consulta multiple en el constructor
        $periodos = Periodo::get();
        $carreras = Carrera::get();
        
        //¿por que algunas tienen $this?
        //porque son las variables en las que se guardó información especifica (consultas inner join)
        return view("catalogos.materiasabiertas.index",
                                    ['periodos'=>$periodos,
                                    'carreras'=>$carreras,
                                    'carrera'=>$this->carrera,
                                    'ma'=>$this->ma
                                    ]);
    }

    public function store(Request $request)
    { 
        //se utiliza un foreach porque son varias las materias que se pueden insertar (con los check)
        //la cantidad de checkbox seleccionados, es la cantidad de registros
        foreach ($request->all() as $key => $value) { //la $key es el name unico que le dimos a cada check.Lo asignamos a variable $value
            if (substr($key, 0, 1) == 'm') { //quita la letra (el primer caracter '0,1') que le dimos para el name unico 
                                            //y deja solo el valor del id de la materia
                                        //el 0 es la posicion inicial desde donde se extra el texto y el 1 la cant de caracteres a quitar
                $existe = $this->ma->firstWhere('materia_id', $request->$key); //consulta en la bd (tabla materiasAbiertas)
                                                                                //si existe ese idmateria
                                                                                //si existe, ya se abrió esa materia
                                                                                //si no, puede abrirse (insertar datos en tabla)

                //si se seleccionan elementos en el select de periodo y de carrera,
                //y ademas ya verificó que no existe ese id de materia (no se ha abierto esa materia),
                //entonces inserta en la tabla de MateriaAbierta
                if (is_null($existe) and $this->periodo_id != "-1" and $this->carrera_id != "-1") {
                    MateriaAbierta::create([
                        'periodo_id' => $this->periodo_id,
                        'carrera_id' => $this->carrera_id,
                        'materia_id' => $value //como usamos un ciclo, se insertan varios registros
                        //dependiendo cuantas materias se seleccionaron en los checkbox
                        //se inserta el mismo periodo, la misma carrera, solo diferente materia
                    ]);
                }
            }

            //si se interactuó con el elemento con name 'eliminar' (tiene un valor) y su valor es distinto a 'NOELIMINAR' (valor default)
            //entonces quiere decir que se debe eliminar algo (se desmarcó un check)
            if (request()->eliminar and request()->eliminar !="NOELIMINAR"){ //el request obtiene el valor(materia_id), 
                                                                            //que se obtiene con el JS
                $existe = MateriaAbierta::where('materia_id', $request->eliminar) //elimina el registro en tabla materiasAbiertas
                                    ->where('periodo_id',$this->periodo_id)        //que tenga ese materia_id 
                                    ->delete();                                    //y ese periodo_id(guardado en session, 
                                                                            //el cual debe estar seleccionado en el select en ese momento)
                return redirect()->route('materiasabiertas.index');        
            }
        }
        return redirect()->route('materiasabiertas.index');
    }

    

}
