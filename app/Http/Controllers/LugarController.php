<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\Edificio;
use Illuminate\Http\Request;

class LugarController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'nombrelugar' => 'required|string|max:255',
            'nombrecorto' => 'required|string|max:100',
            'edificio_id' => 'required|exists:edificios,id', 
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); // Inicializa con un valor por defecto
        
        // Obtener todos los edificios
        $edificios = Edificio::get();
    
        // Obtener los lugares con los edificios relacionados
        $lugares = Lugar::when($txtBuscar, function ($query) use ($txtBuscar) {
            return $query->where('nombrelugar', 'like', '%' . $txtBuscar . '%'); // Filtra por nombre del lugar
        })->with('edificio') // Carga la relación edificio
        ->paginate(5);
        
        return view("catalogos.lugares.index", compact("lugares", "txtBuscar")); // Pasa $txtBuscar a la vista
    }  

    public function create()
    {
        $lugares = Lugar::paginate(5);
        $lugar = new Lugar;

        $edificios = Edificio::all(); // Obtener todos los edificios para el formulario
        
        $desabilitado = "";
        $accion = "crear";
        $txtbtn = "guardar";

        return view("catalogos.lugares.frm", compact("lugares", "lugar", "accion", "txtbtn", "desabilitado", "edificios"));
    }

    public function store(Request $request)
    {    
        $validado = $request->validate($this->validado);
        Lugar::create($validado);

        return redirect()->route('lugares.index')->with('success', 'Lugar creado con éxito');
    }

    public function show(Lugar $lugar)
    {
        $lugares = Lugar::paginate(5);

        $edificios = Edificio::all(); // Obtener todos los edificios
        
        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";

        return view('catalogos.lugares.frm', compact('lugares', 'lugar', 'accion', 'txtbtn', 'desabilitado', 'edificios'));
    }

    public function edit(Lugar $lugar)
    {
        $lugares = Lugar::paginate(5);
        $edificios = Edificio::all(); // Obtener todos los edificios
        
        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";

        return view('catalogos.lugares.frm', compact('lugares','lugar', 'accion', 'txtbtn', 'desabilitado', 'edificios'));
    }

    public function update(Request $request, Lugar $lugar)
    {
        $validado = $request->validate($this->validado);
        $lugar->update($validado);
        
        return redirect()->route('lugares.index')->with('success', 'Lugar modificado exitosamente.');
    }

    public function eliminar(Lugar $lugar)
    {    
        $lugares = Lugar::paginate(5);
        return view('catalogos.lugares.eliminar', compact('lugares', 'lugar'));
    }

    public function destroy(Lugar $lugar)
    {
        $lugar->delete();
        return redirect()->route('lugares.index')->with('success', 'Lugar eliminado exitosamente.');
    }
}
