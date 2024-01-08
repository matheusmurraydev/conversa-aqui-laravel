<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Denunciar extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->boolean('conteudo_improprio');
            $table->boolean('conteudo_violento');
            $table->text('texto_adicional')->nullable();
            $table->string('arquivo')->nullable()->unique();
            $table->boolean('conteudo_falso');
            $table->boolean('solicitou_dinheiro');
            $table->boolean('urgente')->nullable();
            $table->unsignedBigInteger('id_sent'); // Assuming 'id_sent' is a foreign key referencing the 'id' column in the 'users' table
            $table->unsignedBigInteger('id_denuncied'); // Assuming 'id_denuncied' is a foreign key referencing the 'id' column in the 'users' table
            $table->unsignedBigInteger('user_id'); // Assuming 'user_id' is a foreign key referencing the 'id' column in the 'users' table
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_sent')->references('id')->on('users');
            $table->foreign('id_denuncied')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
}
