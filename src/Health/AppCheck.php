<?php

declare(strict_types=1);

namespace App\Health;

use Keel\Container\Attribute\Tag;
use Keel\Health\HealthCheck;
use Keel\Health\HealthResult;

/**
 * Example readiness check. Add one per dependency (database, cache, queue) and return
 * HealthResult::down() when it is unreachable; /health answers 503 until it is back.
 */
#[Tag(HealthCheck::TAG)]
final class AppCheck implements HealthCheck
{
    public function name(): string
    {
        return 'app';
    }

    public function check(): HealthResult
    {
        return is_writable(sys_get_temp_dir()) ? HealthResult::up() : HealthResult::down('temp dir not writable');
    }
}
