<?php

namespace Knight\Tests\Http;

use Knight\Http\HttpMethod;
use Knight\Http\Request;
use Knight\Routing\Route;
use Knight\Tests\MockServer;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
	public function testRequestUriIsSetCorrectly(): void
	{
		$request = (new Request())
			->setUri('/test-uri')
			->setMethod(HttpMethod::POST)
			->setPostData([])
			->setQueryParameters([]);

		$this->assertEquals('/test-uri', $request->uri());
	}

	public function testRequestMethodIsSetCorrectly(): void
	{
		$request = (new Request())
			->setUri('/test-uri')
			->setMethod(HttpMethod::POST)
			->setPostData([])
			->setQueryParameters([]);

		$this->assertEquals(HttpMethod::POST, $request->method());
	}

	public function testRequestDataIsSetCorrectly(): void
	{
		$request = (new Request())
			->setUri('/test-uri')
			->setMethod(HttpMethod::POST)
			->setPostData([])
			->setQueryParameters([]);

		$this->assertEquals([], $request->data());
	}

	public function testRequestQueryParamsAreSetCorrectly(): void
	{
		$request = (new Request())
			->setUri('/test-uri')
			->setMethod(HttpMethod::POST)
			->setPostData([])
			->setQueryParameters([]);

		$this->assertEquals([], $request->query());
	}

	public function testRequestHandlesEmptyPostData(): void
	{
		$request = (new Request())
			->setUri('/test-uri')
			->setMethod(HttpMethod::POST)
			->setPostData([])
			->setQueryParameters([]);

		$this->assertEquals([], $request->data());
	}

	public function testRequestHandlesEmptyQueryParams(): void
	{
		$request = (new Request())
			->setUri('/test-uri')
			->setMethod(HttpMethod::POST)
			->setPostData([])
			->setQueryParameters([]);

		$this->assertEquals([], $request->query());
	}

	public function testDataReturnsValueIfKeyIsGiven(): void
	{
		$request = (new Request())
			->setUri('/test-uri')
			->setMethod(HttpMethod::POST)
			->setPostData(['key' => 'value'])
			->setQueryParameters([]);

		$this->assertEquals('value', $request->data('key'));
	}

	public function testQueryReturnsValueIfKeyIsGiven(): void
	{
		$request = (new Request())
			->setUri('/test-uri')
			->setMethod(HttpMethod::POST)
			->setPostData([])
			->setQueryParameters(['key' => 'value']);

		$this->assertEquals('value', $request->query('key'));
	}

	public function testRouteParametersReturnsValueIfKeyIsGiven(): void
	{
		$route = new Route('/test/{param}', function() {});

		$request = (new Request())
			->setUri('/test/123')
			->setMethod(HttpMethod::GET)
			->setPostData([])
			->setQueryParameters([])
			->setRoute($route);

		$this->assertEquals('123', $request->routerParameters('param'));
	}
}