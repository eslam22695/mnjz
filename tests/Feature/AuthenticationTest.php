<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "Test User",
            "email" => "test_user@test.test",
            "password" => "12345678",
            "confirm_password" => "12345678"
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    'id',
                    'name',
                    'email',
                    'token',
                ]
            ]);
    }
}
