<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    /** @use HasFactory<\Database\Factories\PlazaFactory> */
    use HasFactory;

    protected $fillable = ['idplaza','nombreplaza'];

    public function personalPlazas()
    {
        return $this->hasMany(PersonalPlaza::class);
    }
    
}


