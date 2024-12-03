<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_alumnos');
    }
};