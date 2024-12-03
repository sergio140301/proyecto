<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HorarioAlumnosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alumno_id' => $this->faker->numberBetween(1, 50), // Suponiendo que tienes 50 alumnos
            'grupo_id' => $this->faker->numberBetween(1, 10),  // Suponiendo que tienes 10 grupos
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
