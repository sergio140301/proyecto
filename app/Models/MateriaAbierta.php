<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaAbierta extends Model
{
    use HasFactory;



    protected $fillable = ['periodo_id', 'carrera_id', 'materia_id'];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class,'carrera_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class,'materia_id');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
