<?php

namespace Knight\Server;

use Knight\Http\HttpMethod;

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
}