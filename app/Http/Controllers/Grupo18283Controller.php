<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Grupo18283;
use App\Models\Lugar;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Personal;
use Illuminate\Http\Request;

class Grupo18283Controller extends Controller
{
    public $validado;
 
    public function __construct()
    {
        $this->validado = [
            'grupo' => 'required|string|max:255|unique:grupo18283s',
            'descripcion' => 'nullable|string|max:255',
            'maxAlumnos' => 'required|integer',
            'periodo_id' => 'required|exists:periodos,id',
            'materia_id' => 'required|exists:materias,id',
            'personal_id' => 'required|exists:personals,id'
        ];
    }
   
    public function index()
    {
        $txtBuscar = request('txtBuscar', '');

        $periodo = Periodo::get();
        $personal = Personal::get(); 
        $materia  = Materia::get();
 

        $grupo18283s = Grupo18283::when($txtBuscar, function ($query) use ($txtBuscar) {
            return $query->where('grupo', 'like', '%' . $txtBuscar . '%');
        })
        ->with(['periodo', 'personal', 'materia'])
        ->paginate(5);

        return view('catalogos.grupos18283.index18283', compact('grupo18283s', 'txtBuscar', 'periodo', 'personal', 'materia'));
    }

    public function create()
    {
        $grupo18283s = Grupo18283::paginate(5);
        $grupo18283 = new Grupo18283;

        $periodos = Periodo::all();
        $personals = Personal::all();
        $materias = Materia::all();

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";

        return view('catalogos.grupos18283.frm18283', 
        compact('grupo18283s', "grupo18283", "periodos", "personals", 'materias', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function store(Request $request)
    {
        $validado = $request->validate($this->validado);
        $grupo18283 = Grupo18283::create($validado);

        //return redirect()->route('grupos18283.index')->with('success', 'Grupo creado con éxito');
        return redirect()->route('grupos18283.edit', $grupo18283->id)
                        ->with('success', 'Grupo creado con éxito. Ahora puedes editarlo.');

                        /* return redirect()->route('grupos18283.edit', $grupo18283->id)
                            ->with('mostrarHorarioForm', true) // Bandera para mostrar el formulario
                            ->with('success', 'Grupo creado con éxito. Ahora puedes editarlo.'); */
    }

    /**
     * Display the specified resource.
     */
    public function show(Grupo18283 $grupo18283)
    {
        $grupo18283s = Grupo18283::paginate(5);

        $periodos = Periodo::all();
        $personals = Personal::all();
        $materias = Materia::all();

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";

        return view('catalogos.grupos18283.frm18283', 
        compact('grupo18283s', 'grupo18283', 'periodos', 'personals', 'materias', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Grupo18283 $grupo18283)
    {
        $grupo18283s = Grupo18283::paginate(5);
        
        $periodos = Periodo::all();
        $materias = Materia::all();
        $personals = Personal::all();

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";


        return view('catalogos.grupos18283.frm18283', compact('grupo18283s', 'grupo18283','periodos','materias','personals', 'accion', 'txtbtn', 'desabilitado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grupo18283 $grupo18283)
    {
        $validado = $request->validate($this->validado);
        $grupo18283->update($validado);

        //return redirect()->route('grupos18283.index')->with('success', 'Grupo actualizado con éxito');
        return redirect()->route('grupos18283.edit', $grupo18283->id)->with('success', 'Grupo actualizado con éxito');
    }

    public function eliminar(Grupo18283 $grupo18283)
    {
        $grupo18283s = Grupo18283::paginate(5);
        return view('catalogos.grupos18283.eliminar18283', compact('grupo18283s', 'grupo18283'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo18283 $grupo18283)
    {
        //
        $grupo18283->delete();
        return redirect()->route('grupos18283.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}