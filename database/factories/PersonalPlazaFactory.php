<?php

namespace Database\Factories;

use App\Models\Plaza;
use App\Models\Personal;
use App\Models\PersonalPlaza;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalPlaza>
 */
class PersonalPlazaFactory extends Factory
{
    protected $model = PersonalPlaza::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $indice = -1;

        $indice++;
        $personalplaza = [
            [10, 1, 3]
        ];

        return [
            'tipoNombramiento' => $personalplaza[$indice][0],
            'plaza_id' => $personalplaza[$indice][1],
            'personal_id' => $personalplaza[$indice][2],
        ];
    }
}
