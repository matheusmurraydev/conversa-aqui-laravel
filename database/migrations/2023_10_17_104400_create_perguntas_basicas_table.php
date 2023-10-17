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
        Schema::create('perguntas_basicas', function (Blueprint $table) {
            $table->id();

            $table->string('user_type');

            $table->unsignedBigInteger('enunciado_id');
            $table->foreign('enunciado_id')->references('id')->on('perguntas_enunciados');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguntas_basicas');
    }
};
