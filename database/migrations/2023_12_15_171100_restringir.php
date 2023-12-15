<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Restringir extends Migration
{
    public function up()
    {
        Schema::create('restringirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user_block')->nullable()->constrained('users');
            $table->foreignId('id_user_blocked')->nullable()->constrained('users');
            $table->boolean('todos')->default(false);
            $table->boolean('amigos')->default(false);
            $table->boolean('parentes')->default(false);
            $table->boolean('matches')->default(false);
            $table->string('palavras_chave')->nullable(); // Adicionando o campo de palavras-chave
            // Add other fields as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('restringirs');
    }
}
