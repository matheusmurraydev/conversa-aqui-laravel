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
        Schema::table('perguntas_basicas', function (Blueprint $table) {
            $table->enum('user_type', ['user_cupom', 'user_rel', 'user_rel_amizade'])->default('user_cupom')->change();
        });
    }

    public function down()
    {
        Schema::table('perguntas_basicas', function (Blueprint $table) {
            $table->string('user_type')->change();
        });
    }
};
