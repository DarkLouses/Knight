<?php

namespace Knight\Routing;

use Knight\Http\HttpMethod;
use Knight\Http\HttpNotFoundException;
use Knight\Http\Request;

/**
 * Class Router
 *
 * Handles the registration and resolution of routes.
 */
class Router
{
    /**
     * Array of registered routes grouped by HTTP method.
     *
     * @var array
     */
    protected array $routes = [];

    /**
     * Router constructor.
     *
     * Initializes the routes array for each HTTP method.
     */
    public function __construct()
    {
        foreach (HttpMethod::cases() as $method) {
            $this->routes[$method->value] = [];
        }
    }

    /**
     * Resolves the given request to a route.
     *
     * @param Request $request The HTTP request to resolve.
     * @return Route The matched route.
     * @throws HttpNotFoundException If no matching route is found.
     */
    public function resolve(Request $request)
    {
        foreach ($this->routes[$request->method()->value] as $route) {
            if ($route->matches($request->uri())) {
                return $route;
            }
        }
        throw new HttpNotFoundException();
    }

    /**
     * Registers a new route.
     *
     * @param HttpMethod $method The HTTP method for the route.
     * @param string $uri The URI pattern for the route.
     * @param \Closure $action The action to be executed when the route is matched.
     */
    protected function registerRoute(HttpMethod $method, string $uri, \Closure $action): void
    {
        $this->routes[$method->value][] = new Route($uri, $action);
    }

    /**
     * Registers a GET route.
     *
     * @param string $uri The URI pattern for the route.
     * @param \Closure $action The action to be executed when the route is matched.
     */
    public function get(string $uri, \Closure $action): void
    {
        $this->registerRoute(HttpMethod::GET, $uri, $action);
    }

    /**
     * Registers a POST route.
     *
     * @param string $uri The URI pattern for the route.
     * @param \Closure $action The action to be executed when the route is matched.
     */
    public function post(string $uri, \Closure $action): void
    {
        $this->registerRoute(HttpMethod::POST, $uri, $action);
    }

    /**
     * Registers a PUT route.
     *
     * @param string $uri The URI pattern for the route.
     * @param \Closure $action The action to be executed when the route is matched.
     */
    public function put(string $uri, \Closure $action): void
    {
        $this->registerRoute(HttpMethod::PUT, $uri, $action);
    }

    /**
     * Registers a DELETE route.
     *
     * @param string $uri The URI pattern for the route.
     * @param \Closure $action The action to be executed when the route is matched.
     */
    public function delete(string $uri, \Closure $action): void
    {
        $this->registerRoute(HttpMethod::DELETE, $uri, $action);
    }

    /**
     * Registers a PATCH route.
     *
     * @param string $uri The URI pattern for the route.
     * @param \Closure $action The action to be executed when the route is matched.
     */
    public function patch(string $uri, \Closure $action): void
    {
        $this->registerRoute(HttpMethod::PATCH, $uri, $action);
    }
}