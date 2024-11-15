<?php

namespace Database\Seeders;

use App\Models\Reticula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReticulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reticula::factory()->count(7)->create();
    }
}
