<?php

declare(strict_types=1);

use Keel\Auth\AuthConfig;
use Keel\Auth\BearerTokenAuthenticator;

// Authenticators tried in order; routes opt in with #[Auth]. See src/Auth/ApiTokens.php.
return new AuthConfig([BearerTokenAuthenticator::class]);
