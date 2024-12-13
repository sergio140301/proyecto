<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioAlumno extends Model
{
    /** @use HasFactory<\Database\Factories\HorarioAlumnoFactory> */
    use HasFactory;

    protected $fillable = ['alumno_id', 'grupo_id' ];

    public function Alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function Grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }


}
