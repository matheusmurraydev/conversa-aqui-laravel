<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntasRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perguntas_respostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pergunta_id');
            $table->unsignedBigInteger('opcao_selecionada_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('pergunta_id')->references('id')->on('perguntas_enunciados')->onDelete('cascade');
            // Ajustando a chave estrangeira para permitir valores nulos
            $table->foreign('opcao_selecionada_id')->references('id')->on('perguntas_opcoes')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perguntas_respostas');
    }
}
