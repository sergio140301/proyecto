<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo18283 extends Model
{
    /** @use HasFactory<\Database\Factories\Grupo18283Factory> */
    use HasFactory;
    // Definir el nombre de la tabla
    protected $table = 'grupo18283s';
    protected $fillable = ['grupo', 'descripcion', 'maxAlumnos', 'periodo_id', 'materia_id', 'personal_id'];

    //PERTENECE A llaves fora
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }


    //TIENE MUCHOS
    public function grupoHorario18283()
    {
        return $this->hasMany(GrupoHorario18283::class);
    }

    public function horarioMaestroGrupo()
    {
        return $this->hasMany(HorarioMaestroGrupo::class);
    }
}
