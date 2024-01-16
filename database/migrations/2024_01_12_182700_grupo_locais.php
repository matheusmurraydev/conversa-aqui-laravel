<?php
// database/migrations/xxxx_xx_xx_create_grupos_locais_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GrupoLocais extends Migration
{
    public function up()
    {
        Schema::create('grupo_locais', function (Blueprint $table) {
            $table->id();
            $table->string('nome_grupo');
            $table->text('descricao_grupo');
            $table->string('foto_grupo')->nullable();
            $table->json('administradores');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grupo_locais');
    }
}

