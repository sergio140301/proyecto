<?php

namespace App\Models;

use App\Models\Asesoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rendimiento extends Model
{
    use HasFactory;

    protected $fillable = ['temasEv', 'resultado', 'asesoria', 'problematica', 'observaciones', 'form_alumno_id' ];

    public function FormAlumno()
    {
        return $this->belongsTo(FormAlumno::class, 'form_alumno_id');
    }

    public function Asesoria()
    {
        return $this->hasMany(Asesoria::class);
    }
}