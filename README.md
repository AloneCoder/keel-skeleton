# Keel skeleton

Project template for the [Keel](https://github.com/AloneCoder/keel) micro-framework.

```bash
composer create-project keel/skeleton my-app
cd my-app
composer serve            # http://127.0.0.1:8080
composer test
```

Layout: `config/` (config objects), `src/` (controllers, services, listeners, commands found by
discovery), `public/index.php` (one front controller for php-fpm, FrankenPHP worker mode and
RoadRunner), `bin/console` (`keel:routes`, `keel:compile`, `keel:preload`, your commands), `tests/`
(`TestClient`-based), `Caddyfile` + `Dockerfile` (FrankenPHP worker mode with compiled caches and
opcache preload).

Production: `APP_ENV=prod APP_DEBUG=0`, run `bin/console keel:compile` after each deploy, or use
the Dockerfile, which does it at build time.

## По-русски

Шаблон проекта на Keel. `composer create-project keel/skeleton my-app`, затем `composer serve`
и `composer test`. Конфиги в `config/`, код в `src/` (находится discovery), один фронт-контроллер
`public/index.php` для php-fpm, FrankenPHP и RoadRunner, `bin/console` с командами `keel:*`,
тесты на `TestClient`, Dockerfile с FrankenPHP worker mode, скомпилированными кэшами и preload.
В prod после деплоя выполняйте `bin/console keel:compile`.
