<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public $validado; 

    public function __construct()
    {
        $this->validado = [
            'idPeriodo' => 'required|string|max:15|unique:periodos,idPeriodo',
            'periodo' => 'required|string|max:255',
            'desCorta' => 'nullable|string|max:255',
            'fechaIni' => 'required|date',
            'fechaFin' => 'required|date|after:fechaIni',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); // Inicializa con un valor por defecto
    
        $periodos = Periodo::when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('periodo', 'like', '%' . $txtBuscar . '%'); // Filtra por periodo
            })
            ->paginate(5);
    
        return view("catalogos.periodos.index", compact("periodos", "txtBuscar")); // Pasa $txtBuscar a la vista
    }
    
    public function create()
    {
        $periodos = Periodo::paginate(5);
        $periodo = new Periodo; 

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";
        return view("catalogos.periodos.frm", compact("periodos", "periodo", "accion", "txtbtn", "desabilitado"));
    }

    public function store(Request $request)
    {
        // Validar datos
        $validado = $request->validate($this->validado);
        Periodo::create($validado);

        return redirect()->route('periodos.index')->with('success', 'Periodo creado con éxito');
    }

    public function show(Periodo $periodo)
    {
        $periodos = Periodo::paginate(5);

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.periodos.frm', compact('periodos', 'periodo', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Periodo $periodo)
    {
        $periodos = Periodo::paginate(5);

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.periodos.frm', compact('periodos', 'periodo', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function update(Request $request, Periodo $periodo)
    {
        // Validar datos
        $validado = $request->validate($this->validado);
        
        // Actualizar el periodo
        $periodo->update($validado);
        
        return redirect()->route('periodos.index')->with('success', 'Periodo modificado exitosamente.');
    }

    public function eliminar(Periodo $periodo)
    {
        $periodos = Periodo::paginate(5);
        return view('catalogos.periodos.eliminar', compact('periodos', 'periodo'));
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
        return redirect()->route('periodos.index')->with('success', 'Periodo eliminado exitosamente.');
    }
}
