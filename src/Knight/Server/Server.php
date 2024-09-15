<?php

namespace Knight\Server;

use Knight\Http\HttpMethod;
use Knight\Http\Response;

interface Server
{
    /**
     * Get the request URI.
     *
     * @return string The request URI.
     */
    public function requestUri() : string;

    /**
     * Get the request method.
     *
     * @return HttpMethod The request method.
     */
    public function requestMethod() : HttpMethod;

    /**
     * Get the POST data.
     *
     * @return array The POST data.
     */
    public function postData() : array;

    /**
     * Get the query parameters.
     *
     * @return array The query parameters.
     */
    public function queryParams() : array;

    /**
     * Send the response.
     *
     * @param Response $response The response to send.
     */
    public function sendResponse(Response $response) : void;
}