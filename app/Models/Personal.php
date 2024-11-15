<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    /** @use HasFactory<\Database\Factories\PersonalFactory> */
    use HasFactory;

    
    protected $fillable = ['noTrabajador', 'rfc', 'nombres','apellidop','apellidom',
    'licenciatura', 'licPasTit', 'especializacion','esPasTit',
    'maestria','maePasTit','doctorado', 'docPasTit',
    'fechaIngSep', 'fechaIngIns'
    ,'puesto_id', 'depto_id' ] ;


    public function depto()
    {
        return $this->belongsTo(Depto::class, 'depto_id');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id' );
    }

    public function horarioMaestro()
    {
        return $this->hasMany(HorarioMaestro::class);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function personalPlazas()
    {
        return $this->hasMany(PersonalPlaza::class);
    }
}
