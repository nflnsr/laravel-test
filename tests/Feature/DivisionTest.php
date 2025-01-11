<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DivisionTest extends TestCase
{
    public function tesGetDivisionSuccess(): void
    {
        $response = $this->getJson('/api/division');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'get division success',
                'data' => [
                    [
                        'id' => '1',
                        'name' => 'Division 1',
                        'description' => 'Description 1',
                    ]
                ],
            ]);

        $this->assertMatchesRegularExpression(
            '/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/',
            $response->json('data.0.id')
        );
    }
}
