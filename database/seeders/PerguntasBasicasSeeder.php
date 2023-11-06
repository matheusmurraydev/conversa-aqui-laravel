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
                'enunciado_id' => 44, //Qual é a sua profissão
            ],
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 58, //Que ritmo musical mais gosta de ouvir? É possível marcar mais de uma opção:
            ],
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 57, //Caso seja adepto ou simpatizante a uma crença/religião/filosofia e tenha interesse em conhecer pessoas com ideias afins, assinale abaixo (lembrando que a resposta é OPCIONAL)
            ],
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 58, //Caso tenha interesse em conhecer pessoas com mesmos interesses políticos/sociais, assinale as pautas que você defende (todas as respostas são OPCIONAIS):
            ],
            [
                'user_type' => 'user_rel',
                'enunciado_id' => 54 //Sobre hábitos de beber e comer, você:
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 44, //Qual é a sua profissão?
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 58, //Que ritmo musical mais gosta de ouvir? É possível marcar mais de uma opção:
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 57, //Caso seja adepto ou simpatizante a uma crença/religião/filosofia e tenha interesse em conhecer pessoas com ideias afins, assinale abaixo (lembrando que a resposta é OPCIONAL)
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 56, //Caso tenha interesse em conhecer pessoas com mesmos interesses políticos/sociais, assinale as pautas que você defende (todas as respostas são OPCIONAIS):
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 54 //Sobre hábitos de beber e comer, você:
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 48, //Atividades físicas/esportes que você PRATICA ou TEM INTERESSE (marque todas que se aplicam):
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 53, //SOBRE HOBBIES OU CARACTERÍSTICAS, ASSINALE O QUE SE INTERESSA OU PRATICA:
            ],
            [
                'user_type' => 'user_rel_amizade',
                'enunciado_id' => 49 //Você tem filhos/enteados ou alguém sob sua guarda?
            ],
        ];

        foreach ($perguntas as $pergunta) {
            PerguntasBasicas::create($pergunta);
        }
    }
}
