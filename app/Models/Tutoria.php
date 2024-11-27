<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model
{
    /** @use HasFactory<\Database\Factories\TutoriaFactory> */
    use HasFactory;


    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'personal_id',
        'depto_id',
        'alumno_id',
        'materia_id',
        'carrera_id',
        'periodo_id',
    ];

    /**
     * Relación con el modelo Personal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    /**
     * Relación con el modelo Depto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function depto()
    {
        return $this->belongsTo(Depto::class, 'depto_id');
    }

    /**
     * Relación con el modelo Alumno.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    /**
     * Relación con el modelo Materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}

