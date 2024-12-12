<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Alumno;
use App\Models\Tipoinsc;
use Illuminate\Http\Request;
use App\Models\Documentacion;

class DocumentacionController extends Controller
{
    protected $val;

    public function __construct()
    {
        $this->val = [
            'curp' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'certificado' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'cdomi' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'actanac' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'tipoinsc_id' => ['required', 'exists:tipoinscs,id'],
            'alumno_id' => ['required', 'exists:alumnos,id'],
        ];
    }

    public function index()
    {
        $documentacions = Documentacion::with(['tipoinsc', 'alumno'])->paginate(10);
        return view("documentacions.index", compact("documentacions"));
    }

    public function create(Request $request)
    {
        $documentacion = new Documentacion;
        $accion = "C";
        $txtbtn = "Guardar";
    
        $alumnos = Alumno::all();
        $redirectTo = $request->input('redirect_to', null);
        $tipoinscSeleccionado = null;
    
        if ($request->has('alumno_id')) {
            $alumno = Alumno::find($request->input('alumno_id'));
    
            if ($alumno) {
                if ($alumno->semestre == 1) {
                    $tipoinscSeleccionado = Tipoinsc::where('tipo', 'like', 'Inscripción%')->first();
                } else {
                    $tipoinscSeleccionado = Tipoinsc::where('tipo', 'like', 'Reinscripción%')->first();
                }
            }
    
            // Debugging para verificar los valores
            if (!$tipoinscSeleccionado) {
                dd("Alumno ID:", $alumno->id, "Semestre:", $alumno->semestre, "Tipo Inscripción Seleccionado:", $tipoinscSeleccionado);
            }
        }
    
        return view("documentacions.frm", compact("documentacion", "accion", "txtbtn", "tipoinscSeleccionado", "alumnos", "redirectTo"));
    }
    
    public function getTipoInsc(Request $request)
    {
        $alumno = Alumno::find($request->input('alumno_id'));

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        // Determinar el tipo de inscripción basado en el semestre
        $tipoinsc = null;
        if ($alumno->semestre == 1) {
            $tipoinsc = Tipoinsc::where('tipo', 'like', 'Inscripción%')->first();
        } else {
            $tipoinsc = Tipoinsc::where('tipo', 'like', 'Reinscripción%')->first();
        }

        if ($tipoinsc) {
            return response()->json([
                'id' => $tipoinsc->id,
                'tipo' => $tipoinsc->tipo,
            ]);
        }

        return response()->json(['error' => 'Tipo de inscripción no encontrado'], 404);
    }


    public function store(Request $request)
    {
        $val = $request->validate($this->val);

        // Procesar archivos subidos
        foreach (['curp', 'certificado', 'cdomi', 'actanac'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $val[$field] = $file->storeAs('documentaciones', time() . '_' . $file->getClientOriginalName(), 'public');
            }
        }

        Documentacion::create($val);

        return redirect()->route("documentacions.index")->with("mensaje", "Documentación registrada correctamente.");
    }

    public function edit(Documentacion $documentacion, Request $request)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
    
        $alumnos = Alumno::all();
        $pago = Pago::where('alumno_id', $documentacion->alumno_id)->first();
        $redirectTo = $request->input('redirect_to', null);
        $tipoinscSeleccionado = null;
    
        // Recuperar el alumno asociado
        $alumno = Alumno::find($documentacion->alumno_id);
        if ($alumno) {
            // Determinar el tipo de inscripción basado en el semestre
            if ($alumno->semestre == 1) {
                $tipoinscSeleccionado = Tipoinsc::where('tipo', 'like', 'Inscripción%')->first();
            } else {
                $tipoinscSeleccionado = Tipoinsc::where('tipo', 'like', 'Reinscripción%')->first();
            }
        }
    
        // Verificar si no se encontró tipo de inscripción
        if (!$tipoinscSeleccionado) {
            $tipoinscSeleccionado = (object) ['id' => null, 'tipo' => 'No definido'];
        }
    
        return view('documentacions.frm', compact('documentacion', 'accion', 'txtbtn', 'tipoinscSeleccionado', 'alumnos', 'pago', 'redirectTo'));
    }

    public function update(Request $request, Documentacion $documentacion)
    {
        $val = $request->validate([
            'tipoinsc_id' => ['required', 'exists:tipoinscs,id'],
            'alumno_id' => ['required', 'exists:alumnos,id'],
            'curp' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'certificado' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'cdomi' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
            'actanac' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:45000'],
        ]);

        // Manejo de archivos
        foreach (['curp', 'certificado', 'cdomi', 'actanac'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $val[$field] = $file->storeAs('documentaciones', time() . '_' . $file->getClientOriginalName(), 'public');
            }
        }

        $documentacion->update($val);

        // Redirección dinámica
        $redirectTo = $request->input('redirect_to');
        if ($redirectTo) {
            return redirect($redirectTo)->with('mensaje', 'Documentación actualizada correctamente.');
        }

        return redirect()->route('documentacions.index')->with('mensaje', 'Documentación actualizada correctamente.');
    }
    

    public function destroy(Documentacion $documentacion)
    {
        $documentacion->delete();

        return redirect()->route("documentacions.index")->with("mensaje", "Documentación eliminada correctamente.");
    }
}
