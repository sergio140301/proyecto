<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaAbierta extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaAbiertaFactory> */
    use HasFactory;

    // Definimos los campos que se pueden asignar en masa
    protected $fillable = [
        'periodo_id',
        'carrera_id',
        'materia_id',
    ];

    // Definimos las relaciones con otros modelos
    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }


    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
