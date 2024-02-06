<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventoUsuarios extends Migration
{
    public function up()
    {
        Schema::create('evento_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_evento');
            $table->unsignedBigInteger('id_local')->nullable();
            $table->string('acao');
            $table->timestamps();

            // Definindo as chaves estrangeiras
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_evento')->references('id')->on('eventos');
            $table->foreign('id_local')->references('id')->on('locais')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evento_usuarios');
    }
}
