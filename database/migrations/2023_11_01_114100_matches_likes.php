<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matches_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_user_liked');
            $table->enum('option', ['curtiu', 'hoje_nao', 'talvez_depois', 'super_like']);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_user_liked')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matches_likes');
    }
};
