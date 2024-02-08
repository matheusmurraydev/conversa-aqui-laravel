<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustNullableColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('you_are_gender')->nullable()->change();
            $table->string('you_look_for_gender')->nullable()->change();
            $table->string('you_look_for_gender_friend')->nullable()->change();
            $table->string('estado_civil')->nullable()->change();
            $table->boolean('avoid_same_gender_relation')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('you_are_gender')->nullable(false)->change();
            $table->string('you_look_for_gender')->nullable(false)->change();
            $table->string('you_look_for_gender_friend')->nullable(false)->change();
            $table->string('estado_civil')->nullable(false)->change();
            $table->boolean('avoid_same_gender_relation')->nullable(false)->change();
        });
    }
}
