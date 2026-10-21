<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Subscribe;
use Keel\Http\Attribute\FromBody;
use Keel\Routing\Attribute\Get;
use Keel\Routing\Attribute\Post;
use Keel\Routing\Attribute\Status;

final class HomeController
{
    /** @return array<string, string> */
    #[Get('/', name: 'home')]
    public function home(): array
    {
        return ['hello' => 'keel'];
    }

    #[Post('/subscribe')]
    #[Status(201)]
    public function subscribe(#[FromBody] Subscribe $command): Subscribe
    {
        return $command;
    }
}

