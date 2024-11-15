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
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('idMateria',10)->unique();
            $table->tinyInteger('semestre')->unsigned()->check('semestre >= 1 AND semestre <= 9');
            $table->string('nombreMateria',200);
            $table->char('nivel',1);
            $table->string('nombreMediano',25);
            $table->string('nombreCorto',10);
            $table->char('modalidad',1);
            $table->foreignId('reticula_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
