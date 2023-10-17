<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('perguntas_basicas')->insert([
            ['user_type' => 'user_cupom', 'enunciado_id' => 1, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_cupom', 'enunciado_id' => 2, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_cupom', 'enunciado_id' => 5, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_cupom', 'enunciado_id' => 3, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_cupom', 'enunciado_id' => 4, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel', 'enunciado_id' => 1, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel', 'enunciado_id' => 2, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel', 'enunciado_id' => 5, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel', 'enunciado_id' => 3, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel', 'enunciado_id' => 4, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel_amizade', 'enunciado_id' => 1, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel_amizade', 'enunciado_id' => 2, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel_amizade', 'enunciado_id' => 5, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel_amizade', 'enunciado_id' => 3, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
            ['user_type' => 'user_rel_amizade', 'enunciado_id' => 4, 'created_at' => '2023-10-16 20:56:26', 'updated_at' => '2023-10-16 20:56:26'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguntas_basicas');
    }
};
