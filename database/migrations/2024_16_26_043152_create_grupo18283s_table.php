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
        Schema::create('grupo18283s', function (Blueprint $table) {
            $table->id(); 
            $table->string('grupo')->unique(); 
            $table->string('descripcion');
            $table->integer('maxAlumnos'); 
            $table->foreignId('periodo_id')->constrained()->onUpdate('cascade'); 
            $table->foreignId('materia_id')->constrained()->onUpdate('cascade');  
            $table->foreignId('personal_id')->constrained()->onUpdate('cascade'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo18283s');
    }
};
