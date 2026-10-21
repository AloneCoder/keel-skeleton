<?php

declare(strict_types=1);

use Keel\Config\Env;
use Keel\Session\SessionConfig;

// Enable by adding Keel\Session\SessionMiddleware::class to config/http.php and setting APP_SECRET.
return static fn(Env $env): SessionConfig => new SessionConfig(
    secret: $env->get('APP_SECRET') ?? str_repeat('change-me-', 4),
    storage: $env->get('SESSION_STORAGE', 'cookie') ?? 'cookie',
);
