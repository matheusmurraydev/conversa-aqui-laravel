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
            $table->string('username')->default('');
            $table->string('cellphone', 15)->default('');
            $table->date('data_nascimento')->default('1970-01-01');
            $table->enum('you_are_gender', ['Homem', 'Mulher', 'Outros'])->default('Outros');
            $table->decimal('height', 5, 2)->default(0.00);
            $table->enum('you_look_for_gender', ['Homem', 'Mulher', 'Outros'])->default('Outros');
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
