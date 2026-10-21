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
        $env = new Env(['APP_ENV' => 'test', 'APP_DEBUG' => '1', 'API_TOKEN' => 'test-token']);
        $this->client = TestClient::forApp(App::boot(dirname(__DIR__), $env));
    }

    public function testHome(): void
    {
        $this->client->get('/')->assertOk()->assertJson(['hello' => 'keel']);
    }

    public function testSubscribeValidation(): void
    {
        $this->client->json('POST', '/subscribe', ['name' => 'Ann', 'email' => 'ann@example.test'])
            ->assertStatus(201)
            ->assertJsonPath('name', 'Ann')
            ->assertHeader('RateLimit-Limit', '10');

        $this->client->json('POST', '/subscribe', ['name' => '', 'email' => 'nope'])
            ->assertProblem(400, 'Invalid request data', ['name: must not be blank', 'email: must be a valid email address']);
    }

    public function testTwigPage(): void
    {
        $this->client->get('/hello/%3CAnn%3E')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/html; charset=utf-8')
            ->assertBodyContains('<h1>Hello, &lt;Ann&gt;</h1>')
            ->assertBodyContains('<title>Hello &lt;Ann&gt; · My API</title>');
    }

    public function testProtectedRoute(): void
    {
        $this->client->get('/me')->assertProblem(401)->assertHeader('WWW-Authenticate', 'Bearer realm="api"');
        $this->client->get('/me', ['Authorization' => 'Bearer test-token'])->assertOk()->assertJson(['id' => 'api']);
    }

    public function testOperationalEndpoints(): void
    {
        $this->client->get('/health')->assertOk()->assertJsonPath('status', 'up');
        $this->client->get('/openapi.json')->assertOk()->assertJsonPath('info.title', 'My API');
        $this->client->get('/metrics')->assertOk()->assertBodyContains('http_requests_total');
    }
}
