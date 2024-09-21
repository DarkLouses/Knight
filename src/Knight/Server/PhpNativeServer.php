<?php

namespace Knight\Server;

use Knight\Http\HttpMethod;
use Knight\Http\Request;
use Knight\Http\Response;

/**
 * Class PhpNativeServer
 *
 * Implements the Server interface to handle HTTP requests and responses using PHP's native server variables and functions.
 */
class PhpNativeServer implements Server
{
    /**
     * Get the request URI.
     *
     * @return Request The HTTP request object.
     */
    public function getRequest(): Request
    {
        return (new Request(

        ))
            ->setUri($_SERVER['REQUEST_URI'])
            ->setMethod(HttpMethod::from($_SERVER['REQUEST_METHOD']))
            ->setPostData($_POST)
            ->setQueryParameters($_GET);
    }

    /**
     * Send the HTTP response.
     *
     * @param Response $response The HTTP response object.
     * @return void
     */
    public function sendResponse(Response $response): void
    {
        $response->prepare();
        http_response_code($response->status());
        foreach ($response->headers() as $header => $value) {
            header($header . ': ' . $value);
        }
        print($response->content());
    }

    /**
     * Get the request URI from the server variables.
     *
     * @return string The request URI.
     */
    public function requestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Get the request method from the server variables.
     *
     * @return string The request method.
     */
    public function requestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get the POST data from the server variables.
     *
     * @return array The POST data.
     */
    public function postData(): array
    {
        return $_POST;
    }

    /**
     * Get the query parameters from the server variables.
     *
     * @return array The query parameters.
     */
    public function queryParams(): array
    {
        return $_GET;
    }
}