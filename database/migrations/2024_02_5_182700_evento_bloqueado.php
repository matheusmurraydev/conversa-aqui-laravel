<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventoBloqueado extends Migration
{
    public function up()
    {
        Schema::create('evento_bloqueado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_evento');
            $table->text('descricao');
            $table->boolean('urgente');
            $table->string('imagem')->nullable();
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('id_usuario')->references('id')->on('users');
            // Adicione outras chaves estrangeiras, se necessário

            $table->foreign('id_evento')->references('id')->on('eventos');
            // Substitua 'eventos' pelo nome real da tabela de eventos
        });
    }

    public function down()
    {
        Schema::dropIfExists('evento_bloqueado');
    }
}
