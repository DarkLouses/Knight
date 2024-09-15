<?php

namespace Knight\Http;

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

    /**
     * Request constructor.
     *
     * @param Server $server The server instance providing request data.
     */
    public function __construct(Server $server)
    {
        $this->uri = $server->requestUri();
        $this->method = $server->requestMethod();
        $this->data = $server->postData();
        $this->query = $server->queryParams();
    }

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
     * Get the HTTP method of the request.
     *
     * @return HttpMethod The request method.
     */
    public function method(): HttpMethod
    {
        return $this->method;
    }

    /**
     * Get the POST data of the request.
     *
     * @return array The POST data.
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Get the query parameters of the request.
     *
     * @return array The query parameters.
     */
    public function query(): array
    {
        return $this->query;
    }
}