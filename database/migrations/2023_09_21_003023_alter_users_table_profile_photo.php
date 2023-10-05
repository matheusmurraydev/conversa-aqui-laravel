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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable();
        });
        Schema::table('users_cupom', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable();
        });
        Schema::table('users_rel', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable();
        });
        Schema::table('users_rel_amizade', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable();
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
