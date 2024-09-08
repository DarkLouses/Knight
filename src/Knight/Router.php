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
        foreach ($this->routes[$method] as $route) {
            if ($route->matches()) {
                return $route;
            }
        }
        throw new HttpNotFoundException();
    }

    protected function registerRoute(HttpMethod $method , string $uri, \Closure $action): void
    {
        $this->routes[$method->value][] = new Route($uri, $action);
    }

    public function get(string $uri, \Closure $action): void
    {
        $this->RegisterRoute(HttpMethod::GET, $uri, $action);
    }

    public function post(string $uri, \Closure $action): void
    {
        $this->RegisterRoute(HttpMethod::POST, $uri, $action);
    }

    public function put(string $uri, \Closure $action): void
    {
        $this->RegisterRoute(HttpMethod::PUT, $uri, $action);
    }

    public function delete(string $uri, \Closure $action): void
    {
        $this->RegisterRoute(HttpMethod::DELETE, $uri, $action);
    }

    public function patch(string $uri, \Closure $action): void
    {
        $this->RegisterRoute(HttpMethod::PATCH, $uri, $action);
    }
}