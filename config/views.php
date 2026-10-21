<?php

declare(strict_types=1);

use Keel\Config\Env;
use Keel\View\TwigConfig;

return static fn(Env $env, string $projectDir): TwigConfig => new TwigConfig(
    paths: [$projectDir . '/templates'],
    cache: $env->bool('APP_DEBUG') ? null : $projectDir . '/var/cache/twig',
    debug: $env->bool('APP_DEBUG'),
    globals: ['app_name' => $env->get('APP_NAME', 'My API')],
);
