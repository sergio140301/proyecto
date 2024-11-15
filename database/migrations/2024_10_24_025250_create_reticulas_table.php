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
   Schema::create('reticulas', function (Blueprint $table) {
    $table->id();
    $table->string('idReticula', 15)->unique();
    $table->string('Descripcion', 200);
    $table->date('fechaEnVigor');
    $table->foreignId('carrera_id')->constrained();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reticulas');
    }
};
