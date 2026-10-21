<?php

declare(strict_types=1);

use Keel\App\App;

require dirname(__DIR__) . '/vendor/autoload.php';

// php-fpm, the built-in server, FrankenPHP worker mode and RoadRunner all start here.
exit(App::boot(dirname(__DIR__))->run());
