<?php

declare(strict_types=1);

use Keel\Config\Env;
use Keel\Http\Middleware\CorsConfig;

return static fn(Env $env): CorsConfig => new CorsConfig(
    allowedOrigins: array_values(array_filter(explode(',', $env->get('CORS_ORIGINS', '*') ?? '*'))),
    allowCredentials: $env->bool('CORS_CREDENTIALS'),
);
