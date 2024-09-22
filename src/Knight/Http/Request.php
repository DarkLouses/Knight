<?php

namespace Knight\Http;

use Knight\Routing\Route;
use Knight\Server\Server;

/**
 * Class representing an HTTP request.
 */
class Request
{
    /**
     * The URI of the request.
     *
     * @var string
     */
    protected string $uri;

    /**
     * The route of the request.
     *
     * @var Route
     */
    protected Route $route;

    /**
     * The HTTP method of the request.
     *
     * @var HttpMethod
     */
    protected HttpMethod $method;

    /**
     * The POST data of the request.
     *
     * @var array
     */
    protected array $data;

    /**
     * The query parameters of the request.
     *
     * @var array
     */
    protected array $query;

	protected array $headers = [];


    /**
     * Get the URI of the request.
     *
     * @return string The request URI.
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * Set the URI of the request.
     *
     * @param string $uri The new URI.
     * @return self
     */
    public function setUri(string $uri): self
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * Get the route of the request.
     *
     * @return Route The request route.
     */
    public function route(): Route
    {
        return $this->route;
    }

    /**
     * Set the route of the request.
     *
     * @param Route $route The new route.
     * @return self
     */
    public function setRoute(Route $route): self
    {
        $this->route = $route;
        return $this;
    }

    /**
     * Get the HTTP method of the request.
     *
     * @return HttpMethod The request method.
     */
    public function method(): HttpMethod
    {
        return $this->method;
    }

    /**
     * Set the HTTP method of the request.
     *
     * @param HttpMethod $method The new method.
     * @return self
     */
    public function setMethod(HttpMethod $method): self
    {
        $this->method = $method;
        return $this;
    }

	/**
	 * Get the POST data of the request.
	 *
	 * @param string|null $key
	 * @return array|mixed|null
	 */
    public function data(?string $key = null): mixed
    {
        if ($key !== null) {
			return $this->data[$key] ?? null;
		}
		return $this->data;
    }

    /**
     * Set the POST data of the request.
     *
     * @param array $data The new POST data.
     * @return self
     */
    public function setPostData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

	/**
	 * Get the query parameters of the request.
	 *
	 * @param string|null $key
	 * @return array|null The query parameters.
	 */
    public function query(?string $key = null): mixed
	{
		if ($key !== null) {
			return $this->query[$key] ?? null;
		}
		return $this->query;
	}

    /**
     * Set the query parameters of the request.
     *
     * @param array $query The new query parameters.
     * @return self
     */
    public function setQueryParameters(array $query): self
    {
        $this->query = $query;
        return $this;
    }

	public function headers(?string $key = null): mixed
	{
		if ($key !== null) {
			return $this->headers[$key] ?? null;
		}
		return $this->headers;
	}

	/**
	 * Set the headers of the request.
	 *
	 * @param array $headers The new headers.
	 * @return self
	 */
	public function setHeaders(array $headers): self
	{
		foreach ($headers as $key => $value) {
			$this->headers[strtolower($key)] = $value;
		}
		return $this;
	}

    /**
     * Get the route parameters.
     *
     * @param string|null $key The parameter key (optional).
     * @return array|mixed|null
     */
	public function routerParameters(?string $key = null): mixed
	{
		$parameters = $this->route->parseParameters($this->uri);
		if ($key !== null) {
			return $parameters[$key] ?? null;
		}
		return $parameters;
	}
}