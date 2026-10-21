<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Subscribe;
use Keel\Auth\Attribute\Auth;
use Keel\Auth\Principal;
use Keel\Http\Attribute\FromBody;
use Keel\OpenApi\Attribute\Operation;
use Keel\RateLimit\Attribute\RateLimit;
use Keel\Routing\Attribute\Get;
use Keel\Routing\Attribute\Post;
use Keel\Routing\Attribute\Status;
use Keel\View\ViewRenderer;

#[Operation(tags: ['Home'])]
final class HomeController
{
    public function __construct(private readonly ViewRenderer $views) {}

    /** @return array<string, string> */
    #[Get('/', name: 'home')]
    #[Operation(summary: 'Hello')]
    public function home(): array
    {
        return ['hello' => 'keel'];
    }

    #[Post('/subscribe')]
    #[Status(201)]
    #[RateLimit(10, 60)]
    #[Operation(summary: 'Subscribe to the newsletter')]
    public function subscribe(#[FromBody] Subscribe $command): Subscribe
    {
        return $command;
    }

    #[Get('/hello/{name}')]
    #[Operation(summary: 'HTML page rendered with Twig')]
    public function hello(string $name): string
    {
        return $this->views->render('hello.twig', ['name' => $name]);
    }

    /** @return array<string, mixed> */
    #[Get('/me')]
    #[Auth]
    #[Operation(summary: 'Who am I', description: 'Send "Authorization: Bearer <API_TOKEN>".')]
    public function me(Principal $user): array
    {
        return ['id' => $user->id(), 'roles' => $user->roles()];
    }
}
