<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBasicaToPerguntasEnunciadosTable extends Migration
{
    public function up()
    {
        Schema::table('perguntas_enunciados', function (Blueprint $table) {
            $table->string('basica')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('perguntas_enunciados', function (Blueprint $table) {
            $table->dropColumn('basica');
        });
    }
}
