<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'idCarrera' => 'required|string|max:10|unique:carreras',
            'nombreCarrera' => 'required|string|max:200|unique:carreras',
            'nombreMediano' => 'nullable|string|max:50|unique:carreras',
            'nombreCorto' => 'nullable|string|max:5|unique:carreras',
            'depto_id' => 'required|exists:deptos,id',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', '');

        $carreras = Carrera::when($txtBuscar, function ($query) use ($txtBuscar) {
            return $query->where('nombreCarrera', 'like', '%' . $txtBuscar . '%');
        })
            ->paginate(5);

        return view("catalogos.carreras.index", compact("carreras", "txtBuscar"));
    }

    public function create()
    {
        $carreras = Carrera::paginate(5);
        $carrera = new Carrera();

        $departamentos = Depto::all(); // Obtener todos los departamentos

        $desabilitado = "";
        $accion = "crear";
        $txtbtn = "guardar";

        return view("catalogos.carreras.frm", compact("carreras", "carrera", "departamentos", "desabilitado", "accion", "txtbtn"));
    }


    public function store(Request $request)
    {
    

        $validado = $request->validate($this->validado);
    


        Carrera::create($validado);

        return redirect()->route('carreras.index')->with('success', 'Carrera creada con éxito');
    }


    public function show(Carrera $carrera)
    {
        $carreras = Carrera::paginate(5);
        $departamentos = Depto::all();

        $accion = "ver";
        $txtbtn = "regresar";
        $desabilitado = "disabled";
        return view('catalogos.carreras.frm', compact('carreras', "carrera", 'departamentos', 'accion', 'txtbtn', 'desabilitado'));
    }
 
    public function edit(Carrera $carrera)
    {
        $carreras = Carrera::paginate(5);

        $departamentos = Depto::all(); // Obtener todos los departamentos

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.carreras.frm', compact('carreras', 'carrera', 'accion', 'desabilitado', 'txtbtn', 'departamentos'));
    }


    public function update(Request $request, Carrera $carrera)
    {
        $validado = $request->validate($this->validado);

        $carrera->update($validado);

        return redirect()->route('carreras.index')->with('success', 'Carrera modificada exitosamente.');
    }

    public function eliminar(Carrera $carrera)
    {
        $carreras = Carrera::paginate(5);
        return view('catalogos.carreras.eliminar', compact('carreras', "carrera"));
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada exitosamente.');
    }
}
