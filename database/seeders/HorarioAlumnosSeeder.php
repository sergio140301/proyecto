<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HorarioAlumnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('horario_alumnos')->insert([
            ['alumno_id' => 1, 'grupo_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['alumno_id' => 1, 'grupo_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['alumno_id' => 1, 'grupo_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
