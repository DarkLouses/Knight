<?php

namespace Knight\Routing;

/**
 * Class representing a route in the routing system.
 */
class Route
{
    /**
     * The URI pattern for the route.
     *
     * @var string
     */
    protected string $uri;

    /**
     * The action to be executed when the route is matched.
     *
     * @var \Closure
     */
    protected \Closure $action;

    /**
     * The regex pattern derived from the URI.
     *
     * @var string
     */
    protected string $regex;

    /**
     * The parameters extracted from the URI pattern.
     *
     * @var array
     */
    protected array $parameters;

    /**
     * Route constructor.
     *
     * @param string $uri The URI pattern for the route.
     * @param \Closure $action The action to be executed when the route is matched.
     */
    public function __construct(string $uri, \Closure $action)
    {
        $this->uri = $uri;
        $this->action = $action;
        $this->regex = preg_replace('/\{([a-zA-Z0-9]+)}/', '([a-zA-Z0-9]+)', $uri);
        preg_match_all('/\{([a-zA-Z0-9]+)}/', $uri, $parameters);
        $this->parameters = $parameters[1];
    }

    /**
     * Check if the given URI matches the route's pattern.
     *
     * @param string $uri The URI to check.
     * @return bool True if the URI matches, false otherwise.
     */
    public function matches(string $uri): bool
    {
        return preg_match("#^$this->regex/?$#", $uri) === 1;
    }

    /**
     * Check if the route has parameters.
     *
     * @return bool True if the route has parameters, false otherwise.
     */
    public function hasParameters(): bool
    {
        return count($this->parameters) > 0;
    }

    /**
     * Parse the parameters from the given URI.
     *
     * @param string $uri The URI to parse.
     * @return array The parsed parameters.
     */
    public function parseParameters(string $uri): array
    {
        preg_match("#^$this->regex$#", $uri, $arguments);
        array_shift($arguments);

        return array_combine($this->parameters, $arguments);
    }

    /**
     * Get the action to be executed when the route is matched.
     *
     * @return \Closure The action.
     */
    public function action(): \Closure
    {
        return $this->action;
    }

    /**
     * Get the URI pattern for the route.
     *
     * @return string The URI pattern.
     */
    public function uri(): string
    {
        return $this->uri;
    }
}