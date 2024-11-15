<?php

namespace Database\Seeders;

use App\Models\Depto;
use App\Models\Alumno;
use App\Models\Carrera;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Depto::factory()->count(10)->create();
        // // Crea un departamento con 3 carreras, cada una con 4 alumnos
        // Depto::factory()
        // ->count(10)
        // ->has(
        //     Carrera::factory()
        //         ->count(7)
        //         ->has(Alumno::factory()->count(20))
        // )
        // ->create();
    }
}
