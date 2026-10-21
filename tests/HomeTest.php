<?php

declare(strict_types=1);

namespace App\Tests;

use Keel\App\App;
use Keel\Config\Env;
use Keel\Testing\TestClient;
use PHPUnit\Framework\TestCase;

final class HomeTest extends TestCase
{
    private TestClient $client;

    protected function setUp(): void
    {
        $this->client = TestClient::forApp(App::boot(dirname(__DIR__), new Env(['APP_ENV' => 'test', 'APP_DEBUG' => '1'])));
    }

    public function testHome(): void
    {
        $this->client->get('/')->assertOk()->assertJson(['hello' => 'keel']);
    }

    public function testSubscribeValidation(): void
    {
        $this->client->json('POST', '/subscribe', ['name' => 'Ann', 'email' => 'ann@example.test'])
            ->assertStatus(201)
            ->assertJsonPath('name', 'Ann');

        $this->client->json('POST', '/subscribe', ['name' => '', 'email' => 'nope'])
            ->assertProblem(400, 'Invalid request data', ['name: must not be blank', 'email: must be a valid email address']);
    }
}
