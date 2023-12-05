<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PremiumTable extends Migration
{
    public function up()
    {
        Schema::create('premium', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data_de_nascimento');
            $table->string('e_mail')->nullable();
            $table->integer('idade');
            $table->string('cidade');
            $table->string('descricao')->nullable();
            $table->string('endereco')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('premium');
    }
}
