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
        Schema::create('materia_abiertas', function (Blueprint $table) {
            $table->id(); // ID de la materia abierta
            $table->foreignId('periodo_id')->constrained()->onUpdate('cascade'); 

            $table->foreignId('materia_id')->constrained()->onUpdate('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_abiertas');
    }
};
