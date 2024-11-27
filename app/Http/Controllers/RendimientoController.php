<?php

namespace App\Http\Controllers;

use App\Models\Rendimiento;
use Illuminate\Http\Request;

class RendimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("catalogos.rendimientos.index");
    }

    /**
     * Show the form for creating a new resource.
     */
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
    public function show(Rendimiento $rendimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rendimiento $rendimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rendimiento $rendimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rendimiento $rendimiento)
    {
        //
    }
}
