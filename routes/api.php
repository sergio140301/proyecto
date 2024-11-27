<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/periodos', [JsonController::class, 'periodos']);

Route::get('/carreras', [JsonController::class, 'carreras']);

Route::get('/materias', [JsonController::class, 'materias']);

Route::get('/deptos', [JsonController::class, 'deptos']);

