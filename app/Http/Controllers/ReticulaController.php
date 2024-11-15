<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Reticula;
use Illuminate\Http\Request;

class ReticulaController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'idReticula' => 'required|string|max:15|unique:reticulas,idReticula',
            'Descripcion' => 'required|string|max:255',
            'fechaEnVigor' => 'required|date',
            'carrera_id' => 'required|exists:carreras,id', // Asegúrate de que la carrera exista
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); // Inicializa con un valor por defecto

        $reticulas = Reticula::when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('Descripcion', 'like', '%' . $txtBuscar . '%'); // Filtra por descripción
            })
            ->paginate(5);

        return view("catalogos.reticulas.index", compact("reticulas", "txtBuscar")); // Pasa $txtBuscar a la vista
    }

    public function create()
    {
        $reticulas = Reticula::paginate(5);
        $reticula = new Reticula; 

        $carreras = Carrera::all(); // Asegúrate de que estás importando el modelo Carrera

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";

        return view("catalogos.reticulas.frm", compact("reticulas", "reticula", "accion", "txtbtn", "desabilitado", "carreras"));
    }

    public function store(Request $request)
    {
        // Validar datos
        $validado = $request->validate($this->validado);
        Reticula::create($validado);

        return redirect()->route('reticulas.index')->with('success', 'Retícula creada con éxito');
    }

    public function show(Reticula $reticula)
    {
        $reticulas = Reticula::paginate(5);
        $carreras = Carrera::all();

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.reticulas.frm', compact('reticulas', 'reticula', 'accion', 'txtbtn', 'desabilitado', 'carreras'));
    }

    public function edit(Reticula $reticula)
    {
        $reticulas = Reticula::paginate(5);
        $carreras = Carrera::all(); // Asegúrate de que estás importando el modelo Carrera

        $accion = "actualizar";
        $desabilitado = "";
        $txtbtn = "Actualizar Datos";

        return view('catalogos.reticulas.frm', compact('reticulas', 'reticula', 'accion', 'txtbtn', 'desabilitado', 'carreras'));
    }

    public function update(Request $request, Reticula $reticula)
    {
        $validado = $request->validate($this->validado);
        $reticula->update($validado);
        
        return redirect()->route('reticulas.index')->with('success', 'Reticula actualizada exitosamente.');
    
        /*try {
            $reticula->update($validado);
            return redirect()->route('reticulas.index')->with('success', 'Retícula modificada exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Error de duplicado
                return redirect()->back()->withErrors(['fechaEnVigor' => 'La fecha en vigor ya existe.'])->withInput();
            }
            // Manejar otros errores
        }*/
    }
    

    public function eliminar(Reticula $reticula)
    {
        $reticulas = Reticula::paginate(5);
        return view('catalogos.reticulas.eliminar', compact('reticulas', 'reticula'));
    }

    public function destroy(Reticula $reticula)
    {
        $reticula->delete();
        return redirect()->route('reticulas.index')->with('success', 'Retícula eliminada exitosamente.');
    }
}
