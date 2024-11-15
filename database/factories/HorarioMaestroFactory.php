<?php

namespace Database\Factories;

use App\Models\Periodo;
use App\Models\Personal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HorarioMaestro>
 */
class HorarioMaestroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha'         => $this->faker->date(),          
            'observaciones' => $this->faker->sentence(),      
            'personal_id'   => Personal::factory(),          
            'periodo_id'    => Periodo::factory(),    
        ];
    }
}
