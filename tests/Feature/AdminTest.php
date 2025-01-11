<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function testRegisterSuccess(): void
    {
        $response = $this->postJson('/api/admin', [
            'name' => 'John Doe',
            'username' => 'jhon',
            'phone' => '081234567890',
            'email' => 'jhon@gmail.com',
            'password' => 'password',
            'token' => 'token',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'register success',
                'data' => [
                    'token' => 'token',
                    'admin' => [
                        'name' => 'John Doe',
                        'username' => 'jhon',
                        'phone' => '081234567890',
                        'email' => 'jhon@gmail.com',
                    ],
                ],
            ]);

        $this->assertMatchesRegularExpression(
            '/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/',
            $response->json('data.admin.id')
        );
    }

    public function testRegisterFailed(): void
    {
        $response = $this->postJson('/api/admin', [
            'name' => '',
            'username' => '',
            'phone' => '',
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'status' => 'error',
                'message' => [
                    'name' => ['The name field is required.'],
                    'username' => ['The username field is required.'],
                    'phone' => ['The phone field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
                'data' => null,
            ]);
    }


    // public function testRegisterFailed(): void
    // {
    //     $response = $this->postJson('/api/register', [
    //         'name' => 'John Doe',
    //         'email' => ' ',
    //         'password' => 'password',
    //         'password_confirmation' => 'password',
    //     ]);
    // }
}
