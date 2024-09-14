<?php

namespace Knight\Tests;

use Knight\HttpMethod;
use Knight\Server;

class MockServer implements Server
{
	public function __construct(public string $uri,  public HttpMethod $method) {
		$this->uri = $uri;
		$this->method = $method;
	}

	public function requestUri() : string
	{
		return $this->uri;
	}

	public function requestMethod() : HttpMethod
	{
		return $this->method;
	}

	public function postData() : array
	{
		return [] ;
	}

	public function queryParams() : array
	{
		return [];
	}
}