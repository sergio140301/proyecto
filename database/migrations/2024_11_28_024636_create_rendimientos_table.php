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
        Schema::create('rendimientos', function (Blueprint $table) {
            $table->id();
            $table->integer('temasEv'); // Campo de tipo int
            $table->char('resultado', 1); // Campo de tipo char(1)
            $table->boolean('asesoria')->default(0); // Campo booleano con valor por defecto 0
            $table->text('problematica')->nullable(); // Campo nullable
            $table->text('observaciones')->nullable(); // Campo que puede ser nulo
            $table->integer('seguimiento'); // Campo de tipo int
            $table->foreignId('form_alumno_id')->constrained(); // Relación con tabla FormAlumno noc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendimientos');
    }
};
