<?php

namespace Database\Seeders;

use App\Models\Plaza;
use App\Models\Personal;
use App\Models\PersonalPlaza;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonalPlazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalPlaza::factory()->count(1)->create();
    }
}

