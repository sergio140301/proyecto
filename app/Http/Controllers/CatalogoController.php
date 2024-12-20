<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Plaza;
use App\Models\Alumno;
use App\Models\Puesto;
use App\Models\Carrera;
use App\Models\Catalogo;
use App\Models\Grupo18283;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $catalogos = Catalogo::get();

        $countgrupo18283 = Grupo18283::selectRaw('COUNT(*) as grupo18283')->first();
        return view("catalogos.index", compact("catalogos", "countgrupo18283"));
    }


    public function otraVista()
    {

        return view("catalogos.otraVista");


    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalogo $catalogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalogo $catalogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catalogo $catalogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalogo $catalogo)
    {
        //
    }
}
