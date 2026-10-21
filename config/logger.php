<?php

declare(strict_types=1);

use Keel\Config\Env;
use Keel\Log\LoggerConfig;

return static fn(Env $env): LoggerConfig => new LoggerConfig(
    stream: $env->get('LOG_STREAM', 'php://stderr') ?? 'php://stderr',
    level: $env->get('LOG_LEVEL', 'debug') ?? 'debug',
);
