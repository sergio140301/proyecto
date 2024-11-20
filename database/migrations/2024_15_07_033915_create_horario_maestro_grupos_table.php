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
        Schema::create('horario_maestro_grupos', function (Blueprint $table) {
            $table->id();                         
            $table->foreignId('horario_maestro_id') 
                  ->constrained()                 
                  ->onUpdate('cascade');        
            $table->foreignId('grupo_id')          
                  ->constrained()                 
                  ->onUpdate('cascade');          
            $table->timestamps();       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_maestro_grupos');
    }
};
