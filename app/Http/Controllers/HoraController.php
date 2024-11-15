<?php

namespace App\Http\Controllers;

use App\Models\Hora;
use Illuminate\Http\Request;

class HoraController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'hora_ini' => 'required|date_format:H:i', 
            'hora_fin' => 'required|date_format:H:i|after:hora_ini',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); 
        
        $horas = Hora::when($txtBuscar, function ($query) use ($txtBuscar) {
            return $query->where('hora_ini', 'like', '%' . $txtBuscar . '%')
                         ->orWhere('hora_fin', 'like', '%' . $txtBuscar . '%');
        })
        ->paginate(5);

        return view("catalogos.horas.index", compact("horas", "txtBuscar"));
    }

    public function create()
    {
        $horas = Hora::paginate(5);
        $hora = new Hora;

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";
        return view("catalogos.horas.frm", compact("horas", "hora", "accion", "txtbtn", "desabilitado"));
    }

    public function store(Request $request)
    {
        $validado = $request->validate($this->validado);
        Hora::create($validado);

        return redirect()->route('horas.index')->with('success', 'Hora creada con éxito');
    }

    public function show(Hora $hora)
    {
        $horas = Hora::paginate(5);

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.horas.frm', compact('horas', 'hora', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Hora $hora)
    {
        $horas = Hora::paginate(5);

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.horas.frm', compact('horas', 'hora', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function update(Request $request, Hora $hora)
    {
        $validado = $request->validate($this->validado);
        $hora->update($validado);

        return redirect()->route('horas.index')->with('success', 'Hora actualizada exitosamente.');
    }

    public function eliminar(Hora $hora)
    {
        $horas = Hora::paginate(5);
        return view('catalogos.horas.eliminar', compact('horas', 'hora'));
    }

    public function destroy(Hora $hora)
    {
        $hora->delete();
        return redirect()->route('horas.index')->with('success', 'Hora eliminada exitosamente.');
    }
}
