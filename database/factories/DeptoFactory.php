<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depto>
 */
class DeptoFactory extends Factory
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

        $depts = [
            ['Direccion', 'DIREC', 'DIR'],

            ['Subdireccion', 'SUBD','SU'], 

            ['Sistemas y computacion', 'Sist', 'ISC'],

            ['Electronica', 'Elect', 'IE'],

            ['Mecatronica', 'Mecat', 'IM'],

            ['Mecanica', 'MEC', 'IME'],

            ['Contabilidad','Conta', 'CP'],

            ['Gestion empresarial','Gestion', 'IGE'],

            ['Industrial','Ing', 'II'],

            ['Ciencias Basicas','Cienciasb', 'CB'],
        ];

        return [
            'idDepto' => fake()->unique()->numberBetween(1, 1000),
            'nombreDepto' => $depts[$indice][0],
            'nombreMediano' => $depts[$indice][1],
            'nombreCorto' => $depts[$indice][2],
        ];
    }
}
