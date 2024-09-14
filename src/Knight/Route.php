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

	public function action(): \Closure
	{
		return $this->action;
	}

	public function uri(): string
	{
		return $this->uri;
	}
}