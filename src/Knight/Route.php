<?php

namespace Knight;

class Route
{
    protected string $uri;
    protected \Closure $action;
    protected string $regex;
    protected array $parameters;

    public function __construct(string $uri, \Closure $action)
    {
        $this->uri = $uri;
        $this->action = $action;
        $this->regex = preg_replace('/\{([a-zA-Z0-9]+)}/', '([a-zA-Z0-9]+)', $uri);
        preg_match_all('/\{([a-zA-Z0-9]+)}/', $uri, $parameters);
        $this->parameters = $parameters[1];
    }

    function uri(): string
    {
        return $this->uri;
    }

    function action(): callable|\Closure
    {
        return $this->action;
    }

    function regex(): string
    {
        return $this->regex;
    }

    function parameters(): array
    {
        return $this->parameters;
    }

    public function matches(string $uri): bool
    {
        return preg_match("#^$this->regex/?$#", $uri) === 1;
    }

    public function hasParameters(): bool
    {
        return count($this->parameters) > 0;
    }

    public function parseParameters(string $uri): array
    {
        preg_match("#^$this->regex$#", $uri, $arguments);
        array_shift($arguments);

        return array_combine($this->parameters, $arguments);
    }
}