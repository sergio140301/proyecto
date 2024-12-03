<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model
{
    /** @use HasFactory<\Database\Factories\TutoriaFactory> */
    use HasFactory;

    protected $fillable = ['semestreAlumno','alumno_id', 'periodo_id', 'personal_id' ];

    public function Alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function Periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function Personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    

}