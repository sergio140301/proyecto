<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horario_alumnos', function (Blueprint $table) {
            $table->id(); // Campo id bigint UN AI PK
            $table->unsignedBigInteger('alumno_id'); // Campo alumno_id bigint UN
            $table->unsignedBigInteger('grupo_id');  // Campo grupo_id bigint UN
            $table->timestamps(); // Campos created_at y updated_at como timestamps
        });

        DB::table('horario_alumnos')->insert([
            ['alumno_id' => 1, 'grupo_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['alumno_id' => 1, 'grupo_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['alumno_id' => 1, 'grupo_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_alumnos');
    }
};
