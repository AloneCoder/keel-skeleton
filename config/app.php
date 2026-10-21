<?php

declare(strict_types=1);

use Keel\Config\AppConfig;
use Keel\Config\Env;

return static fn(Env $env, string $projectDir): AppConfig => AppConfig::fromEnv($projectDir, $env);
