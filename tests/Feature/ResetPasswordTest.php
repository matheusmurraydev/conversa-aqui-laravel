<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;

class ResetPasswordTest extends TestCase
{
    use WithFaker;

    // public function testSendPasswordResetLinkEmail()
    // {
    //     $response = $this->postJson('/forgot-password', ['email' => 'matheusmurraydev@gmail.com']);

    //     $response->assertStatus(200)
    //         ->assertJson(['message' => 'passwords.sent']);
    // }

    // public function testResetPassword()
    // {
    //     $user = User::where('email', 'matheusmurraydev@gmail.com')->first();
    //     $token = Password::createToken($user);

    //     $response = $this->postJson('/reset-password', [
    //         'email' => 'matheusmurarydev@gmail.com',
    //         'password' => 'password123',
    //         'password_confirmation' => 'password123',
    //         'token' => $token,
    //     ]);

    //     $response->assertStatus(200)
    //         ->assertJson(['message' => 'passwords.reset']);
    // }
}
