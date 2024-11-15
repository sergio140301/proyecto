<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Carrera;
use Illuminate\Http\Request;

class DeptoController extends Controller
{
    //FALTA CONSTRUCTOR(?)
    public $validado;  

    public function __construct()
    {
        $this->validado = [
            'idDepto' => 'required|string|max:10',
            'nombreDepto' => 'required|string|max:255',
            'nombreMediano' => 'nullable|string|max:255',
            'nombreCorto' => 'nullable|string|max:50',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); 
    
        $departamentos = Depto::with('carreras.alumnos')
            ->when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombreDepto', 'like', '%' . $txtBuscar . '%'); 
            })
            ->paginate(5);
    
        return view("catalogos.deptos.index", compact("departamentos", "txtBuscar"));
    }

    public function create()
    {
        $departamentos = Depto::paginate(5);
        $depto = new Depto(); 

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = ""; 
    
        return view("catalogos.deptos.frm", compact("departamentos", "depto", "accion", "txtbtn", "desabilitado"));
    }
    

    public function store(Request $request)
    {
        // Validar los datos del formulario  
        $validado = $request->validate($this->validado); 
        Depto::create($validado);
    
        return redirect()->route('deptos.index')->with('success', 'Departamento creado con éxito');
    }
    

    public function show(Depto $depto)
    {
        $departamentos = Depto::paginate(5);

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.deptos.frm', compact('departamentos', "depto" ,'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Depto $depto)
    {       
        $departamentos = Depto::paginate(5); 

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.deptos.frm', compact('departamentos', 'depto', 'accion', 'txtbtn', 'desabilitado'));
    }
    
    
    public function update(Request $request, Depto $depto)
    {
        $validado = $request->validate($this->validado);
        
        $depto->update($validado);
    
        return redirect()->route('deptos.index')->with('success', 'Departamento modificado exitosamente.');
    }
    
    public function eliminar(Depto $depto)
    {
        $departamentos = Depto::paginate(5);
        return view('catalogos.deptos.eliminar', compact('departamentos', "depto"));
    }

    public function destroy(Depto $depto)
    {
        $depto->delete();
        return redirect()->route('deptos.index')->with('success', 'Departamento eliminado exitosamente.');
    }
}
