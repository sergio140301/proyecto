<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formAlumno extends Model
{
    /** @use HasFactory<\Database\Factories\FormAlumnoFactory> */
    use HasFactory;

    protected $fillable = ['materia_id', 'periodo_tutoria_id', 'alumno_id' ];

    public function Materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function PeriodoTutoria()
    {
        return $this->belongsTo(PeriodoTutoria::class, 'periodo_tutoria_id');
    }

    public function Alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function Rendimiento()
    {
        return $this->hasMany(Rendimiento::class);
    }
}