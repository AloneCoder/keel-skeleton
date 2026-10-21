<?php

declare(strict_types=1);

use Keel\Config\Env;
use Keel\Session\SessionConfig;

// APP_SECRET is generated into .env by "composer create-project"; set it yourself on servers.
// Enable sessions by adding Keel\Session\SessionMiddleware::class to config/http.php.
return static fn(Env $env): SessionConfig => new SessionConfig(
    secret: $env->get('APP_SECRET') ?: str_repeat('change-me-', 4),
    storage: $env->get('SESSION_STORAGE') ?: 'cookie',
);
