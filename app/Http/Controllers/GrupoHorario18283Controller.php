<?php

namespace App\Http\Controllers;

use App\Models\Grupo18283;
use App\Models\GrupoHorario18283;
use App\Models\Hora;
use App\Models\Lugar;
use Illuminate\Http\Request;

class GrupoHorario18283Controller extends Controller
{

    public $validado;

    public function __construct()
    {
        $this->validado = [
            'dia' => 'required|string|max:255',
            'hora' => 'required|string|max:50',
            'grupo18283_id' => 'required|exists:grupo18283s,id',
            'lugar_id' => 'required|exists:lugars,id',
        ];

    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', '');

        $grupo18283 = Grupo18283::get();
        $lugar = Lugar::get();


        $grupohorario18283s = GrupoHorario18283::when($txtBuscar, function ($query) use ($txtBuscar) {
            return $query->where('dia', 'like', '%' . $txtBuscar . '%');
        })
        ->with(['grupo18283', 'lugar'])
        ->paginate(5);

        return view('catalogos.gruposhorarios18283.index18283', compact('grupohorario18283s', 'txtBuscar', 'grupo18283', 'lugar'));
    }


    public function create()
    {
        $grupohorario18283s = GrupoHorario18283::paginate(5);
        $grupohorario18283 = new GrupoHorario18283;

        $grupo18283s = Grupo18283::all();
        $lugars = Lugar::all();
        $horas = Hora::all();

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";

        return view('catalogos.gruposhorarios18283.frm18283', compact('grupohorario18283s', "grupohorario18283", "grupo18283s", "lugars",'horas', 'accion', 'txtbtn', 'desabilitado'));
    }


    public function store(Request $request)
    {
        $validado = $request->validate($this->validado);
        GrupoHorario18283::create($validado);

        return redirect()->route('gruposhorarios18283.index')->with('success', 'Grupo H creado con éxito');
    }


    public function show(GrupoHorario18283 $grupoHorario18283)
    {
        $grupohorario18283s = GrupoHorario18283::paginate(5);

        $grupo18283s = Grupo18283::all();
        $lugars = Lugar::all();
        $horas = Hora::all();

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";

        return view('catalogos.gruposhorarios18283.frm18283', compact('grupohorario18283s', 'grupoHorario18283','grupo18283s','lugars','horas', 'accion', 'txtbtn', 'desabilitado'));
    }


    public function edit(GrupoHorario18283 $grupoHorario18283)
    {
        $grupohorario18283s = GrupoHorario18283::paginate(5);

        $grupo18283s = Grupo18283::all();
        $lugars = Lugar::all();
        $horas = Hora::all();

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";

        return view('catalogos.gruposhorarios18283.frm18283', compact('grupohorario18283s', 'grupoHorario18283', 'grupo18283s', 'lugars','horas', 'accion', 'txtbtn', 'desabilitado'));

    }


    public function update(Request $request, GrupoHorario18283 $grupoHorario18283)
    {
        //
        $validado = $request->validate($this->validado);

        $grupoHorario18283->update($validado);

        return redirect()->route('gruposhorarios18283.index')->with('success', 'Grupo Horario modificado exitosamente.');

    }

    public function eliminar(GrupoHorario18283 $grupoHorario18283)
    {
        $grupohorario18283s = GrupoHorario18283::paginate(5);

        return view('catalogos.gruposhorarios18283.eliminar18283', compact('grupohorario18283s', 'grupoHorario18283'));
    }

    public function destroy(GrupoHorario18283 $grupoHorario18283)
    {
        $grupoHorario18283->delete();

        return redirect()->route('gruposhorarios18283.index')->with('success', 'Grupo Horario eliminado exitosamente.');
    }
}
