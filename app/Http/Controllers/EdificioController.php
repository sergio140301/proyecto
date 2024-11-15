<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'nombreedificio' => 'required|string|max:255',
            'nombrecorto' => 'required|string|max:100',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); // Inicializa con un valor por defecto
    
        $edificios = Edificio::when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombreedificio', 'like', '%' . $txtBuscar . '%'); // Filtra por nombre de edificio
            })
            ->paginate(5);
    
        return view("catalogos.edificios.index", compact("edificios", "txtBuscar")); // Pasa $txtBuscar a la vista
    }

    public function create()
    {
        $edificios = Edificio::paginate(5); 
        $edificio = new Edificio; 

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";
        return view("catalogos.edificios.frm", compact("edificios","edificio", "accion", "txtbtn", "desabilitado"));
    }

    public function store(Request $request)
    {      
        $validado = $request->validate($this->validado);
        Edificio::create($validado);

        return redirect()->route('edificios.index')->with('success', 'Edificio creado con éxito');
    }

    public function show(Edificio $edificio)
    {
        $edificios = Edificio::paginate(5); 

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.edificios.frm', compact('edificios','edificio', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Edificio $edificio)
    {
        $edificios = Edificio::paginate(5);

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.edificios.frm', compact('edificios','edificio', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function update(Request $request, Edificio $edificio)
    {
        $validado = $request->validate($this->validado);
        $edificio->update($validado);
        
        return redirect()->route('edificios.index')->with('success', 'Edificio modificado exitosamente.');
    }

    public function eliminar(Edificio $edificio)
    {
        $edificios = Edificio::paginate(5);
        return view('catalogos.edificios.eliminar', compact('edificios', 'edificio'));
    }

    public function destroy(Edificio $edificio)
    {
        $edificio->delete();
        return redirect()->route('edificios.index')->with('success', 'Edificio eliminado exitosamente.');
    }
}
