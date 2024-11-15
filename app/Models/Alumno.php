<?php

namespace App\Models;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumno extends Model
{
    /** @use HasFactory<\Database\Factories\AlumnoFactory> */
    use HasFactory;

 // Define la relación con Carrera
 public function Carrera(): BelongsTo
 {
     return $this->belongsTo(Carrera::class);
 }

 protected $fillable = [
    'noctrl',
    'nombre',
    'apellidop',
    'apellidom',
    'sexo',
     'email',
    'carrera_id',];

}
