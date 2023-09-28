<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);

        $regexPath = preg_replace('#{[^/]+}#', '([^/]+)', $path);

        $this->routes[] = [
            "path" => $path,
            "method" => strtoupper($method),
            "controller" => $controller,
            "middlewares" => [],
            "regexPath" => $regexPath
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, "/");
        $path = "/{$path}/";
        $path = preg_replace("#[/]{2,}#", "/", $path);
        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($_POST['_METHOD'] ?? $method);

        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['regexPath']}$#", $path, $paramValue) ||
                $route['method'] !== $method
            ) {
                continue;
            }


            array_shift($paramValue);

            preg_match_all('#{([^/]+)}#', $route['path'], $paramKey);

            $paramKey = $paramKey[1];

            $param = array_combine($paramKey, $paramValue);

            [$class, $function] = $route['controller'];

            $controller = $container ?
                $container->resolve($class) :
                new $class;

            $action = fn () => $controller->$function($param);

            $allMiddlewares = [...$route['middlewares'], ...$this->middlewares];

            foreach ($allMiddlewares as $middleware) {
                $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
                $action  = fn () => $middlewareInstance->process($action);
            }

            $action();

            return;
        }
    }

    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function addRouteMiddlware(string $middleware)
    {
        $lastRoute = array_key_last($this->routes);
        $this->routes[$lastRoute]['middlewares'][] = $middleware;
    }
}
