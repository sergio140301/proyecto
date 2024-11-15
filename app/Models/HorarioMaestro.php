<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioMaestro extends Model
{
    /** @use HasFactory<\Database\Factories\HorarioMaestroFactory> */
    use HasFactory;

    protected $fillable = ['fecha', 'observaciones', 'personal_id', 'periodo_id'] ;

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function horarioMaestroGrupo()
    {
        return $this->hasMany(HorarioMaestroGrupo::class);
    }
}
