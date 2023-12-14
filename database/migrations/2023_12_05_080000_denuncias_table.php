<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DenunciasTable extends Migration
{
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_sent')->nullable();
            $table->unsignedBigInteger('ID_denuncied')->nullable();
            $table->boolean('conteudo_improprio');
            $table->boolean('conteudo_violento');
            $table->text('texto_adicional')->nullable();
            $table->string('arquivo')->nullable()->unique();
            $table->boolean('conteudo_falso');
            $table->boolean('solicitou_dinheiro');
            $table->boolean('urgente')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('ID_sent')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ID_denuncied')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('denuncias');
    }
}
