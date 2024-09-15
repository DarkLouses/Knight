<?php

namespace Knight\Server;

use Knight\Http\HttpMethod;
use Knight\Http\Response;

class PhpNativeServer implements Server
{
    /**
     * Get the request URI.
     *
     * @return string The request URI.
     */
    public function requestUri() : string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Get the request method.
     *
     * @return HttpMethod The request method.
     */
    public function requestMethod() : HttpMethod
    {
        return HttpMethod::from($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Get the POST data.
     *
     * @return array The POST data.
     */
    public function postData() : array
    {
        return $_POST;
    }

    /**
     * Get the query parameters.
     *
     * @return array The query parameters.
     */
    public function queryParams() : array
    {
        return $_GET;
    }

    /**
     * Send the response.
     *
     * @param Response $response The response to send.
     */
    public function sendResponse(Response $response) : void
    {
        $response->prepare();
        http_response_code($response->status());
        foreach ($response->headers() as $header => $value) {
            header($header . ': ' . $value);
        }
        print($response->content());
    }
}