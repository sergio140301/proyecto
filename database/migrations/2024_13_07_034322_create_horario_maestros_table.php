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
        Schema::create('horario_maestros', function (Blueprint $table) {
            $table->id();                         
            $table->date('fecha');                 
            $table->text('observaciones')->nullable(); 
            $table->foreignId('personal_id')       
                  ->constrained()                 
                  ->onDelete('cascade');          
            $table->foreignId('periodo_id')       
                  ->constrained()                 
                  ->onDelete('cascade');         
            $table->timestamps();                 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_maestros');
    }
};
