<?php

namespace App\Models;

use App\Models\Depto;
use App\Models\Alumno;
use App\Models\Materia;
use App\Models\Reticula;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carrera extends Model
{
    /** @use HasFactory<\Database\Factories\CarreraFactory> */
    use HasFactory;

 //establece la relacion de alumnos con carrera
 //una carrera tiene muchos alumnos

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }




    public function reticulas()
    {
        return $this->hasMany(Reticula::class);
    }

    
// Define la relación con Departamento
public function depto(): BelongsTo
{
    return $this->belongsTo(Depto::class, 'depto_id');
}

public function tutorias()
{
    return $this->hasMany(Tutoria::class, 'carrera_id');
}

protected $fillable = [
    'idCarrera',
    'nombreCarrera',
    'nombreMediano',
    'nombreCorto',
    'depto_id',
];

}
