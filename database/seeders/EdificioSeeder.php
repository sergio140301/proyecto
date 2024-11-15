<?php

namespace Database\Seeders;

use App\Models\Edificio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EdificioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Edificio::factory()->count(6)->create();
    }
}
