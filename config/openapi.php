<?php

declare(strict_types=1);

use Keel\Config\Env;
use Keel\OpenApi\OpenApiConfig;

return static fn(Env $env): OpenApiConfig => new OpenApiConfig(
    title: $env->get('APP_NAME', 'My API') ?? 'My API',
    version: '1.0.0',
    specPath: '/openapi.json',
    docsPath: '/docs',
);
