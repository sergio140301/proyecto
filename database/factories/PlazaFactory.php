<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plaza>
 */
class PlazaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $indice = -1;

        $indice++;
        $plazas = [
            ['E3817'],
            ['E3815'],
            ['E3717'],
            ['E3617'],
            ['E3520'],
        ];

        return [
            'idplaza' => fake()->bothify('???####'),
            'nombreplaza' => $plazas[$indice][0],  
        ];
    }
}


