<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioMaestroGrupo extends Model
{
    /** @use HasFactory<\Database\Factories\HorarioMaestroGrupoFactory> */
    use HasFactory;

    protected $fillable = ['horario_maestro_id', 'grupo_id'] ;

    public function horarioMaestro()
    {
        return $this->belongsTo(HorarioMaestro::class, 'horario_maestro_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }


}
