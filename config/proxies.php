<?php

declare(strict_types=1);

use Keel\Config\Env;
use Keel\Http\Middleware\TrustedProxiesConfig;

// TRUSTED_PROXIES="10.0.0.0/8,fd00::/8" or "*" when a load balancer always sits in front.
return static fn(Env $env): TrustedProxiesConfig => new TrustedProxiesConfig(
    array_values(array_filter(array_map(trim(...), explode(',', $env->get('TRUSTED_PROXIES', '') ?? '')))),
);
