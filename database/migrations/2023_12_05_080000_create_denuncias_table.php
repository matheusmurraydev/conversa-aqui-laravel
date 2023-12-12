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
        Schema::create('denunciar', function (Blueprint $table) {
            $table->id();
            $table->boolean('conteudo_improprio');
            $table->boolean('conteudo_violento');
            $table->text('texto_adicional')->nullable();
            $table->string('arquivo')->nullable()->unique(); // Adicionado índice único
            $table->boolean('conteudo_falso');
            $table->boolean('solicitou_dinheiro');
            $table->boolean('urgente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denunciar');
    }
};
