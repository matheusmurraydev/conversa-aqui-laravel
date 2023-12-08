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
        Schema::create('convidar_atividade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user_sent');
            $table->unsignedBigInteger('id_user_request');
            $table->text('message')->default(''); // Add a default value (empty string) to the 'message' field            
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_user_sent')->references('id')->on('users');
            $table->foreign('id_user_request')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('convidar_atividade', function (Blueprint $table) {
            $table->dropForeign(['id_user_sent']);
            $table->dropForeign(['id_user_request']);
        });

        Schema::dropIfExists('convidar_atividade');
    }
};
