<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/alumnos', [JsonController::class, 'alumnos']);


Route::get('/periodos', [JsonController::class, 'periodos']);
Route::get('/carreras', [JsonController::class, 'carreras']);
Route::get('/semestres', [JsonController::class, 'semestres']);
Route::get('/materias', [JsonController::class, 'materias']);
Route::get('/deptos', [JsonController::class, 'deptos']);
Route::get('/edificios', [JsonController::class, 'edificios']);
Route::get('/personal', [JsonController::class, 'personal']);
Route::get('/lugar', [JsonController::class, 'lugar']);
Route::get('/materiasabiertas/{semestre}', [JsonController::class, 'materiasabiertas']);

Route::post('/alumnos', [JsonController::class, 'insertarAlumno']);

Route::get('/semestres-con-materias-abiertas', [JsonController::class, 'semestresConMateriasAbiertas']);