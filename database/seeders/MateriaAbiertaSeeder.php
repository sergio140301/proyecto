<?php

namespace Database\Seeders;

use App\Models\MateriaAbierta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriaAbiertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MateriaAbierta::factory()->count(20)->create();
    }
}
