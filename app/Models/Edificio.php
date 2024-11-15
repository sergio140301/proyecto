<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    /** @use HasFactory<\Database\Factories\EdificioFactory> */
    use HasFactory;

    protected $fillable = ['nombreedificio', 'nombrecorto'] ;

    public function lugares()
    {
        return $this->hasMany(Lugar::class);
    }

}
