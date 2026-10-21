<?php

declare(strict_types=1);

use Keel\Config\HttpConfig;
use Keel\Http\Middleware\CorsMiddleware;
use Keel\Http\Middleware\RequestIdMiddleware;
use Keel\Http\Middleware\TrustedProxiesMiddleware;

// Global middleware, outermost first. Remove what you do not need.
return new HttpConfig(middleware: [
    TrustedProxiesMiddleware::class,
    RequestIdMiddleware::class,
    CorsMiddleware::class,
]);
