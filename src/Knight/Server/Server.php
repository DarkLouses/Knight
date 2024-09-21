<?php

namespace Knight\Server;

use Knight\Http\Request;
use Knight\Http\Response;

interface Server
{
	/**
	 * Get the request URI.
	 *
	 * @return mixed
	 */
	public function getRequest() : Request;

    /**
     * Send the response.
     *
     * @param Response $response The response to send.
     */
    public function sendResponse(Response $response) : void;
}