<?php

namespace App\Models;

use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\GrupoHorario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoFactory> */
    use HasFactory;

    protected $fillable = ['grupo' , 'descripcion','maxAlumnos', 'periodo_id', 'materia_id', 'personal_id'];

    public function Periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function Materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function Personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    public function GrupoHorarios()
    {
        return $this->hasMany(GrupoHorario::class);
    }

    public function HorarioMaestroGrupos()
    {
        return $this->hasMany(HorarioMaestroGrupo::class);
    }




}



