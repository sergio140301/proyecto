<?php

namespace Database\Seeders;

use App\Models\Hora;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hora::factory()->count(10)->create();
    }
}
