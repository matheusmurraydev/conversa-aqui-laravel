<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class LoginTest extends TestCase
{
    use WithFaker;

    public function testLoginWithValidCredentials()
    {
        $credentials = [
            'email' => 'matheusmurraydevcupom@gmail.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $credentials);

        $response->assertStatus(200);

        $response->assertJsonStructure(['user', 'token']);
    }

    public function testLoginFailsWithInvalidCredentials()
    {
        $invalidCredentials = [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ];

        $response = $this->postJson('/api/login', $invalidCredentials);

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthorized']);
    }
}
