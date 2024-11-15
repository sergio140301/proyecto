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
        Schema::create('personals', function (Blueprint $table) {
            $table->id(); 
            $table->string('noTrabajador', 50)->unique(); 
            $table->string('rfc', 13)->unique(); 
            $table->string('nombres', 50); 
            $table->string('apellidop', 50); 
            $table->string('apellidom', 50); 
            $table->string('licenciatura', 200)->nullable(); 
            $table->char('licPasTit', 1)->default('N');
            $table->string('especializacion', 200)->nullable(); 
            $table->char('esPasTit', 1)->default('N'); 
            $table->string('maestria', 200)->nullable(); 
            $table->char('maePasTit', 1)->default('N'); 
            $table->string('doctorado', 200)->nullable(); 
            $table->char('docPasTit', 1)->default('N'); 
            $table->date('fechaIngSep')->nullable();
            $table->date('fechaIngIns')->nullable(); 
            $table->foreignId('puesto_id')->constrained()->onDelete('cascade'); // Relación con la tabla puestos
            $table->foreignId('depto_id')->constrained()->onDelete('cascade'); // Relación con la tabla departamentos
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
