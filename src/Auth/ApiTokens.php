<?php

declare(strict_types=1);

namespace App\Auth;

use Keel\Auth\Identity;
use Keel\Auth\Principal;
use Keel\Auth\PrincipalResolver;
use Keel\Config\Env;
use Keel\Container\Attribute\Alias;

/**
 * Resolves bearer tokens. This starter accepts the single token from API_TOKEN in .env;
 * replace it with a lookup in your database or token service.
 */
#[Alias(PrincipalResolver::class)]
final class ApiTokens implements PrincipalResolver
{
    public function __construct(private readonly Env $env) {}

    public function resolve(string $credential): ?Principal
    {
        $token = $this->env->get('API_TOKEN');
        if ($token === null || $token === '' || !hash_equals($token, $credential)) {
            return null;
        }

        return new Identity('api', ['admin']);
    }
}
