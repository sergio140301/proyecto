<?php

namespace App\Http\Controllers;


use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\GrupoHorario;
use App\Models\Hora;
use App\Models\Lugar;
use Illuminate\Http\Request;

class GrupoController extends Controller
{

    public $validado;
    public $existe;


    public function __construct()
    {
        $this->validado = [
            'grupo' => 'required|string|max:255|unique:grupos',
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


        $grupo18283s = Grupo::when($txtBuscar, function ($query) use ($txtBuscar) {
            return $query->where('grupo', 'like', '%' . $txtBuscar . '%');
        })
            ->with(['periodo', 'personal', 'materia'])
            ->paginate(5);

        return view('catalogos.grupos18283.index18283', compact('grupo18283s', 'txtBuscar', 'periodo', 'personal', 'materia'));
    }

    public function create() {
        $grupo18283s = Grupo::paginate(5);
        $grupo18283 = new Grupo;

        $periodos = Periodo::all();
        $personals = Personal::all();
        $materias = Materia::all();

        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";

        return view(
            'catalogos.grupos18283.frm18283',
            compact('grupo18283s', "grupo18283", "periodos", "personals", 'materias', 'accion', 'txtbtn', 'desabilitado')
        );
    }

    public function store(Request $request) {
        $validado = $request->validate($this->validado);
        $grupo18283 = Grupo::create($validado);

        //return redirect()->route('grupos18283.index')->with('success', 'Grupo creado con éxito');
        return redirect()->route('grupos18283.edit', $grupo18283->id)
            ->with('success', 'Grupo creado con éxito. Ahora puedes editarlo.');
    }

    public function show(Grupo $grupo18283)
    {
        $grupo18283s = Grupo::paginate(5);

        $periodos = Periodo::all();
        $personals = Personal::all();
        $materias = Materia::all();

        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";

        return view(
            'catalogos.grupos18283.frm18283',
            compact('grupo18283s', 'grupo18283', 'periodos', 'personals', 'materias', 'accion', 'txtbtn', 'desabilitado')
        );
    }

    public function edit(Grupo $grupo18283)
    {
        $grupo18283s = Grupo::paginate(5);

        $periodos = Periodo::all();
        $materias = Materia::all();
        $personals = Personal::all();

        $grupohorario18283s = GrupoHorario::paginate(5);
        $grupohorario18283 = new GrupoHorario;

        $grupo18283s = Grupo::all();
        $lugars = Lugar::all();
        $horas = Hora::all();

        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";

        $contadorRegistros = [];
        $lugaresAsociados = [];
        $dia = "L";

        foreach ($horas as $hora) {
            $horaLabel = $hora->hora_ini . ' - ' . $hora->hora_fin;
            $contador = GrupoHorario::where('grupo_id', $grupo18283->id)
                ->where('dia', $dia)
                ->where('hora', $horaLabel)
                ->count();

            $registro = GrupoHorario::where('grupo_id', $grupo18283->id)
                ->where('dia', $dia)
                ->where('hora', $horaLabel)
                ->first();

            $contadorRegistros[$horaLabel] = $contador; // Guardamos el resultado
            $lugaresAsociados[$horaLabel] = $registro->lugar_id ?? null;
        }


        return view(
            'catalogos.grupos18283.frm18283',
            compact('grupo18283s', 'grupo18283', 'periodos', 'materias', 'personals', 'grupohorario18283s', "grupohorario18283", "grupo18283s", "lugars", 'horas', 'accion', 'txtbtn', 'desabilitado', 'contadorRegistros', 'lugaresAsociados')
        );
    }


    public function update(Request $request, Grupo $grupo18283)
    {
        $grupo = Grupo::findOrFail($grupo18283);

        $request->validate([
            'grupo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'maxAlumnos' => 'required|integer',
            'periodo_id' => 'required|exists:periodos,id',
            'personal_id' => 'required|exists:personals,id',
            'materia_id' => 'required|exists:materias,id',
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupos18283.edit', $grupo->id)
            ->with('success', 'Grupo actualizado correctamente');
    }
}
