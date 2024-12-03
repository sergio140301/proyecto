<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Edificio;
use App\Models\Lugar;
use App\Models\MateriaAbierta;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JsonController extends Controller
{



    public function alumnos()
    {
        $alumnos = DB::table('alumnos')
            ->select( 'nombre', 'apellidop' ,'apellidom', 'sexo')
            ->get();
        return $alumnos;
    }


    public function periodos()
    {
        $periodos = Periodo::all();
        return $periodos;
    }

    public function carreras()
    {
        $carreras = Carrera::all();
        return $carreras;
    }

    public function semestres()
    {
        $semestres = DB::table('materias')
            ->select('semestre')
            ->groupBy('semestre')
            ->orderBy('semestre')
            ->get();
        return $semestres;
    }

    public function materiasabiertas($semestre)
    {
        $materiasabiertas = MateriaAbierta::with('materia.reticula.carrera')
            ->whereHas('materia', function ($query) use ($semestre) {
                $query->where('semestre', $semestre);
            })->get();
        return $materiasabiertas;
    }




    public function materias()
    {
        $materias = Materia::all();
        return $materias;
    }

    public function deptos()
    {
        $deptos = Depto::all();
        return $deptos;
    }

    public function edificios()
    {
        $edificios = Edificio::all();
        return $edificios;
    }

    public function personal()
    {
        $personal = Personal::all();
        return $personal;
    }

    public function lugar()
    {
        $lugars = Lugar::get();
        return $lugars;
    }
}
