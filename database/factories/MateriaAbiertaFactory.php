<?php

namespace Database\Factories;

use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Periodo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MateriaAbierta>
 */
class MateriaAbiertaFactory extends Factory
{
    protected $model = MateriaAbierta::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'periodo_id' => Periodo::factory(),   // Genera un periodo aleatorio
            'carrera_id' => Carrera::factory(),   // Genera una carrera aleatoria
            'materia_id' => Materia::factory(),   // Genera una materia aleatoria
        ];
    }
}
