<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materia extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaFactory> */
    use HasFactory;



    public function Reticula()
    {
        return $this->belongsTo(Reticula::class, 'reticula_id');
    }

    public function materiasAbiertas()
    {
        return $this->hasMany(MateriaAbierta::class);
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
