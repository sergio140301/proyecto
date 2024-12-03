<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materia extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaFactory> */
    use HasFactory;

// Método para obtener materias abiertas
public static function obtenerMateriasAbiertas()
{
    return self::where('abierta', true)->get();
}

// Método para obtener materias por periodo
public static function obtenerMateriasPorPeriodo($periodo)
{
    return self::where('periodo', $periodo)->get();
}

    public function Reticula()
    {
        return $this->belongsTo(Reticula::class, 'reticula_id');
    }

    public function materiasAbiertas()
    {
        return $this->hasMany(MateriaAbierta::class);
    }

    public function carreras()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
 
    public function tutorias()
    {
        return $this->hasMany(Tutoria::class, 'materia_id');
    }

     protected $fillable = [
         'idMateria',
         'nombreMateria',
         'nivel',
         'nombreMediano',
         'nombreCorto',
         'modalidad',
         'semestre',
         'reticula_id',
     ];
}
