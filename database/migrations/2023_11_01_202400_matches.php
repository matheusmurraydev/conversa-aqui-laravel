<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user_1');
            $table->unsignedBigInteger('id_user_2');
            $table->enum('option_user_1', ['curtiu', 'hoje_nao', 'talvez_depois', 'super_like']);
            $table->enum('option_user_2', ['curtiu', 'hoje_nao', 'talvez_depois', 'super_like']);
            $table->timestamps();

            $table->foreign('id_user_1')->references('id')->on('users');
            $table->foreign('id_user_2')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
