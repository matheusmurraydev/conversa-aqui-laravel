<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker;

    public function testUserCanRegisterWithValidData()
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


    public function testUserRegistrationFailsWithInvalidData()
    {
        $invalidData = [];

        $response = $this->postJson('/api/register/user-cupom', $invalidData);

        $response->assertStatus(422);

        $response->assertJsonStructure(['error']);
    }
}
