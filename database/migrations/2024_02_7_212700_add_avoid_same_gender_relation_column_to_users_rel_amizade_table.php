<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvoidSameGenderRelationColumnToUsersRelAmizadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_rel_amizade', function (Blueprint $table) {
            $table->boolean('avoid_same_gender_relation')->nullable()->default(false)->after('you_look_for_gender_friend');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_rel_amizade', function (Blueprint $table) {
            $table->dropColumn('avoid_same_gender_relation');
        });
    }
}
