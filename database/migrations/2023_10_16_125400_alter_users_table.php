<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('perguntas_respostas', function (Blueprint $table) {
            $table->dropForeign('perguntas_respostas_user_id_foreign');
        });

        Schema::table('perguntas_respostas_discursivas', function (Blueprint $table) {
            $table->dropForeign('perguntas_respostas_discursivas_user_id_foreign');
        });

        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('user_type', ['user_cupom', 'user_rel', 'user_rel_amizade', 'user_amizade'])->default('user_rel');
            $table->timestamps();
        });

        Schema::table('perguntas_respostas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users'); // Recreate the foreign key constraint
        });

        Schema::table('perguntas_respostas_discursivas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users'); // Recreate the foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
