<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker;

    public function testUserCupomCanRegisterWithValidData()
    {
        // Generate valid data directly
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cellphone' => '(11) 123456789',
            'data_nascimento' => '1990-05-15',
            'you_are_gender' => 'Homem',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register/user-cupom', $data);

        $response->assertStatus(201);

        $response->assertJsonStructure(['user', 'token']);
    }


    public function testUserCupomRegistrationFailsWithInvalidData()
    {
        $invalidData = [];

        $response = $this->postJson('/api/register/user-cupom', $invalidData);

        $response->assertStatus(500);

        $response->assertJsonStructure(['error']);
    }

    public function testUserRelCanRegisterWithValidData()
    {
        // Generate valid data directly
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cellphone' => '(11) 123456789',
            'data_nascimento' => '1990-05-15',
            'you_are_gender' => 'Homem',
            'you_look_for_gender' => 'Mulher',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register/user-rel', $data);

        $response->assertStatus(201);

        $response->assertJsonStructure(['user', 'token']);
    }


    public function testUserRelRegistrationFailsWithInvalidData()
    {
        $invalidData = [];

        $response = $this->postJson('/api/register/user-rel', $invalidData);

        $response->assertStatus(500);

        $response->assertJsonStructure(['error']);
    }

    public function testUserRelAmizadeCanRegisterWithValidData()
    {
        // Generate valid data directly
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cellphone' => '(11) 123456789',
            'data_nascimento' => '1990-05-15',
            'you_are_gender' => 'Homem',
            'you_look_for_gender' => 'Mulher',
            'you_look_for_gender_friend' => 'Homem',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register/user-rel-amizade', $data);

        $response->assertStatus(201);

        $response->assertJsonStructure(['user', 'token']);
    }


    public function testUserRelAmizadeRegistrationFailsWithInvalidData()
    {
        $invalidData = [];

        $response = $this->postJson('/api/register/user-rel-amizade', $invalidData);

        $response->assertStatus(500);

        $response->assertJsonStructure(['error']);
    }
}
