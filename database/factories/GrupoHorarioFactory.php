<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\GrupoHorario;
use App\Models\Lugar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GrupoHorario>
 */
class GrupoHorarioFactory extends Factory
{
    protected $model = GrupoHorario::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dia'       => $this->faker->dayOfWeek(),     
            'hora'      => $this->faker->time(),          
            'grupo_id'  => Grupo::factory(),                
            'lugar_id'  => Lugar::factory(),    
        ];
    }
}
