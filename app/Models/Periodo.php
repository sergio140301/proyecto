<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    /** @use HasFactory<\Database\Factories\PeriodoFactory> */
    use HasFactory;
    protected $table = 'periodos'; 

    public function tutorias()
    {
        return $this->hasMany(Tutoria::class, 'periodo_id');
    }
    protected $fillable = [
        'idPeriodo',
        'periodo',
        'desCorta',
        'fechaIni',
        'fechaFin',
    ];
}
