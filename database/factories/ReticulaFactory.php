<?php

namespace Database\Factories;

use App\Models\Carrera;
use App\Models\Reticula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reticula>
 */
class ReticulaFactory extends Factory
{
    protected $model = Reticula::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $indice = -1;

        $indice++;


        $reticulas = [
            ['Reticula de Sistemas', ' 2024-10-11', 1],
            ['Reticula de Electronica', ' 2024-10-11', 2],
            ['Reticula de Mecatronica', ' 2024-10-11', 3],
            ['Reticula de Mecanica', ' 2024-10-11', 4],
            ['Reticula de Contador', ' 2024-10-11', 5],
            ['Reticula de Gestion', ' 2024-10-11', 6],
            ['Reticula de Industrial', ' 2024-10-11', 7],
        ];

        return [
            'idreticula'  => fake()->unique()->numberBetween(1000, 9999),  
            'descripcion' => $reticulas[$indice][0],
            'fechaEnVigor' => $reticulas[$indice][1],
            'carrera_id' => $reticulas[$indice][2]
        ];
    }
}
