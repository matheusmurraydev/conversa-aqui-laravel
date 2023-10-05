<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class LoginTest extends TestCase
{
    use WithFaker;

    public function testUserCupomCanLoginWithValidCredentials()
    {
        // Valid login credentials
        $credentials = [
            'email' => 'matheusmurraydev@gmail.com',
            'password' => 'password123',
        ];

        // Send a POST request to the login endpoint with valid credentials
        $response = $this->postJson('/api/login/user-cupom', $credentials);

        // Assert that the response has a status code of 200 (indicating success)
        $response->assertStatus(200);

        // Assert that the response JSON structure includes the 'user' and 'token' keys
        $response->assertJsonStructure(['user', 'token']);
    }

    public function testUserCupomLoginFailsWithInvalidCredentials()
    {
        // Invalid login credentials
        $invalidCredentials = [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ];

        // Send a POST request to the login endpoint with invalid credentials
        $response = $this->postJson('/api/login/user-cupom', $invalidCredentials);

        // Assert that the response has a status code of 401 (Unauthorized)
        $response->assertStatus(401);

        // Assert that the response JSON contains an 'error' key indicating unauthorized access
        $response->assertJson(['error' => 'Unauthorized']);
    }

    public function testUserRelCanLoginWithValidCredentials()
    {
        // Valid login credentials
        $credentials = [
            'email' => 'matheusmurraydev@gmail.com',
            'password' => 'password123',
        ];

        // Send a POST request to the login endpoint with valid credentials
        $response = $this->postJson('/api/login/user-rel', $credentials);

        // Assert that the response has a status code of 200 (indicating success)
        $response->assertStatus(200);

        // Assert that the response JSON structure includes the 'user' and 'token' keys
        $response->assertJsonStructure(['user', 'token']);
    }

    public function testUserRelLoginFailsWithInvalidCredentials()
    {
        // Invalid login credentials
        $invalidCredentials = [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ];

        // Send a POST request to the login endpoint with invalid credentials
        $response = $this->postJson('/api/login/user-rel', $invalidCredentials);

        // Assert that the response has a status code of 401 (Unauthorized)
        $response->assertStatus(401);

        // Assert that the response JSON contains an 'error' key indicating unauthorized access
        $response->assertJson(['error' => 'Unauthorized']);
    }

    public function testUserRelAmizadeCanLoginWithValidCredentials()
    {
        // Valid login credentials
        $credentials = [
            'email' => 'matheusmurraydev@gmail.com',
            'password' => 'password123',
        ];

        // Send a POST request to the login endpoint with valid credentials
        $response = $this->postJson('/api/login/user-rel-amizade', $credentials);

        // Assert that the response has a status code of 200 (indicating success)
        $response->assertStatus(200);

        // Assert that the response JSON structure includes the 'user' and 'token' keys
        $response->assertJsonStructure(['user', 'token']);
    }

    public function testUserRelAmizadeLoginFailsWithInvalidCredentials()
    {
        // Invalid login credentials
        $invalidCredentials = [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ];

        // Send a POST request to the login endpoint with invalid credentials
        $response = $this->postJson('/api/login/user-rel-amizade', $invalidCredentials);

        // Assert that the response has a status code of 401 (Unauthorized)
        $response->assertStatus(401);

        // Assert that the response JSON contains an 'error' key indicating unauthorized access
        $response->assertJson(['error' => 'Unauthorized']);
    }
}
