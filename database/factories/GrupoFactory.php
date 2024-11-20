<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\Materia;
use App\Models\MateriaAbierta;
use App\Models\Periodo;
use App\Models\Personal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grupo>
 */
class GrupoFactory extends Factory
{
    protected $model = Grupo::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          ///
        ];
    }
}
