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
            $table->boolean('todos')->default(false);
            $table->boolean('amigos')->default(false);
            $table->boolean('parentes')->default(false);
            $table->boolean('matches')->default(false);
            // Adicione outros campos conforme necessário
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('restringirs');
    }
}
