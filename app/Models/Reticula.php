<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Importa la clase HasMany
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reticula extends Model
{
    use HasFactory;

    protected $fillable = ['idReticula', 'Descripcion', 'fechaEnVigor', 'carrera_id'];

    // Define la relación con Materia


    //pq tenia reticula_id? lo necesita?
    
    public function materias(): HasMany 
    {
        return $this->hasMany(Materia::class); 
    }

    // Define la relación con el modelo Carrera
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
}
