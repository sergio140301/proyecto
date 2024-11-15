<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Alumno;
use App\Models\Carrera;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Propiedad para un arreglo. 
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'noctrl' => 'required|max:8',
            'nombre' => 'required|max:50',
            'apellidop' => 'required|max:50',
            'apellidom' => 'required|max:50',
            'sexo' => 'required|in:M,F',
            'email' => 'required|email',
            'carrera_id' => 'required|exists:carreras,id',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', '');

        $alumnos = Alumno::with('carrera.depto')
            ->when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombre', 'like', '%' . $txtBuscar . '%');
            })
            ->paginate(5);

        return view("catalogos.alumnos2.index", compact("alumnos", "txtBuscar"));
    }

    public function create()
    {
        $alumnos = Alumno::Paginate(5);
        $alumno = new Alumno;

        $carreras = Carrera::all();
        $depto = Depto::all();

        $desabilitado = "";
        $accion = "crear";
        $txtbtn = "guardar";

        return view("catalogos.alumnos2.frm", compact("alumnos", "alumno", "accion", "txtbtn", 'desabilitado', 'carreras', 'depto'));
    }

    public function store(Request $request)
    {
        $validado = $request->validate($this->validado);
        Alumno::create($validado);

        // Alumno::create($request()->all());

        return redirect()->route("alumnos2.index")->with('success', 'Alumno created sucessfully.');;
    }

    public function show(Alumno $alumno)
    {
        $alumnos = Alumno::paginate(5);

        $carreras = Carrera::all();
        $depto = Depto::all();

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";

        return view('catalogos.alumnos2.frm', compact('alumnos', 'alumno', 'carreras', 'accion', 'txtbtn', 'desabilitado', 'depto'));
    }

    public function edit(Alumno $alumno)
    {
        $alumnos = Alumno::paginate(5);

        $carreras = Carrera::all();
        $depto = Depto::all();

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";

        return view("catalogos.alumnos2.frm", compact('alumnos', 'alumno', 'carreras', 'accion', 'txtbtn', 'desabilitado', 'depto'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $validado = $request->validate($this->validado);
        $alumno->update($validado);

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado exitosamente.');
    }

    public function eliminar(Alumno $alumno)
    {
        $alumnos = Alumno::Paginate(5);
        return view('catalogos.alumnos2.eliminar', compact('alumnos', 'alumno'));
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno deleted sucessfully.');
    }
}
