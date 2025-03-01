<?php

// database/migrations/YYYY_MM_DD_create_locais_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Locais extends Migration
{
    public function up()
    {
        Schema::create('locais', function (Blueprint $table) {
            $table->id();
            $table->string('endereco');
            $table->string('nome_lugar');
            $table->string('nome_pessoa')->nullable();
            $table->string('tipo_local');
            $table->json('imagens')->nullable();
            $table->json('interesses')->nullable();
            $table->string('gosto_musical')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('locais');
    }
}
