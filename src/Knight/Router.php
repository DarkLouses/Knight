<?php

namespace Knight;

class Router
{
    protected array $routes = [];

    public function __construct()
    {
        foreach (HttpMethod::cases() as $method) {
            $this->routes[$method->value] = [];
        }
    }

    /**
     * @throws HttpNotFoundException
     */
    public function resolve(string $method, string $uri)
    {
        $action = $this->routes[$method][$uri] ?? null;

        if (is_null($action)) {
            throw new HttpNotFoundException();
        }

        return $action;
    }

    public function get(string $uri, callable $callback): void
    {
        $this->routes[HttpMethod::GET->value][$uri] = $callback;
    }

    public function post(string $uri, callable $callback): void
    {
        $this->routes[HttpMethod::POST->value][$uri] = $callback;
    }

    public function put(string $uri, callable $callback): void
    {
        $this->routes[HttpMethod::PUT->value][$uri] = $callback;
    }

    public function delete(string $uri, callable $callback): void
    {
        $this->routes[HttpMethod::DELETE->value][$uri] = $callback;
    }

    public function patch(string $uri, callable $callback): void
    {
        $this->routes[HttpMethod::PATCH->value][$uri] = $callback;
    }
}