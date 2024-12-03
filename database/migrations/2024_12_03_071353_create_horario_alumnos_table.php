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

            // Insertar valores fijos
            DB::table('horario_alumnos')->insert([
                ['id' => 22, 'materia_id' => 1, 'periodo_tutoria_id' => 26, 'alumno_id' => 1, 'created_at' => '2024-12-03 05:12:44', 'updated_at' => '2024-12-03 05:12:44'],
                ['id' => 23, 'materia_id' => 1, 'periodo_tutoria_id' => 26, 'alumno_id' => 1, 'created_at' => '2024-12-03 05:16:07', 'updated_at' => '2024-12-03 05:16:07'],
                ['id' => 24, 'materia_id' => 2, 'periodo_tutoria_id' => 26, 'alumno_id' => 1, 'created_at' => '2024-12-03 05:16:07', 'updated_at' => '2024-12-03 05:16:07'],
                ['id' => 25, 'materia_id' => 3, 'periodo_tutoria_id' => 26, 'alumno_id' => 1, 'created_at' => '2024-12-03 05:16:07', 'updated_at' => '2024-12-03 05:16:07'],
                ['id' => 26, 'materia_id' => 1, 'periodo_tutoria_id' => 26,  'alumno_id' => 1,'created_at' => '2024-12-03 05:16:10', 'updated_at' => '2024-12-03 05:16:10'],
                ['id' => 27, 'materia_id' => 2, 'periodo_tutoria_id' => 26, 'alumno_id' => 1, 'created_at' => '2024-12-03 05:16:10', 'updated_at' => '2024-12-03 05:16:10'],
                ['id' => 28, 'materia_id' => 3, 'periodo_tutoria_id' => 26, 'alumno_id' => 1, 'created_at' => '2024-12-03 05:16:10', 'updated_at' => '2024-12-03 05:16:10'],
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
