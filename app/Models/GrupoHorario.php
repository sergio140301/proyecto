<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrupoHorario extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoHorarioFactory> */
    use HasFactory;

    protected $fillable = ['dia', 'hora', 'grupo_id', 'lugar_id'] ;

    public function grupo(): BelongsTo
{
    return $this->belongsTo(Grupo::class, 'grupo_id');
}

public function lugar(): BelongsTo
{
    return $this->belongsTo(Lugar::class, 'lugar_id');
}
}
