<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Puesto>
 */
class PuestoFactory extends Factory
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

        $tipos = [
            ['Profesor de Ingeniería Industrial', 'Docente'],
            ['Profesor de Electrónica', 'Docente'],
            ['Profesor de Sistemas Computacionales', 'Docente'],

            ['Director de Instituto', 'Direccion'],
            ['Subdirector', 'Direccion'],
            ['Director de Carrera', 'Direccion'],

            ['Jefe de Mantenimiento', 'No docente'],
            ['Asistente de Dirección', 'No docente'],
            ['Técnico de Soporte de TI', 'No docente'],

            ['Auxiliar de Biblioteca', 'Auxiliar'],
            ['Auxiliar de Laboratorio', 'Auxiliar'],
            ['Auxiliar de Informática', 'Auxiliar'],
            
            ['Secretario Administrativo', 'Administrativo'],
            ['Contador', 'Administrativo'],
            ['Recepcionista', 'Administrativo']
        ];
        

        return [

            'idpuesto' => fake()->bothify('??####'),
            'nombrepuesto' => $tipos[$indice][0],
            'tipo' => $tipos[$indice][1]

        ];

        
    }
}
