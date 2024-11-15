<?php

namespace Database\Seeders;

use App\Models\HorarioMaestro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioMaestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HorarioMaestro::factory()->count(10)->create();
    }
}
