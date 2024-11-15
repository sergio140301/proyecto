<?php

namespace App\Http\Controllers;

use App\Models\Plaza;
use Illuminate\Http\Request;

class PlazaController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'idplaza' => 'required|string|max:255|unique:plazas,idplaza',
            'nombreplaza' => 'required|string|max:255',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); // Inicializa con un valor por defecto
    
        $plazas = Plaza::when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombreplaza', 'like', '%' . $txtBuscar . '%'); // Filtra por nombre de plaza
            })
            ->paginate(5);
    
        return view("catalogos.plazas.index", compact("plazas", "txtBuscar")); // Pasa $txtBuscar a la vista
    }
    
    public function create()
    {
        $plazas = Plaza::paginate(5);
        $plaza = new Plaza; 

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";
        return view("catalogos.plazas.frm", compact("plazas", "plaza", "accion", "txtbtn", "desabilitado"));
    }

    public function store(Request $request)
    {
        
        $validado = $request->validate($this->validado);
        Plaza::create($validado);

        return redirect()->route('plazas.index')->with('success', 'Plaza creada con éxito');
    }

    public function show(Plaza $plaza)
    {
        $plazas = Plaza::paginate(5);

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.plazas.frm', compact('plazas', 'plaza', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Plaza $plaza)
    {
        $plazas = Plaza::paginate(5);
        
        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.plazas.frm', compact('plazas', 'plaza', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function update(Request $request, Plaza $plaza)
    {
      
        $validado = $request->validate($this->validado);
        $plaza->update($validado);
        
        return redirect()->route('plazas.index')->with('success', 'Plaza modificada exitosamente.');
    }

    public function eliminar(Plaza $plaza)
    {
        $plazas = Plaza::paginate(5);
        return view('catalogos.plazas.eliminar', compact('plazas', 'plaza'));
    }

    public function destroy(Plaza $plaza)
    {
        $plaza->delete();
        return redirect()->route('plazas.index')->with('success', 'Plaza eliminada exitosamente.');
    }
}
