<?php

namespace Knight\Server;

use Knight\Http\HttpMethod;
use Knight\Http\Response;

class PhpNativeServer implements Server
{
	public function requestUri() : string
	{
		return $_SERVER['REQUEST_URI'];
	}

	public function requestMethod() : HttpMethod
	{
		return HttpMethod::from($_SERVER['REQUEST_METHOD']);
	}

	public function postData() : array
	{
		return $_POST;
	}

	public function queryParams() : array
	{
		return $_GET;
	}

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