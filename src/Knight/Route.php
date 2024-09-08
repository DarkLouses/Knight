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
        $this->regex = preg_replace('/\{([a-zAZ])}/', '\[a-zA-Z0-9]/', $uri);
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

    function regex(): array|string|null
    {
        return $this->regex;
    }

    function parameters(): array
    {
        return $this->parameters;
    }

    public function matches(): bool
    {
        return preg_match("#^$this->regex$#", $this->uri);
    }

    public function hasParameters(): bool
    {
        return count($this->parameters) > 0;
    }

    public function parseParameters(string $uri): array
    {
        preg_match("#^$this->regex$#", $uri, $arguments);

        return array_combine($this->parameters, array_slice($arguments, 1));
    }
}