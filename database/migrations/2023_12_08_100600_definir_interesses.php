<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('definir_interesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            // Definindo a chave estrangeira
            $table->foreign('id_user')->references('id')->on('users');

            // Adicionando colunas booleanas
            $table->boolean('academia')->default(false);
            $table->boolean('atletismo')->default(false);
            $table->boolean('artes_marciais')->default(false);
            $table->boolean('basquete')->default(false);
            $table->boolean('futebol')->default(false);
            $table->boolean('nenhum')->default(false);
            $table->boolean('prefiro_nao_informar')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('definir_interesses', function (Blueprint $table) {
            // Removendo a chave estrangeira
            $table->dropForeign(['id_user']);
        });

        // Removendo a tabela
        Schema::dropIfExists('definir_interesses');
    }
};
