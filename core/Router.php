<?php

namespace Core;

class Router
{
    protected static array $routes = [];

    public static function get(string $uri, callable|string $action): void
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post(string $uri, callable|string $action): void
    {
        self::$routes['POST'][$uri] = $action;
    }

    public static function put(string $uri, callable|string $action): void
    {
        self::$routes['PUT'][$uri] = $action;
    }

    public static function delete(string $uri, callable|string $action): void
    {
        self::$routes['DELETE'][$uri] = $action;
    }

    public static function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach (self::$routes[$method] ?? [] as $route => $action) {
            $pattern = preg_replace('#\{[a-zA-Z0-9]+\}#', '([0-9]+)', $route);
            $pattern = "#^" . $pattern . "$#";
            if (preg_match($pattern, $path, $matches)) {
                if (is_callable($action)) {
                    $action(...array_slice($matches, 1)); // Передаем параметры
                } elseif (is_string($action)) {
                    if (file_exists($action)) {
                        require $action;
                    } elseif (strpos($action, '@') !== false) {
                        [$controller, $method] = explode('@', $action);
                        $controller = "App\\Controllers\\{$controller}";
                        if (class_exists($controller) && method_exists($controller, $method)) {
                            $instance = new $controller();
                            $instance->$method($matches[1]); // Передаем ID
                        } else {
                            http_response_code(500);
                            echo "Ошибка: Контроллер или метод не найден";
                        }
                    } else {
                        http_response_code(500);
                        echo "Ошибка в маршруте";
                    }
                }
                return;
            }
        }

        http_response_code(404);
        echo "404 — Страница не найдена";
    }
}