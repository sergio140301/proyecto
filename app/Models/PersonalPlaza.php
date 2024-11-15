<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalPlaza extends Model
{
    /** @use HasFactory<\Database\Factories\PersonalPlazaFactory> */
    use HasFactory;

    protected $fillable = ['tipoNombramiento', 'plaza_id', 'personal_id' ];
    public function Personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    public function Plaza()
    {
        return $this->belongsTo(Plaza::class, 'plaza_id');
    }
}
