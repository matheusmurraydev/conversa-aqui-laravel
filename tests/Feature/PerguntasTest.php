<?php

namespace Tests\Feature;

use App\Models\PerguntasEnunciados;
use App\Models\User;
use Tests\TestCase;

class PerguntasTest extends TestCase
{
    // public function testIndexWithOpcoes()
    // {
    //     $response = $this->get('/api/perguntas');

    //     $response->assertStatus(200);

    //     $response->assertJsonCount(PerguntasEnunciados::count(), 'opcoes');
    // }

    // public function testIndexWithOpcoesBasicas()
    // {
    //     $user = User::where("email", "matheusmurraydevcupom@gmail.com")->get();

    //     $response = $this->actingAs($user)->get('/api/perguntas/basicas');

    //     $response->assertStatus(200)
    //         ->assertJsonCount(1)
    //         ->assertJsonCount(3, 'enunciados.0.opcoes');
    // }

    // public function testCreatePergunta()
    // {
    //     $data = [
    //         'enunciado' => 'Test Enunciado',
    //         'tipo' => 'multipla_escolha',
    //         'opcoes' => ['Option A', 'Option B'],
    //     ];

    //     $response = $this->postJson('/api/perguntas', $data);

    //     $response->assertStatus(201)
    //         ->assertJsonFragment(['enunciado' => $data['enunciado']]);
    // }

    // public function testCreateResposta()
    // {
    //     $user = User::where("email", "matheusmurraydevcupom@gmail.com")->get();

    //     $data = [
    //         'pergunta_id' => 1,
    //         'opcao_selecionada_id' => 1,
    //     ];

    //     $response = $this->actingAs($user)->postJson('/api/perguntas', $data);

    //     $response->assertStatus(201)
    //         ->assertJsonFragment(['pergunta_id' => $data['pergunta_id'], 'opcao_selecionada_id' => $data['opcao_selecionada_id']]);
    // }
}
