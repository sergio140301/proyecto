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
        Schema::create('tutorias', function (Blueprint $table) {
            $table->id('idTutorias');
            $table->foreignId('personal_id')->constrained('personals')->onUpdate('cascade');
           
            $table->foreignId('alumno_id')->constrained('alumnos')->onUpdate('cascade');
            $table->foreignId('materia_id')->constrained('materias')->onUpdate('cascade');
            $table->foreignId('carrera_id')->constrained('carreras')->onUpdate('cascade');
            $table->foreignId('periodo_id')->constrained('periodos')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorias');
    }
};
