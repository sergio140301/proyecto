<?php

namespace Database\Factories;

use App\Models\Depto;
use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrera>
 */
class CarreraFactory extends Factory
{
    protected $model = Carrera::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $indice = -1;

        $indice++;

        // Definimos las carreras del Tecnológico de Piedras Negras
        $carreras = [
            ['Ingeniería en Sistemas Computacionales','Sistemas', 'ISC', 3],

            ['Ingeniería Electrónica','Electronica', 'IE', 4],

            ['Ingeniería mecatronica','Mecatronica', 'IM', 5],

            ['Ingeniería Mecánica','Mecanica', 'IME', 6],

            ['Contador publico', 'Contador', 'CP', 7],

            ['Ingeniería Gestion Empresarial', 'Gestion', 'IGE', 8],

            ['Ingeniería Industrial','Industrial', 'II', 9],

        ];

        return [
            'idCarrera'      => fake()->unique()->numberBetween(1000, 9999),  
            'nombreCarrera'  => $carreras[$indice][0],  
            'nombreMediano'  => $carreras[$indice][1],  
            'nombreCorto'    => $carreras[$indice][2],  
            'depto_id'       => $carreras[$indice][3]    
        ];
    }
}
