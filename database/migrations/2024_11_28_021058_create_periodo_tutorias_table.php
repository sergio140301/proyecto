<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('periodo_tutorias', function (Blueprint $table) {
            $table->id();
            // Campos
            $table->date('fecha_ini'); // Campo de tipo date
            $table->date('fecha_fin'); // Campo de tipo date
            $table->foreignId('periodo_id')->constrained(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodo_tutorias');
    }
};