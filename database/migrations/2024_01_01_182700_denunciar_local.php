<?php

// database/migrations/YYYY_MM_DD_create_locais_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DenunciarLocal extends Migration
{
    public function up()
    {
        Schema::create('denuncias_local', function (Blueprint $table) {
            $table->id();
            $table->string('endereco');
            $table->string('nome_lugar');
            $table->boolean('nome_incorreto')->default(false);
            $table->boolean('endereco_incorreto')->default(false);
            $table->boolean('foto_incorreta')->default(false);
            $table->boolean('foto_inadequada')->default(false);
            $table->string('descricao')->nullable()->default(null);
            $table->json('imagens')->nullable();
            $table->boolean('urgente')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('denunciar_local');
    }
}
