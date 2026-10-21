<?php

declare(strict_types=1);

use Keel\Auth\AuthMiddleware;
use Keel\Config\HttpConfig;
use Keel\Health\HealthMiddleware;
use Keel\Http\Middleware\CorsMiddleware;
use Keel\Http\Middleware\RequestIdMiddleware;
use Keel\Http\Middleware\TrustedProxiesMiddleware;
use Keel\Metrics\MetricsMiddleware;
use Keel\OpenApi\OpenApiMiddleware;

// Global middleware, outermost first. Remove what you do not need.
return new HttpConfig(middleware: [
    TrustedProxiesMiddleware::class,
    RequestIdMiddleware::class,
    MetricsMiddleware::class,     // /metrics (Prometheus)
    HealthMiddleware::class,      // /health, /health/live
    CorsMiddleware::class,
    OpenApiMiddleware::class,     // /openapi.json, /docs
    AuthMiddleware::class,        // attaches the Principal when credentials are present
]);
