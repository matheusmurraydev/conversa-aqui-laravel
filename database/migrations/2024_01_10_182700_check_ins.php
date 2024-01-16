<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CheckIns extends Migration
{
    public function up()
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('local_id'); // Chave estrangeira para a tabela de locais
            // Outras colunas necessárias

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('local_id')->references('id')->on('locais');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('check_ins');
    }
}

