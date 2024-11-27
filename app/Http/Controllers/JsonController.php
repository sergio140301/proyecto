<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Depto;
use App\Models\Materia;
use App\Models\Periodo;
use Illuminate\Http\Request;

class JsonController extends Controller
{

//nos traemos los periodos, con la variable $periodos
    public function periodos(){
        $periodos = Periodo::all();
        return $periodos;
    }


    public function carreras(){
        $carreras = Carrera::all();
        return $carreras;
    }


    public function materias(){
        $materias = Materia::all();
        return $materias;
    }


    public function deptos(){
        $deptos = Depto::all();
        return $deptos;
    }
}
