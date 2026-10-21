# Keel skeleton

Project template for the [Keel](https://github.com/AloneCoder/keel) micro-framework.

```bash
composer create-project keel/skeleton my-app
cd my-app
composer serve            # http://127.0.0.1:8080 (php -S)
composer serve:worker     # FrankenPHP worker mode with --watch, needs the frankenphp binary
composer test
```

Out of the box: `GET /` and `POST /subscribe` (validated DTO, rate limited), `GET /hello/{name}`
(a Twig page from `templates/`, see `config/views.php` and `config/services.php`), `GET /me` behind
`#[Auth]` (bearer token from `API_TOKEN` in `.env`, see `src/Auth/ApiTokens.php`), `/health` and
`/health/live`, `/metrics` (Prometheus), `/openapi.json` and `/docs` (OpenAPI 3.1 derived from the
code). Middleware and endpoints are listed in `config/http.php`; remove what you do not need.

Layout: `config/` (config objects), `src/` (controllers, services, listeners, commands found by
discovery), `public/index.php` (one front controller for php-fpm, FrankenPHP worker mode and
RoadRunner), `bin/console` (`keel:routes`, `keel:compile`, `keel:preload`, your commands), `tests/`
(`TestClient`-based), `Caddyfile` + `Dockerfile` (FrankenPHP worker mode with compiled caches and
opcache preload).

Production: `APP_ENV=prod APP_DEBUG=0`, run `bin/console keel:compile` after each deploy, or use
the Dockerfile, which does it at build time.

## По-русски

Шаблон проекта на Keel. `composer create-project keel/skeleton my-app`, затем `composer serve`
(или `composer serve:worker` для FrankenPHP worker mode) и `composer test`. Из коробки: `GET /`,
`POST /subscribe` с валидацией и лимитом, `GET /hello/{name}` (страница на Twig из `templates/`),
`GET /me` под `#[Auth]` (bearer-токен из `API_TOKEN`
в `.env`), `/health`, `/metrics`, `/openapi.json` и `/docs`; состав — в `config/http.php`. Конфиги в `config/`, код в `src/` (находится discovery), один фронт-контроллер
`public/index.php` для php-fpm, FrankenPHP и RoadRunner, `bin/console` с командами `keel:*`,
тесты на `TestClient`, Dockerfile с FrankenPHP worker mode, скомпилированными кэшами и preload.
В prod после деплоя выполняйте `bin/console keel:compile`.
