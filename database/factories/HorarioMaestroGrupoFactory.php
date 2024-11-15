<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\HorarioMaestro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HorarioMaestroGrupo>
 */
class HorarioMaestroGrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'horario_maestro_id' => HorarioMaestro::factory(),  // Usa el factory de HorarioMaestro para generar una relación válida
            'grupo_id' => Grupo::factory(), 
        ];
    }
}
