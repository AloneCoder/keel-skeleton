<?php

declare(strict_types=1);

use Keel\Config\ServicesConfig;
use Keel\View\TwigProvider;

// Service providers: integrations and your own Definitions. See config/views.php for Twig.
return new ServicesConfig([TwigProvider::class]);
