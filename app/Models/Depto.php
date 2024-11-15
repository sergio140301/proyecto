<?php

namespace App\Models;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depto extends Model
{
    /** @use HasFactory<\Database\Factories\DeptoFactory> */
    use HasFactory;

    //establece la relacion con carreras
    //muchos deptos tienen una carrera
    public function Carreras()
    {
        return $this->hasMany(Carrera::class);
    }

    public function personal()
    {
        return $this->hasMany(Personal::class);
    }

   
    protected $fillable = [
        'idDepto',
        'nombreDepto',
        'nombreMediano',
        'nombreCorto',
    ];
    
}
