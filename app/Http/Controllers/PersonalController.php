<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Puesto;
use App\Models\Depto;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'noTrabajador' => 'required|string|max:255', //checar como está en bd para corregir en tabla y form
            'rfc' => 'required|string|max:13',
            'nombres' => 'required|string|max:255',
            'apellidop' => 'required|string|max:255',
            'apellidom' => 'nullable|string|max:255',
            'licenciatura' => 'nullable|string|max:255',
            'licPasTit' => 'nullable|string|max:255',
            'especializacion' => 'nullable|string|max:255',
            'esPasTit' => 'nullable|string|max:255',
            'maestria' => 'nullable|string|max:255',
            'maePasTit' => 'nullable|string|max:255',
            'doctorado' => 'nullable|string|max:255',
            'docPasTit' => 'nullable|string|max:255',
            'fechaIngSep' => 'nullable|date',
            'fechaIngIns' => 'nullable|date',
            'puesto_id' => 'required|exists:puestos,id',
            'depto_id' => 'required|exists:deptos,id',
        ];
    }

    public function index()
    {
        // Obtener todos los departamentos y puestos
        $puesto = Puesto::get(); //pq get y pq all?
        $depto = Depto::all();

        $txtBuscar = request('txtBuscar', ''); // Inicializa con un valor por defecto

        // Filtra por RFC o Nombres
        $personals = Personal::when($txtBuscar, function ($query) use ($txtBuscar) {
            return $query->where('rfc', 'like', '%' . $txtBuscar . '%') // Filtra por RFC
                         ->orWhere('nombres', 'like', '%' . $txtBuscar . '%'); // O por nombres
        })
        ->paginate(5); // Paginación

        return view('catalogos.personal.index', compact('personals', 'puesto', 'depto', 'txtBuscar')); // Pasa las variables a la vista
    }

    public function create()
    {
        $personals = Personal::paginate(5); // Paginación para la lista de Personal
        $personal = new Personal;

        $puestos = Puesto::all(); // Todos los puestos
        $depto = Depto::all(); // Todos los departamentos

        $desabilitado = "";
        $accion = "crear";
        $txtbtn = "guardar"; 

        return view('catalogos.personal.frm', compact('personals', 'personal', 'puestos', 'depto', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function store(Request $request)
    {
        // Validar datos
        $validado = $request->validate($this->validado);

        // Crear nuevo registro de Personal
        Personal::create($validado); 

        // Redirigir con mensaje de éxito
        return redirect()->route('personal.index')->with('success', 'Personal creado con éxito');
    }

    public function show(Personal $personal)
    {
        // Paginación de Personal
        $personals = Personal::paginate(5);

        $puestos = Puesto::all(); // Obtener todos los puestos
        $depto = Depto::all(); // Obtener todos los departamentos

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled"; // Deshabilitar campos

        return view('catalogos.personal.frm', compact('personals', 'personal', 'puestos', 'depto', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Personal $personal)
    {
        // Paginación de Personal
        $personals = Personal::paginate(5);
        
        $puestos = Puesto::all(); // Obtener todos los puestos
        $depto = Depto::all(); // Obtener todos los departamentos

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";

        return view('catalogos.personal.frm', compact('personals', 'personal', 'puestos', 'depto', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function update(Request $request, Personal $personal)
    {
        // Validar datos
        $validado = $request->validate($this->validado);

        // Actualizar el registro de Personal
        $personal->update($validado);

        // Redirigir con mensaje de éxito
        return redirect()->route('personal.index')->with('success', 'Personal modificado exitosamente.');
    }

    public function eliminar(Personal $personal)
    {
        // Paginación de Personal
        $personals = Personal::paginate(5);
        
        // Mostrar vista de eliminar
        return view('catalogos.personal.eliminar', compact('personals', 'personal'));
    }

    public function destroy(Personal $personal)
    {
        // Eliminar el registro de Personal
        $personal->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('personal.index')->with('success', 'Personal eliminado exitosamente.');
    }
}
