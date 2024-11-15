<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Edificio>
 */
class EdificioFactory extends Factory
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

        $edificios = [
            ['Edificio K', 'K'],  
            ['Edificio D', 'D'],     
            ['Edificio H', 'H'],   
            ['Edificio de Industrial', 'EI'],  
            ['Edificio de Mecatronica y Electronica', 'EMyE'],  
            ['Laboratorio de Computo' ,'LC'],  
           
        ];

        return [
            'nombreedificio' => $edificios[$indice][0],
            'nombrecorto'    => $edificios[$indice][1]
        ];
    }
}
