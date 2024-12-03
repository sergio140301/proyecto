<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesoria extends Model
{
    /** @use HasFactory<\Database\Factories\AsesoriaFactory> */
    use HasFactory;

    protected $fillable = ['fecha', 'horario', 'rendimiento_id', 'lugar_id', 'personal_id' ];

    public function Rendimiento()
    {
        return $this->belongsTo(Rendimiento::class, 'rendimiento_id');
    }

    public function Lugar()
    {
        return $this->belongsTo(Lugar::class, 'lugar_id');
    }

    public function Personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }


}