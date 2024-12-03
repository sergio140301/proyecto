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
        Schema::create('asesorias', function (Blueprint $table) {
            $table->id();
            // Campos
            $table->date('fecha'); // Campo de tipo date
            $table->string('horario'); // Campo string

            // Llaves foráneas
            $table->foreignId('rendimiento_id')->constrained();
            $table->foreignId('lugar_id')->constrained();
            $table->foreignId('personal_id')->constrained();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesorias');
    }
};