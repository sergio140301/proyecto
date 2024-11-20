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
        Schema::create('grupo_horarios', function (Blueprint $table) {
            $table->id();                     
            $table->string('dia');             
            $table->time('hora');              
            $table->foreignId('grupo_id')->constrained()->onUpdate('cascade');     
            $table->foreignId('lugar_id')->constrained()->onUpdate('cascade');      
            $table->timestamps();             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_horarios');
    }
};
