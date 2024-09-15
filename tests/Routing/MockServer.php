<?php

namespace Knight\Tests\Routing;

use Knight\Http\HttpMethod;
use Knight\Server\Server;

/**
 * Class MockServer
 *
 * A mock implementation of the Server interface for testing purposes.
 */
class MockServer implements Server
{
    /**
     * Constructor for MockServer.
     *
     * @param string $uri The request URI.
     * @param HttpMethod $method The HTTP method of the request.
     */
    public function __construct(public string $uri, public HttpMethod $method) {
        $this->uri = $uri;
        $this->method = $method;
    }

    /**
     * Get the request URI.
     *
     * @return string The request URI.
     */
    public function requestUri() : string
    {
        return $this->uri;
    }

    /**
     * Get the request method.
     *
     * @return HttpMethod The HTTP method of the request.
     */
    public function requestMethod() : HttpMethod
    {
        return $this->method;
    }

    /**
     * Get the post data.
     *
     * @return array An empty array (mock implementation).
     */
    public function postData() : array
    {
        return [];
    }

    /**
     * Get the query parameters.
     *
     * @return array An empty array (mock implementation).
     */
    public function queryParams() : array
    {
        return [];
    }
}