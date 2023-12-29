<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionarUsuariosVisualizacao extends Migration
{
    public function up()
    {
        Schema::create('adicionar_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->nullable()->constrained('users');
            $table->foreignId('id_user_visualizacao')->nullable()->constrained('users');
            
            // Defina um nome explícito para a chave estrangeira para evitar duplicatas
            $table->foreign('id_user_visualizacao', 'fk_visualizacao_user_id')
                  ->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adicionar_usuarios_visualizacao');
    }
}
