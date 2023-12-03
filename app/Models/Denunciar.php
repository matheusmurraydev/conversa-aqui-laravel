<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->boolean('conteudo_impropio');
            $table->boolean('conteudo_violento');
            $table->text('texto_adicional')->nullable();
            $table->string('arquivo')->nullable();
            $table->boolean('conteudo_falso');
            $table->boolean('solicitou_dinheiro');
            $table->boolean('urgente')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('denuncias');
    }
}
