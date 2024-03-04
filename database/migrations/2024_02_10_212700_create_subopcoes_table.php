<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubopcoesTable extends Migration
{
    public function up()
    {
        Schema::create('subopcoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opcao_id');
            $table->foreign('id')->references('id')->on('perguntas_opcoes')->onDelete('cascade');
            $table->string('texto');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subopcoes');
    }
}
