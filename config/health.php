<?php

declare(strict_types=1);

use Keel\Health\HealthConfig;

// Readiness runs every #[Tag(HealthCheck::TAG)] service in src/; liveness runs nothing.
return new HealthConfig(path: '/health', livenessPath: '/health/live');
