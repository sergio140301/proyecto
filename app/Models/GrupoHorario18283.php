<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoHorario18283 extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoHorario18283Factory> */
    use HasFactory;

    protected $table = 'grupo_horarios';

    protected $fillable = ['dia', 'hora', 'grupo_id','lugar_id'] ;

    public function grupo18283()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class, 'lugar_id');
    }
}
