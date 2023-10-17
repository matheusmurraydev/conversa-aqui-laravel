<?php

namespace Database\Seeders;

use App\Models\PerguntasEnunciados;
use App\Models\PerguntasOpcoes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PerguntasSeeder extends Seeder
{
    public function run()
    {
        $perguntasData = [
            
            [
                'enunciado' => 'Qual é seu estado civil?',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Solteiro(a)',
                    'Namorando',
                    'Divorciado(a)',
                    'Viúvo(a)',
                    'Casado(a)',
                    'União estável'
                ]
            ],
            [
                'enunciado' => 'Que bairro você mora?',
                'tipo' => 'discursiva'
            ],
            [
                'enunciado' => 'Qual é a sua profissão?',
                'tipo' => 'discursiva'
            ],
            [
                'enunciado' => 'Qual a sua área de atuação?',
                'tipo' => 'discursiva'
            ],
            [
                'enunciado' => 'Neste momento, você está interessada(o) em (pode marcar mais de uma opção) - SOMENTE PRA ABA RELACIONAMENTO:',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Apenas algo casual',
                    'Nada sério, mas quem sabe...',
                    'Em princípio algo duradouro, mas quem sabe...',
                    'Somente algo duradouro!'
                ]
            ],
            [
                'enunciado' => 'Altura:',
                'tipo' => 'discursiva'
            ],
            [
                'enunciado' => 'Atividades físicas/esportes que você PRATICA ou TEM INTERESSE (marque todas que se aplicam):',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Não tenho interesse em nenhum esporte/atividade física',
                    'Academia',
                    'Artes Marciais',
                    'Atletismo',
                    'Badminton',
                    'Basquete',
                    'Beach Tennis',
                    'Canoagem',
                    'Caminhada',
                    'Ciclismo',
                    'Corrida',
                    'Crossfit',
                    'Escalada',
                    'Futebol',
                    'Futebol americano',
                    'Futevôlei',
                    'Ginástica artística',
                    'Ginástica funcional',
                    'Ginástica rítmica',
                    'Golfe',
                    'Halterofilismo',
                    'Handebol',
                    'Kitesurf',
                    'Natação',
                    'Pilates',
                    'Pole Dance',
                    'Rapel',
                    'Rugby',
                    'Stand Up Paddle',
                    'Spinning',
                    'Sumô',
                    'Surfe',
                    'Tênis',
                    'Tiro',
                    'Trilha',
                    'Vela',
                    'Vôlei',
                    'Vôlei de Praia',
                    'Wakeboard',
                    'Zumba',
                    'Prefiro não informar sobre isso',
                    'Outro'
                ]
            ],
            [
                'enunciado' => 'Você tem filhos/enteados ou alguém sob sua guarda?',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Não tenho filhos ou alguém sob minha guarda',
                    'Filho(s) que não moram comigo',
                    'Filho(s) - 0 a 3 anos - moram comigo',
                    'Filho(s) - 4 a 7 anos - moram comigo',
                    'Filho(s) - 8 a 12 anos - moram comigo',
                    'Filho(s) - 13 a 18 anos - moram comigo',
                    'Filho(s) adulto(s) - moram comigo',
                    'Prefiro não informar sobre isso'
                ]
            ],
            [
                'enunciado' => 'Sobre seu interesse em conhecer pessoas que cuidam de filhos (é possível marcar mais de 1):',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Não tenho nenhuma restrição com pessoas que já têm filhos ou alguém sob sua guarda',
                    'Não desejo conhecer pessoas que tenham filhos ou alguém sob sua guarda',
                    'Prefiro pessoas que não tenham filhos, mas a depender do caso, posso conhecer',
                    'Desejo exclusivamente conhecer pessoas que tenham filhos'
                ]
            ],
            [
                'enunciado' => 'Você ainda quer ter filhos? (apenas para quem marcou a aba relacionamento)',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Sim, com certeza',
                    'Provavelmente um dia',
                    'Não quero ter filhos',
                    'Ainda tenho dúvidas sobre isso'
                ]
            ],
            [
                'enunciado' => 'Qual é a sua escolaridade?',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Prefiro não informar',
                    'Ensino Fundamental',
                    'Ensino Médio',
                    'Cursando ensino superior',
                    'Ensino Superior',
                    'Mestrado',
                    'Doutorado',
                    'Pós-doutorado',
                    'Outro'
                ]
            ],    [
                'enunciado' => 'SOBRE HOBBIES OU CARACTERÍSTICAS, ASSINALE O QUE SE INTERESSA OU PRATICA:',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Não tenho interesse em nenhum hobbie/característica relevante',
                    'Acampar',
                    'Acupuntura',
                    'Artesanato',
                    'Astrologia',
                    'Boliche/Bolão',
                    'Canto',
                    'Cinema',
                    'Costura/bordado/tricô e afins',
                    'Colecionar objetos',
                    'Cozinha - amadora',
                    'Cozinha - profissional',
                    'Dança de salão',
                    'Dança do ventre',
                    'Dança - outros',
                    'Decoração',
                    'Desenho',
                    'Documentário (assistir)',
                    'Doulagem',
                    'Escrita',
                    'Fotografia',
                    'Frequentar jogos de futebol',
                    'Games (PC ou videogame)',
                    'Instrumento Musical - violão',
                    'Instrumento Musical - outro',
                    'Jardinagem/plantas',
                    'Jogos de Baralho',
                    'Jogos de Tabuleiro',
                    'Jornal',
                    'Leitura',
                    'Meditação',
                    'Motociclismo',
                    'Museus',
                    'Novela',
                    'Óleos essenciais',
                    'Pescar',
                    'Pintura',
                    'Piercing',
                    'Podcast',
                    'Pole Dance',
                    'Produção musical',
                    'Reality Show (assistir)',
                    'Reiki',
                    'Séries',
                    'Televisão',
                    'Tai Chi Chuan',
                    'Tarot',
                    'Tatuagens',
                    'Teatro (assistir peças)',
                    'Teatro (fazer aulas)',
                    'Terapia',
                    'Trilha',
                    'Voluntariado - templos religiosos',
                    'Voluntariado - outros',
                    'Xadrez',
                    'Yoga',
                    'Outro'
                ]
            ],
            [
                'enunciado' => 'Sobre hábitos de beber e comer, você:',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Não bebe',
                    'Bebe socialmente',
                    'Bebe com frequência',
                    'Vegetariano(a) - em transição',
                    'Vegetariano - praticante',
                    'Vegano - em transição',
                    'Vegano - praticante',
                    'Como apenas carnes brancas',
                    'Gosto bastante de churrasco',
                    'Gosto bastante de massas e pizzas',
                    'Gosto bastante de comida japonesa',
                    'Gosto bastante de lanches (fast food)',
                    'Gosto de uma dieta bem saudável',
                    'Tenho restrição a glúten',
                    'Tenho restrição a lactose',
                    'Prefiro não informar sobre isso'
                ]
            ],
            [
                'enunciado' => 'Quanto ao seu comportamento/características, assinale as alternativas que melhor te descrevem:',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Fumo',
                    'Não fumo',
                    'Diurno(a) - prefiro deitar mais cedo',
                    'Noturno(a) - prefiro deitar mais tarde',
                    'Gosto de ir em clubes sociais/de campo',
                    'Gosto de ir em parques ou praia',
                    'Gosto de sair em baladas',
                    'Gosto de sair em barzinhos',
                    'Gosto de ver filme/série em casa',
                    'Gosto de ir ao shopping',
                    'Saio bastante com amigos',
                    'Sou bem caseiro',
                    'Sou mais falante/extrovertido',
                    'Sou mais reservado(a)',
                    'Fico bastante com minha família',
                    'Sou uma pessoa com deficiência',
                    'Prefiro não informar sobre isso'
                ]
            ],
            [
                'enunciado' => 'Caso tenha interesse em conhecer pessoas com mesmos interesses políticos/sociais, assinale as pautas que você defende (todas as respostas são OPCIONAIS):',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Política: centro',
                    'Política: direita',
                    'Política: esquerda',
                    'Não tenho posição política no momento',
                    'Pauta armamentista',
                    'Pauta da defesa da família tradicional',
                    'Pauta do combate à corrupção',
                    'Pauta ecológica',
                    'Pauta feminista',
                    'Pauta LGBTQIA+ (direitos de homossexuais)',
                    'Pauta das PCD (Pessoas com Deficiência)',
                    'Pauta racial (e políticas afirmativas)',
                    'Prefiro não informar sobre isso',
                    'Outro:',
                ]
            ],
            [
                'enunciado' => 'Caso seja adepto ou simpatizante a uma crença/religião/filosofia e tenha interesse em conhecer pessoas com ideias afins, assinale abaixo (lembrando que a resposta é OPCIONAL)',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Ateu ou agnóstico',
                    'Não tenho religião, mas acredito em Deus',
                    'Budista',
                    'Candomblé',
                    'Católico(a)',
                    'Conscienciólogo(a)',
                    'Espírita',
                    'Evangélico(a)',
                    'Judeu',
                    'Logosofia',
                    'Muçulmano(a)',
                    'Rosa Cruz',
                    'Umbanda',
                    'Testemunha de Jeová',
                    'Xamã',
                    'Prefiro não informar sobre isso',
                ]
            ],
            [
                'enunciado' => 'Que ritmo musical mais gosta de ouvir? É possível marcar mais de uma opção:',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Sou muito eclética(o)',
                    'Anos 70 a 90',
                    'Axé',
                    'Blues/jazz',
                    'Brega pop',
                    'Clássica',
                    'Eletrônica',
                    'Funk',
                    'Folk',
                    'Gospel',
                    'Heavy Metal',
                    'Sertanejo',
                    'MPB',
                    'Pop Rock',
                    'Pisadinha',
                    'Rap',
                    'Reggae',
                    'Ritmos latinos (reggaeton, cumbia, entre outros)',
                    'Rock',
                    'Ritmos de dança de salão - forró, bolero, gafieira, tango, salsa, zouk, entre outros',
                    'Prefiro não informar sobre isso',
                    'Outro:',
                ]
            ],
            [
                'enunciado' => 'Sobre sua vida social e pessoal:',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Moro sozinho',
                    'Moro com colega(s)',
                    'Moro com a família',
                    'Tenho poucos familiares na cidade',
                    'Tenho vários familiares na cidade',
                    'Trabalho em home office (integral)',
                    'Trabalho em home office (parcial)',
                    'Tenho pet',
                    'Gosto de ter pet em casa',
                    'Gosto de receber pessoas em casa com frequência',
                    'Sou uma pessoa com deficiência',
                    'Viajei pra outro(s) país',
                    'Prefiro não informar sobre isso',
                ]
            ],
            [
                'enunciado' => 'Qual(is) língua(s) você fala?',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Português',
                    'Alemão',
                    'Espanhol',
                    'Francês',
                    'Inglês',
                    'Italiano',
                    'Japonês',
                    'Mandarim',
                    'Outro (ao clicar ... abre caixa com mais opções para filtragem - não precisa todos)',
                    'Prefiro não informar sobre isso',
                ]
            ],
            [
                'enunciado' => 'Normalmente, quais são seus horários livres?',
                'tipo' => 'multipla_escolha',
                'opcoes' => [
                    'Segunda - Manhã',
                    'Segunda - Tarde',
                    'Segunda - Noite',
                    'Segunda - Madrugada',
                    'Terça - Manhã',
                    'Terça - Tarde',
                    'Terça - Noite',
                    'Terça - Madrugada',
                    'Quarta - Manhã',
                    'Quarta - Tarde',
                    'Quarta - Noite',
                    'Quarta - Madrugada',
                    'Quinta - Manhã',
                    'Quinta - Tarde',
                    'Quinta - Noite',
                    'Quinta - Madrugada',
                    'Sexta - Manhã',
                    'Sexta - Tarde',
                    'Sexta - Noite',
                    'Sexta - Madrugada',
                    'Sábado - Manhã',
                    'Sábado - Tarde',
                    'Sábado - Noite',
                    'Sábado - Madrugada',
                    'Domingo - Manhã',
                    'Domingo - Tarde',
                    'Domingo - Noite',
                    'Domingo - Madrugada',
                    'TODAS AS MANHÃS',
                    'TODAS AS TARDES',
                    'TODAS AS NOITES',
                    'FINS DE SEMANA (genérico)',
                    'Prefiro não informar',
                    'Varia muito meus horários livres',
                ]
            ],
            [
                'enunciado' => 'Caso queira conhecer pessoas que tenham gostos parecidos, fique à vontade para escrever sobre livros ou autores que goste:',
                'tipo' => 'discursiva',
            ],
            [
                'enunciado' => 'Caso queira conhecer pessoas que tenham gostos parecidos, fique à vontade para falar sobre o que gosta de assistir (filmes, programas, séries ou na internet):',
                'tipo' => 'discursiva',
            ],
            [
                'enunciado' => 'Caso queira conhecer pessoas que tenham gostos parecidos, fique à vontade para falar sobre o que gosta de assistir (filmes, programas, séries ou na internet):',
                'tipo' => 'discursiva',
            ],
            [
                'enunciado' => 'Liste perfis do Instagram que gosta ou tipos de redes sociais que prefere (o que poderá facilitar encontros de pessoas que buscam o mesmo que você):',
                'tipo' => 'discursiva',
            ]
        ];

        foreach ($perguntasData as $data) {
            $pergunta = PerguntasEnunciados::create([
                'enunciado' => $data['enunciado'],
                'tipo' => $data['tipo'],
            ]);

            if (isset($data['opcoes']) && is_array($data['opcoes'])) {
                foreach ($data['opcoes'] as $opcaoText) {
                    PerguntasOpcoes::create([
                        'pergunta_id' => $pergunta->id,
                        'texto_opcao' => $opcaoText,
                    ]);
                }
            }
        }
    }
}
