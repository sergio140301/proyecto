<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoTutoria extends Model
{
    /** @use HasFactory<\Database\Factories\PeriodoTutoriaFactory> */
    use HasFactory;

    protected $fillable = ['fecha_ini', 'fecha_fin', 'periodo_id' ];

    public function Periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function FormAlumno()
    {
        return $this->hasMany(FormAlumno::class);
    }

    public function Tutoria()
    {
        return $this->hasMany(Tutoria::class);
    }
}