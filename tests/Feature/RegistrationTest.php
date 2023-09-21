<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegistration()
    {
        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'cellphone' => '(11) 994273409',
            'data_nascimento' => '1990-05-15',
            'you_are_gender' => 'Homem',
            'height' => 175.5,
            'you_look_for_gender' => 'Mulher',
            'password' => 'secret_password',
        ];

        // Send a POST request to your registration endpoint with the $data array.
        $response = $this->post('/api/register', $data);

        // Assert that the registration was successful.
        $response->assertStatus(201);

        // Assert that the response contains the user and a token.
        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'username',
                'email',
                'cellphone',
                'data_nascimento',
                'you_are_gender',
                'height',
                'you_look_for_gender',
            ],
            'token',
        ]);

        // You can also assert that the user was stored in the database.
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
        ]);
    }


    public function test_registration_requires_valid_data()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }
}

