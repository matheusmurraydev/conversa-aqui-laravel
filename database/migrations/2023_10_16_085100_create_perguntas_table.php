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
        Schema::create('perguntas_enunciados', function (Blueprint $table) {
            $table->id();
            $table->string('enunciado');
            $table->enum('tipo', ['multipla_escolha', 'discursiva', 'unica_escolha']);
            $table->timestamps();
        });

        Schema::create('perguntas_opcoes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pergunta_id');
            $table->foreign('pergunta_id')->references('id')->on('perguntas_enunciados');

            $table->string('texto_opcao');

            $table->timestamps();
        });

        Schema::create('perguntas_respostas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pergunta_id');
            $table->foreign('pergunta_id')->references('id')->on('perguntas_enunciados');

            $table->unsignedBigInteger('opcao_selecionada_id');
            $table->foreign('opcao_selecionada_id')->references('id')->on('perguntas_opcoes');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('perguntas_respostas_discursivas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pergunta_id');
            $table->foreign('pergunta_id')->references('id')->on('perguntas_enunciados');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->text('resposta_do_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguntas_enunciados');
        Schema::dropIfExists('perguntas_opcoes');
        Schema::dropIfExists('perguntas_respostas');
        Schema::dropIfExists('perguntas_respostas_discursivas');
    }
};
