<?php

namespace Database\Factories;

use App\Models\Depto;
use App\Models\Puesto;
use App\Models\Personal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personal>
 */
class PersonalFactory extends Factory
{
    protected $model = Personal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $indice = -1;

        $indice++;
       $maestros = [
        ['Antonio', 'Chavez', 'Soto', 3, 3],
        ['Aquiles', 'Gonzalez', 'Ramos', 3, 3],
        ['Flor de Maria', 'Rivera', 'Sanchez', 3, 3],
        ['Roberto', 'Espinoza', 'Torres', 3, 3],
        ['Hilda Patricia', 'Beltrán', 'Hernandez', 3, 3],
        ['Lourdes Arlin', 'Campoy', 'Medrano', 3, 3],
        ['Filiberto', 'Torres', 'Rabago', 3, 3],
        ['David Sergio', 'Castillón', 'Dominguez', 3, 3],
        ['Isidro', 'Garcia', 'Sierra', 3, 3],
        ['Flora Elida', 'Gonzalez', 'Tamez', 3, 3],

        ['Gustavo Emilio', 'Rojo', 'Velazquez', 4, 1],

        ['Carlos', 'Patiño', 'Chavez', 5, 2],
        ['Aida', 'Hernandez', 'Avila', 5, 2]
    ];



    return [
        'noTrabajador' => $this->faker->unique()->numberBetween(1000, 9999),
        'rfc' => $this->faker->unique()->regexify('[A-Z]{4}[0-9]{6}[A-Z][0-9]{2}'),

        'nombres' => $maestros[$indice][0], 
        'apellidop' => $maestros[$indice][1],
        'apellidom' => $maestros[$indice][2],

        'licenciatura' => $this->faker->word() . ' en ' . $this->faker->word(),
        'licPasTit' => $this->faker->randomElement(['S', 'N']),
        'especializacion' => $this->faker->word() . ' en ' . $this->faker->word(),
        'esPasTit' => $this->faker->randomElement(['S', 'N']),
        'maestria' => $this->faker->word() . ' en ' . $this->faker->word(),
        'maePasTit' => $this->faker->randomElement(['S', 'N']),
        'doctorado' => $this->faker->word() . ' en ' . $this->faker->word(),
        'docPasTit' => $this->faker->randomElement(['S', 'N']),
        'fechaIngSep' => $this->faker->date(),
        'fechaIngIns' => $this->faker->date(),

        'puesto_id' => $maestros[$indice][3],
        'depto_id' => $maestros[$indice][4],
    
    ];
}
}
