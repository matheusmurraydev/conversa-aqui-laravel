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
        Schema::create('bloquear', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user_block');
            $table->unsignedBigInteger('id_user_blocked');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_user_block')->references('id')->on('users');
            $table->foreign('id_user_blocked')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bloquear', function (Blueprint $table) {
            $table->dropForeign(['id_user_block']);
            $table->dropForeign(['id_user_blocked']);
        });

        Schema::dropIfExists('bloquear');
    }
};
