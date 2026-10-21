<?php

declare(strict_types=1);

namespace App\Dto;

use Keel\Validation\Email;
use Keel\Validation\Length;
use Keel\Validation\NotBlank;

final readonly class Subscribe
{
    public function __construct(
        #[NotBlank, Length(max: 50)] public string $name,
        #[Email] public string $email,
    ) {}
}
