<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Reticula;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'idMateria' => 'required|string|max:15|unique:materias,idMateria',
            'semestre' => 'required|integer|between:1,9',
            'nombreMateria' => 'required|string|max:255',
            'nivel' => 'required|string|in:S,L,F',
            'nombreMediano' => 'nullable|string|max:255',
            'nombreCorto' => 'nullable|string|max:255',
            'modalidad' => 'required|string|max:255',
            'reticula_id' => 'required|exists:reticulas,id',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); // Inicializa con un valor por defecto

        $materias = Materia::with('reticula.carrera')
            ->when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombreMateria', 'like', '%' . $txtBuscar . '%'); // Filtra por nombre de materia
            })
            ->paginate(5);

        return view("catalogos.materias.index", compact("materias", "txtBuscar")); // Pasa $txtBuscar a la vista
    }

    public function create()
    {
        $materias = Materia::paginate(5);
        $materia = new Materia;

        $reticulas = Reticula::all();
        $carreras = Carrera::all(); // Obtener todas las carreras

        $desabilitado = "";
        $accion = "crear";
        $txtbtn = "guardar";

        return view("catalogos.materias.frm", compact('materias', "materia", "carreras", "reticulas", "desabilitado", "accion", "txtbtn"));
    }

    public function store(Request $request)
    {
        $validado = $request->validate($this->validado);
       
        Materia::create($validado);

        return redirect()->route('materias.index')->with('success', 'Materia creada con éxito');
    }

    public function show(Materia $materia)
    {
        $materias = Materia::paginate(5);

        $reticulas = Reticula::all();
        $carreras = Carrera::all(); // Obtener todas las carreras

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.materias.frm', compact('materias', 'materia', 'carreras', 'reticulas', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Materia $materia)
    {
        $materias = Materia::paginate(5);

        $reticulas = Reticula::all();
        $carreras = Carrera::all(); // Obtener todas las carreras

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.materias.frm', compact('materias', 'materia', 'carreras', 'reticulas', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function update(Request $request, Materia $materia)
    {
        $validado = $request->validate($this->validado);
        $materia->update($validado);

        return redirect()->route('materias.index')->with('success', 'Materia modificada exitosamente.');
    }

    public function eliminar(Materia $materia)
    {
        $materias = Materia::paginate(5);
        //$carreras = Carrera::all();
        return view('catalogos.materias.eliminar', compact('materias', 'materia'));
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente.');
    }
}
