<?php

namespace Core;

class Router
{
    protected static array $routes = [];

    public static function get(string $uri, callable|string $action): void
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $action = self::$routes[$method][$path] ?? null;

        if ($action === null) {
            http_response_code(404);
            echo "404 — Страница не найдена";
            return;
        }

        if (is_callable($action)) {
            $action();
        } elseif (is_string($action) && file_exists($action)) {
            require $action;
        } else {
            http_response_code(500);
            echo "Ошибка в маршруте";
        }
    }

}
