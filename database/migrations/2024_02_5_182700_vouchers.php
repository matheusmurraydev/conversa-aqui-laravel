<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vouchers extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->boolean('para_delivery');
            $table->boolean('para_local');
            $table->decimal('valor', 8, 2);
            $table->text('descricao');
            $table->timestamp('valido_ate');
            $table->json('validade_especifica')->nullable();
            $table->integer('quantidade_maxima')->nullable();
            $table->boolean('para_cliente_novo');
            $table->boolean('para_cliente_geral');
            $table->string('imagem')->nullable();
            $table->boolean('gerar_qr_code');
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
