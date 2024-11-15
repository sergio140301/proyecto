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
        Schema::create('deptos', function (Blueprint $table) {
            $table->id();
            $table->string('idDepto')->unique();
            $table->string('nombreDepto',100)->unique();
            $table->string('nombreMediano',15)->nullable();
            $table->string('nombreCorto',5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deptos');
    }
};
