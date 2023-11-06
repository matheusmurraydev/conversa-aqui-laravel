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
        Schema::create('users_amizade', function (Blueprint $table) {
            $table->id();
            $table->string('cellphone');
            $table->date('data_nascimento');
            $table->enum('you_are_gender', ['Homem', 'Mulher', 'Outros']);
            $table->enum('estado_civil', ['Solteiro', 'Namorando', 'Divorciado', 'Viúvo', 'Casado', 'União Estável']);
            $table->enum('you_look_for_gender_friend', ['Homem', 'Mulher', 'Outros']);
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_amizade');
    }
};
