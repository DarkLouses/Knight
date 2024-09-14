<?php

namespace Knight\Server;

use Knight\Http\HttpMethod;

interface Server
{
	public function requestUri() : string;
	public function requestMethod() : HttpMethod;
	public function postData() : array;
	public function queryParams() : array;
}