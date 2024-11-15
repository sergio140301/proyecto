<?php

namespace Database\Seeders;

use App\Models\HorarioMaestroGrupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioMaestroGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HorarioMaestroGrupo::factory()->count(10)->create();
    }
}
