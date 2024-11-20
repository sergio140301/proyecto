<?php

namespace App\Http\Controllers;

use App\Models\PersonalPlaza;
use App\Models\Plaza;
use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalPlazaController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'tipoNombramiento' => 'required|string|max:255',
            'plaza_id' => 'required|exists:plazas,id',
            'personal_id' => 'required|exists:personals,id',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', '');

        $personal = Personal::get();
        $personalplazas = PersonalPlaza::when($txtBuscar, function ($query) use ($txtBuscar) {
            return $query->where('tipoNombramiento', 'like', '%' . $txtBuscar . '%');
        })
        ->with(['personal', 'plaza'])
        ->paginate(5);

        return view('catalogos.personalPlazas.index', compact('personalplazas', 'txtBuscar', 'personal')); //ke
    }


    public function create()
    {
        $personalplazas = PersonalPlaza::paginate(5);
        $personalplaza = new PersonalPlaza;
        $plazas = Plaza::all();
        $personals = Personal::all();

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";
        return view('catalogos.personalPlazas.frm', compact('personalplazas', "personals", "personalplaza", "plazas", 'txtbtn', 'accion', 'desabilitado'));
    }

    public function store(Request $request)
    {
        $validado = $request->validate($this->validado);
        PersonalPlaza::create($validado);

        return redirect()->route('personalPlazas.index')->with('success', 'Personal Plaza creado con éxito');
    }

    public function show(PersonalPlaza $personalplaza)
    {
        $personalplazas = PersonalPlaza::paginate(5);
        $plazas = Plaza::all();
        $personals = Personal::all();

        $accion = "ver";
        $txtbtn = "regresar";
        $desabilitado = "disabled";

        return view('catalogos.personalPlazas.frm', compact('personalplaza', 'personals', 'personalplazas', 'plazas', 'desabilitado', 'accion', 'txtbtn'));
    }

    public function edit(PersonalPlaza $personalplaza)
    {
        $personalplazas = PersonalPlaza::paginate(5);
        $plazas = Plaza::all();
        $personals = Personal::all();

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.personalPlazas.frm', compact('personalplaza', 'accion', 'txtbtn', 'personalplazas', 'plazas', 'desabilitado', 'personals'));
    }

    public function update(Request $request, PersonalPlaza $personalplaza)
    {
        $validado = $request->validate($this->validado);
        $personalplaza->update($validado);

        return redirect()->route('personalPlazas.index')->with('success', 'Personal Plaza actualizado con éxito');
    }

    public function eliminar(PersonalPlaza $personalplaza)
    {
        $personalplazas = PersonalPlaza::paginate(5);
        return view('catalogos.personalPlazas.eliminar', compact("personalplazas", 'personalplaza'));
    }

    public function destroy(PersonalPlaza $personalplaza)
    {
        $personalplaza->delete();

        return redirect()->route('personalPlazas.index')->with('success', 'Personal Plaza eliminado con éxito');
    }
}
