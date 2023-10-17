<?php

namespace Database\Seeders;

use App\Models\PerguntasBasicas;
use Illuminate\Database\Seeder;

class PerguntasBasicasSeeder extends Seeder
{
    public function run()
    {
        // Sample data for PerguntasBasicas
        $perguntas = [
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 20,
            ],
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 34,
            ],
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 33,
            ],
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 32,
            ],
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 30
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 20,
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 34,
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 33,
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 32,
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 30
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 24,
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 29,
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 25
            ],
        ];

        foreach ($perguntas as $pergunta) {
            PerguntasBasicas::create($pergunta);
        }
    }
}
