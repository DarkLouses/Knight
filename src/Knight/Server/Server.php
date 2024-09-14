<?php

namespace Knight\Server;

use Knight\Http\HttpMethod;
use Knight\Http\Response;

interface Server
{
	public function requestUri() : string;
	public function requestMethod() : HttpMethod;
	public function postData() : array;
	public function queryParams() : array;
	public function sendResponse(Response $response) : void;
}